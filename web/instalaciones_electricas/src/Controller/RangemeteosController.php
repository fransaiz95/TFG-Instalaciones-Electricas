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

class RangemeteosController extends AppController
{

    public function home(){
        ini_set('memory_limit', '-1');
        set_time_limit(0); 

        $rangemeteos = $this->Rangemeteos->newEntity();

        if ($this->request->is('post')) {
            $file = $this->request->data['excel_file'];

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $this->_load_demands($sheetData);

        }

        $this->set(compact('rangemeteos'));
        $this->set('_serialize', ['rangemeteos']);
    }

    private function _load_meteos($meteos_tmp){
        ini_set('memory_limit', '-1');
        set_time_limit(0); 

        //Antes de insertar nada, borramos todo.
        $this->Rangedemands->deleteAll(array());

        unset($meteos_tmp[1]);
        $header = $meteos_tmp[2];
        unset($meteos_tmp[2]);
        unset($meteos_tmp[3]);
        
        try {

            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;

            $regions = $this->Rangedemands->Regions->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ])
            ->toArray();

            foreach($meteos_tmp as $meteo_tmp){

                if($meteo_tmp['A'] != null){

                    $year = $meteo_tmp['A'];
                    $month = $meteo_tmp['B'];
                    $day = $meteo_tmp['C'];
                    $hour = $meteo_tmp['D'] - 1;
                    $date = new \DateTime($year . '-' . $month . '-' . $day . ' ' . $hour .':00:00');

                    $start = $date->format("Y-m-d H:i:s");

                    $date->modify("+1 hours");
                    $date->modify("-1 second");

                    $end = $date->format("Y-m-d H:i:s");

                    foreach($header as $letter => $region_id){
                        if(in_array($region_id, $regions)){
                            $rangemeteo_to_save = [
                                'id_region' => $region_id,
                                'start' => $start,
                                'end' => $end,
                                'demand' => $meteo_tmp[$letter]
                            ];

                            $rangemeteo = $this->Rangemeteos->newEntity();
                            $rangemeteo = $this->Rangemeteos->patchEntity($rangemeteo, $rangemeteo_to_save);
                            $rangemeteo_bd = $this->Rangemeteos->save($rangemeteo);
                            $connection->commit();
                            if(!$rangemeteo_bd){
                                $error = true;
                                $connection->rollback();
                                $this->Rangemeteos->deleteAll();
                            }

                        }
                    }
                }
            }

            if($error == false){
                $connection->commit();
                return $this->redirect(['action' => 'home']);
            }else{
                $this->Rangemeteos->deleteAll();
                $connection->commit();
            }

        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

}