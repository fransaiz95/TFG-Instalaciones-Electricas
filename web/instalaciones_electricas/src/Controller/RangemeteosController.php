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

        $years = [
            '2017' => '2017',
            '2018' => '2018',
            '2019' => '2019',
            '2020' => '2020'
        ];

        if ($this->request->is('post')) {
            $file = $this->request->data['excel_file'];
            $year = $this->request->data['year'];

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $this->_load_meteos($sheetData, $year);

        }

        $this->set(compact('rangemeteos', 'years'));
        $this->set('_serialize', ['rangemeteos', 'years']);
    }

    public function ajaxCountResults (){

        $year = $this->request->data['year'];

        $query = $this->Rangemeteos->find();
        $query->select(['count' => $query->func()->count('*')]);
        $query->where(["start LIKE '%" . $year . "-%'"]);
        $count_registries = $query->first()->toArray();

        $total_registries = number_format($count_registries['count'], 0 , ',', '.');

        echo $total_registries;

        $this->autoRender = false;

    }

    private function _load_meteos($meteos_tmp, $year){

        unset($meteos_tmp[1]);
        $header = $meteos_tmp[2];
        unset($meteos_tmp[2]);
        unset($meteos_tmp[3]);
        
        try {

            $connection = ConnectionManager::get('default');
            $connection->begin();

            //Antes de insertar nada, borramos todo.
            // $tmp = $this->Rangerenewables->deleteAll(array());

            $connection->execute("delete from rangemeteos where start LIKE '%" . $year . "-%'"); 
            $connection->commit();
            
            $error = false;

            $regions = $this->Rangemeteos->Regions->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ])
            ->toArray();

            $connection = ConnectionManager::get('default');
            $connection->begin();

            foreach($meteos_tmp as $key => $meteo_tmp){

                if($meteo_tmp['A'] != null && $error == false){

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
                                'temp' => $meteo_tmp[$letter]
                            ];

                            $rangemeteo = $this->Rangemeteos->newEntity();
                            $rangemeteo = $this->Rangemeteos->patchEntity($rangemeteo, $rangemeteo_to_save);
                            $rangemeteo_bd = $this->Rangemeteos->save($rangemeteo);
                            if(!$rangemeteo_bd){
                                $error = true;
                                break;
                            }

                        }
                    }
                }else{
                    $error = true;
                    break;
                }

                unset($meteos_tmp[$key]);
            }

            if($error == false){
                $connection->commit();
                return $this->redirect(['action' => 'home']);
            }else{
                $connection->rollback();
                debug('rollback hecho');exit;
            }

        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            echo 'error';
        }

    }

    public function ajaxDownloadExcel(){

        ini_set('memory_limit', '-1');
        set_time_limit(0); 

        $year = $this->request->data['year'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Todos los ids de las regiones.
        $regions_ids = $this->Rangemeteos->Regions->search_list_reverse();

        // Los datos que vamos a exportar.
        $rangemeteos = $this->Rangemeteos->getAllByYear($year); 

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

        foreach($rangemeteos as $rangemeteo){
            $date_froozen = $rangemeteo['start'];
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
                $meteos_by_region = $this->Rangemeteos->findByIdRegionAndStart($id_region, $start)->first();
                $value = $meteos_by_region['temp'];

                $row[] = $value;
            }

            $sheet->fromArray($row, null, $start_cell . $cont_row);
            $cont_row ++;

        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('rangemeteos.xlsx');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="rangemeteos.xlsx"');
        header('Set-Cookie: fileDownload=true; path=/');
        $writer->save("php://output");
        exit;
        
    }



    public function exportExcel() {
        $spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
        $Excel_writer = new Xlsx($spreadsheet);  /*----- Excel (Xls) Object*/

	
        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();

        $activeSheet->setCellValue('A1' , 'New file content')->getStyle('A1')->getFont()->setBold(true);

        $writer = new Xlsx($spreadsheet);
        $writer->save('export.xlsx');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="export.xlsx"');
        $writer->save("php://output");
        exit;
	
    }

}