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

        $filters['Technologies.renewable'] = ConstantesBooleanas::SI;

        $query = $this->Rangerenewables->Technologies->getQueryTechnologies($filters);
        $technologies = $this->paginate($query);

        $this->request->data = $_GET;

        $this->set(compact('technologies'));
        $this->set('_serialize', ['technologies']);
    }

    public function home($id_technology){
        ini_set('memory_limit', '-1');
        set_time_limit(0); 

        $years = [
            '2017' => '2017',
            '2018' => '2018',
            '2019' => '2019',
            '2020' => '2020'
        ];

        $technology = $this->Rangerenewables->Technologies->findById($id_technology)->first()->toArray();

        $rangerenewables = $this->Rangerenewables->newEntity();

        if ($this->request->is('post')) {

            if($this->request->data['excel_file']['size'] == 0){
                $this->Flash->error(__(ConstantesErrors::FILE_NOT_EXISTS), ['flash']);
            }elseif($this->request->data['excel_file']['error'] == 4){
                $this->Flash->error(__(ConstantesErrors::FILE_INCORRECT), ['flash']);
            }else{
                $file = $this->request->data['excel_file'];
                $year = $this->request->data['year'];
    
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file['tmp_name']);
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    
                $this->_load_renewables($sheetData, $id_technology, $year);

                $this->Flash->success(__(ConstantesErrors::FILE_CORRECT_IMPORTED), [
                    'key' => 'flash',
                    'params' => []
                ]);
            }

        }

        $this->set(compact('rangerenewables', 'technology', 'years'));
        $this->set('_serialize', ['rangerenewables', 'technology', 'years']);
    }

    public function ajaxCountResults (){

        $year = $this->request->data['year'];
        $id_technology = $this->request->data['id_technology'];

        $query = $this->Rangerenewables->find();
        $query->select(['count' => $query->func()->count('*')]);
        $query->where(["start LIKE '%" . $year . "-%'"]);
        $query->where(['id_technology' => $id_technology]);
        $count_registries = $query->first()->toArray();

        $total_registries = number_format($count_registries['count'], 0 , ',', '.');

        echo $total_registries;

        $this->autoRender = false;

    }

    private function _load_renewables($rangerenewables_tmp, $id_technology, $year){

        unset($rangerenewables_tmp[1]);
        $header = $rangerenewables_tmp[2];
        unset($rangerenewables_tmp[2]);
        unset($rangerenewables_tmp[3]);

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
                        if(in_array($region_id, array_keys($regions))){
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

    public function ajaxDownloadExcel(){

        ini_set('memory_limit', '-1');
        set_time_limit(0); 

        $year = $this->request->data['year'];
        $id_technology = $this->request->data['id_technology'];
        $technology = $this->Rangerenewables->Technologies->findById($id_technology)->first();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Todos los ids de las regiones.
        $regions_ids = $this->Rangerenewables->Regions->search_list_reverse();

        // Los datos que vamos a exportar.
        $rangerenewables = $this->Rangerenewables->getAllByYearAndTechnology($year, $id_technology); 

        // Luego lo concatenaremos. Esto es para indicar de donde empieza a escribir.
        $start_cell = 'A';
        $cont_row = 1;

        // Insertamos a piñon la primera fila
        $row_1 = array('Región de Control');
        $sheet->fromArray($row_1, null, $start_cell . $cont_row);
        $cont_row ++;

        // Insertamos a piñon la segunda fila
        $row_2 = array('Región de Transmisión', '', '', '');
        foreach($regions_ids as $id_region){
            $row_2[] = $id_region;
        }
        $sheet->fromArray($row_2, null, $start_cell . $cont_row);
        $cont_row ++;

        // Insertamos a piñon la tercera fila
        $row_3 = array('AÑO', 'MES', 'DIA', 'HORA');
        $sheet->fromArray($row_3, null, $start_cell . $cont_row);
        $cont_row ++;

        //Este es el $row que ira cambiando de valor.
        $row = array();

        foreach($rangerenewables as $rangerenewable){
            $date_froozen = $rangerenewable['start'];
            $start = $date_froozen->i18nFormat('yyyy-MM-dd HH:mm:ss');
            
            $date = new \DateTime($date_froozen->i18nFormat('yyyy-MM-dd HH:mm:ss'));

            $day = $date->format('d');
            $month = $date->format('m');
            $year = $date->format('Y');
            $hour = $date->format('H') + 1;

            $row = array();
            $row[] = $year;
            $row[] = $month;
            $row[] = $day;
            $row[] = $hour;

            foreach($regions_ids as $id_region){
                $renewables_by_region = $this->Rangerenewables->findByIdRegionAndIdTechnologyAndStart($id_region, $id_technology, $start)->first();
                $value = $renewables_by_region['gen_ava'];

                $row[] = $value;
            }

            $sheet->fromArray($row, null, $start_cell . $cont_row);
            $cont_row ++;

        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('rangemeteos.xlsx');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="rangerenewables_' . strtolower($technology['name']) . '.xlsx"');
        header('Set-Cookie: fileDownload=true; path=/');
        $writer->save("php://output");
        exit;
        
    }

}