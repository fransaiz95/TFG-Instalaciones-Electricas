<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require ROOT . DS . 'vendor' . DS . 'phpoffice/phpspreadsheet/src/Bootstrap.php';

use ConstantesBooleanas;

class RangerenewablesController extends AppController
{

    public function technologies(){

        $technology_name = (isset($_GET['technology_name'])) ? $_GET['technology_name'] : '';
        $is_renewable_yes = (isset($_GET['is_renewable_yes'])) ? $_GET['is_renewable_yes'] : '';
        $is_renewable_no = (isset($_GET['is_renewable_no'])) ? $_GET['is_renewable_no'] : '';

        $filters = [];

        if( $technology_name != '' ){
            $filters['Technologies.name LIKE'] = '%' . $technology_name . '%';
        }
        if( $is_renewable_yes == ConstantesBooleanas::SI ){
            $filters['Technologies.renewable'] = ConstantesBooleanas::SI;
        }
        if( $is_renewable_no == ConstantesBooleanas::SI ){
            $filters['Technologies.renewable'] = ConstantesBooleanas::NO;
        }
        if( $is_renewable_yes == ConstantesBooleanas::SI && $is_renewable_no == ConstantesBooleanas::SI ){
            // Así coge todas las renewables y no renewables.
            unset($filters['Technologies.renewable']);
        }

        $query = $this->Rangerenewables->Technologies->getQueryTechnologies($filters);
        $technologies = $this->paginate($query);

        $this->request->data = $_GET;

        $this->set(compact('technologies'));
        $this->set('_serialize', ['technologies']);
    }

    public function home($id_technology){
        ini_set('memory_limit', '-1');
        set_time_limit(0); 

        $technology = $this->Rangerenewables->Technologies->findById($id_technology)->first()->toArray();

        $rangerenewables = $this->Rangerenewables->newEntity();

        if ($this->request->is('post')) {
            $file = $this->request->data['excel_file'];

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $this->_load_renewables($sheetData, $id_technology);

        }

        $this->set(compact('rangerenewables', 'technology'));
        $this->set('_serialize', ['rangerenewables', 'technology']);
    }

    private function _load_renewables($rangerenewables_tmp, $id_technology){

        unset($rangerenewables_tmp[1]);
        $header = $rangerenewables_tmp[2];
        unset($rangerenewables_tmp[2]);
        unset($rangerenewables_tmp[3]);

        $year = 2018;
        
        try {

            $connection = ConnectionManager::get('default');
            $connection->begin();

            //Antes de insertar nada, borramos todo.
            // $tmp = $this->Rangerenewables->deleteAll(array());

            $connection->execute("delete from rangerenewables where start LIKE '%" . $year . "-%' and id_technology = " . $id_technology ); 
            $connection->commit();
            
            $error = false;

            $regions = $this->Rangerenewables->Regions->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ])
            ->toArray();

            $connection = ConnectionManager::get('default');
            $connection->begin();

            foreach($rangerenewables_tmp as $key => $rangerenewable_tmp){

                if($rangerenewable_tmp['A'] != null && $error == false){

                    $year = $rangerenewable_tmp['A'];
                    $month = $rangerenewable_tmp['B'];
                    $day = $rangerenewable_tmp['C'];
                    $hour = $rangerenewable_tmp['D'] - 1;
                    $date = new \DateTime($year . '-' . $month . '-' . $day . ' ' . $hour .':00:00');

                    $start = $date->format("Y-m-d H:i:s");

                    $date->modify("+1 hours");
                    $date->modify("-1 second");

                    $end = $date->format("Y-m-d H:i:s");

                    foreach($header as $letter => $region_id){
                        if(in_array($region_id, $regions)){
                            $rangerenewable_to_save = [
                                'id_region' => $region_id,
                                'id_technology' => $id_technology,
                                'start' => $start,
                                'end' => $end,
                                'gen_ava' => $rangerenewable_tmp[$letter]
                            ];

                            $rangerenewable = $this->Rangerenewables->newEntity();
                            $rangerenewable = $this->Rangerenewables->patchEntity($rangerenewable, $rangerenewable_to_save);
                            $rangerenewable_bd = $this->Rangerenewables->save($rangerenewable);
                            if(!$rangerenewable_bd){
                                $error = true;
                                break;
                            }

                        }
                    }
                }else{
                    break;
                }

                unset($rangerenewables_tmp[$key]);
            }

            if($error == false){
                $connection->commit();
                return $this->redirect(['action' => 'technologies']);
            }

        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            echo 'error';
        }

    }

}