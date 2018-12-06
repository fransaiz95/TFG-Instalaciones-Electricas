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

        //Para pasarselo al formulario.
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
        ini_set('memory_limit', '-1'); //Para usar toda la memoria que necesitemos.
        set_time_limit(0); //Para usar todo el tiempo que necesitemos.

        //Antes de insertar nada, borramos todo. (Aunque según dijimos, no habría que hacerlo).
        $this->Rangedemands->deleteAll(array());

        //Del array cargado, eliminamos lo que serían las cabeceras.
        unset($demands_tmp[1]);
        $header = $demands_tmp[2]; //Nos quedamos con la fila que tiene los ids de las regiones.
        unset($demands_tmp[2]);
        unset($demands_tmp[3]);
        
        try {

            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;

            //Obtenemos una lista con todas nuestras regiones.
            $regions = $this->Rangedemands->Regions->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ])
            ->toArray();

            // $connection->execute('LOCK TABLES rangedemands AS rangedemands WRITE;');

            //Recorremos las filas del excel transformado en array.
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

                            //Creamos la entidad para guardarla
                            $rangedemand = $this->Rangedemands->newEntity();
                            $rangedemand = $this->Rangedemands->patchEntity($rangedemand, $rangedemand_to_save);
                            $rangedemand_bd = $this->Rangedemands->save($rangedemand);
                            
                            if(!$rangedemand_bd){
                                $error = true;
                                debug('here1!');Exit;
                                $connection->rollback();
                                $this->Rangedemands->deleteAll();
                            }

                        }
                    }
                }
            }

            if($error == false){
                $connection->commit();

                // execute query 
                // $connection->execute('UNLOCK TABLES');

                return $this->redirect(['action' => 'home']);
            }else{
                debug('here2!');Exit;
                $connection->rollback();
                $this->Rangedemands->deleteAll(); //Tampoco habría que hacerlo.
            }

        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            debug('here3!');Exit;
            $connection->rollback();
        }

    }

}