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

class RangedemandsController extends AppController
{

    public function home(){
        ini_set('memory_limit', '-1');
        set_time_limit(0); 

        $rangedemands = $this->Rangedemands->newEntity();

        if ($this->request->is('post')) {
            $file = $this->request->data['excel_file'];

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $this->_load_demands($sheetData);

        }

        $this->set(compact('rangedemands'));
        $this->set('_serialize', ['rangedemands']);
    }

    private function _load_demands($demands_tmp){
        ini_set('memory_limit', '-1');
        set_time_limit(0); 

        //Antes de insertar nada, borramos todo.
        $this->Rangedemands->deleteAll(array());

        unset($demands_tmp[1]);
        $header = $demands_tmp[2];
        unset($demands_tmp[2]);
        unset($demands_tmp[3]);
        
        try {

            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;

            $regions = $this->Rangedemands->Regions->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ])
            ->toArray();

            foreach($demands_tmp as $demand_tmp){

                if($demand_tmp['A'] != null){

                    $year = $demand_tmp['A'];
                    $month = $demand_tmp['B'];
                    $day = $demand_tmp['C'];
                    $hour = $demand_tmp['D'] - 1;
                    $date = new \DateTime($year . '-' . $month . '-' . $day . ' ' . $hour .':00:00');

                    $start = $date->format("Y-m-d H:i:s");

                    $date->modify("+1 hours");
                    $date->modify("-1 second");

                    $end = $date->format("Y-m-d H:i:s");

                    foreach($header as $letter => $region_id){
                        if(in_array($region_id, $regions)){
                            $rangedemand_to_save = [
                                'id_region' => $region_id,
                                'start' => $start,
                                'end' => $end,
                                'demand' => $demand_tmp[$letter]
                            ];

                            $rangedemand = $this->Rangedemands->newEntity();
                            $rangedemand = $this->Rangedemands->patchEntity($rangedemand, $rangedemand_to_save);
                            $rangedemand_bd = $this->Rangedemands->save($rangedemand);
                            $connection->commit();
                            if(!$rangedemand_bd){
                                $error = true;
                                $connection->rollback();
                                $this->Rangedemands->deleteAll();
                            }

                        }
                    }
                }
            }

            if($error == false){
                $connection->commit();
                return $this->redirect(['action' => 'home']);
            }else{
                $this->Rangedemands->deleteAll();
                $connection->commit();
            }

        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

}