<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use ConstantesBooleanas;
use ConstantesTabs;
use ConstantesRoles;
use ConstantesRoutes;

use App\Controller\AppController;
use Cake\Event\Event;

class SimulationsController extends AppController
{

    public function home(){

        $user = $this->Auth->user();
        $id_user = $user['id'];

        // $name = (isset($_GET['name'])) ? $_GET['name'] : '';
        // $surname = (isset($_GET['surname'])) ? $_GET['surname'] : '';
        // $username = (isset($_GET['username'])) ? $_GET['username'] : '';
        // $id_role = (isset($_GET['id_role'])) ? $_GET['id_role'] : '';

        $filters = [];

        // if($name != '' ){
        //     $filters['Users.name LIKE'] = '%' . $name . '%';
        // }
        // if($surname != '' ){
        //     $filters['Users.surname LIKE'] = '%' . $surname . '%';
        // }
        // if($username != '' ){
        //     $filters['Users.username LIKE'] = '%' . $username . '%';
        // }
        $filters['Simulations.id_user '] = $id_user;

        $query = $this->Simulations->getQuerySimulations($filters);
        $simulations = $this->paginate($query);

        // $this->request->data = $_GET;

        $this->set(compact('simulations'));
        $this->set('_serialize', ['simulations']);
    }

    public function download($id_simulation){
        // $id_simulation = $this->request->data['id_simulation'];
        $simulation = $this->Simulations->findById($id_simulation)->first()->toArray();
        $file_path = $simulation['file'];
        $name = $simulation['simulation_name'];
        
        $this->response->file($file_path, array(
            'download' => true,
            'name' => $name . '.zip'
        ));
        return $this->response;
    }


    public function delete($id_simulation = null)
    {
        $id_simulation = $this->request->data['id'];
        if(!$this->request->is('get')){
           
            $simulation = $this->Simulations->get($id_simulation);
            $simulation_file = $simulation->file;

            if ($this->Simulations->delete($simulation)) {
                unlink($simulation_file);
                echo 'OK';
            } else {
                echo __('An error has occurred while we were deleting this simulation.');
            }
        }
        $this->autoRender = false;
    }

    ////////////////////////////////////////////////////////////////////
    ////////    FUNCIONES PARA GENERAR EL ZIP DE LA BD ACTUAL   ////////
    ////////////////////////////////////////////////////////////////////
    
    public function generateZip(){
        set_time_limit(18000); 
        ini_set('memory_limit', '-1');
        
        $user = $this->Auth->user();
        $session = $this->request->session();

        $separator_txt = "\t";

        $date_tmp = new \DateTime('now');
        $date_tmp->setTimeZone(new \DateTimeZone("Europe/Amsterdam"));
        $date = $date_tmp->format('Y-m-d H:i:s');
        $date_name_file = $date_tmp->format('Y-m-d H_i_s');
        $simulation_name = $this->request->data['simulation_name'];

        $zipname = ConstantesRoutes::SIMULATION_CNT_TO_EXPORTS . DS .'parameters_' . $date_name_file . '.zip';
        $zip = new \ZipArchive;
        $zip->open($zipname, \ZipArchive::CREATE);

        //Nuestra exportacion
        $zip = $this->fileCapAva($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'CapAva.txt');
        $zip = $this->fileGenAva($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'GenAva.txt');
        $zip = $this->fileExiCap($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'ExiCap.txt');
        $zip = $this->fileExiLin($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'ExiLin.txt');
        $zip = $this->fileForMar($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'ForMar.txt');
        $zip = $this->fileFue($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'Fue.txt');
        $zip = $this->fileReg($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'Reg.txt');
        $zip = $this->fileTec($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'Tec.txt');
        $zip = $this->fileTypFue($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'TypFue.txt');
        $zip = $this->fileTypPla($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'TypPla.txt');
        $zip = $this->fileTypLin($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'TypLin.txt');
        $zip = $this->fileHours($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'Hours.txt');
        $zip = $this->fileDem($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'Dem.txt');
        $zip = $this->fileTem($zip, $separator_txt, ConstantesRoutes::SIMULATION_DATA . DS . 'Tem.txt');

        //Los datos del cliente.
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/CapAva.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'CapAva.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/Dem.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'Dem.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/ExiCap.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'ExiCap.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/ExiLin.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'ExiLin.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/ForMar.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'ForMar.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/Fue.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'Fue.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/GenAva.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'GenAva.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/Hours.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'Hours.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/Reg.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'Reg.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/Tec.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'Tec.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/Tem.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'Tem.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/TypFue.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'TypFue.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/TypLin.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'TypLin.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/TypPla.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'TypPla.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Parametros/UniCap.txt', ConstantesRoutes::SIMULATION_PARAMETROS . DS . 'UniCap.txt.txt');
        $zip->addFile(ConstantesRoutes::SIMULATION_CNT_CLIENT_DATA . DS . 'Codigo/individuo.R', ConstantesRoutes::SIMULATION_CODIGO . DS . 'individuo.R');

        $zip = $this->fileObjectives($zip, $session, ConstantesRoutes::SIMULATION_DATA . DS . 'objectives.json');

        //Antes de cerrar el zip, lo guardamos.
        $this->Simulations = TableRegistry::get('Simulations');

        $connection = ConnectionManager::get('default');
        $connection->begin();

        $simulation = $this->Simulations->newEntity();

        $new_simulation = [
            'id_user' => $user['id'],
            'simulation_name' => $simulation_name,
            'creation_date' => $date,
            'file' => $zip->filename,
        ];

        $simulation = $this->Simulations->patchEntity($simulation, $new_simulation);

        if ($this->Simulations->save($simulation)) {
            $connection->commit();
        } else {
            $connection->rollback();
        }

        $zip->close();
        
        // Para exportar se usan estas cabeceras:
        // header('Content-Type: application/zip');
        // header('Set-Cookie:fileDownload=true; path=/');
        // header('Content-disposition: attachment; filename='.$zipname);
        // header('Content-Length: ' . filesize($zipname));
        // readfile($zipname);
        
        $this->autoRender = false;

        return $this->redirect(['controller' => 'simulations', 'action' => 'home']);
    }

    //Cap Ava
    public function fileCapAva($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtRegionTechnologiesCapAva($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Cap Ava
    public function exportTxtRegionTechnologiesCapAva($txt, $separator_txt){

        $this->Regions = TableRegistry::get('Regions');
        $this->RegionsTechnologies = TableRegistry::get('RegionsTechnologies');

        $regions_technologies = $this->RegionsTechnologies->find('all')->toArray();

        $technologies_val = [];
        $actual_region = $regions_technologies[0]->id_region;
        foreach($regions_technologies as $region_technology){
            if($actual_region != $region_technology->id_region){
                fputcsv($txt, $technologies_val, $separator_txt);
                $technologies_val = [];
                $actual_region = $region_technology->id_region;
            }
            $technologies_val[] = $region_technology->cap_ava;
        }
        fputcsv($txt, $technologies_val, $separator_txt);

        return $txt;

    }

    //Gen Ava
    public function fileGenAva($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtRegionTechnologiesGenAva($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Cap Ava
    public function exportTxtRegionTechnologiesGenAva($txt, $separator_txt){

        $this->Regions = TableRegistry::get('Regions');
        $this->RegionsTechnologies = TableRegistry::get('RegionsTechnologies');

        $regions_technologies = $this->RegionsTechnologies->find('all')->toArray();

        $technologies_val = [];
        $actual_region = $regions_technologies[0]->id_region;
        foreach($regions_technologies as $region_technology){
            if($actual_region != $region_technology->id_region){
                fputcsv($txt, $technologies_val, $separator_txt);
                $technologies_val = [];
                $actual_region = $region_technology->id_region;
            }
            $technologies_val[] = $region_technology->gen_ava;
        }
        fputcsv($txt, $technologies_val, $separator_txt);

        return $txt;

    }

    //Exi Cap
    public function fileExiCap($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtRegionTechnologiesExiCap($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Exi Cap
    public function exportTxtRegionTechnologiesExiCap($txt, $separator_txt){

        $this->Regions = TableRegistry::get('Regions');
        $this->RegionsTechnologies = TableRegistry::get('RegionsTechnologies');

        $regions_technologies = $this->RegionsTechnologies->find('all')->toArray();

        $technologies_val = [];
        $actual_region = $regions_technologies[0]->id_region;
        foreach($regions_technologies as $region_technology){
            if($actual_region != $region_technology->id_region){
                fputcsv($txt, $technologies_val, "\t");
                $technologies_val = [];
                $actual_region = $region_technology->id_region;
            }
            $technologies_val[] = $region_technology->power;
        }
        fputcsv($txt, $technologies_val, $separator_txt);

        return $txt;

    }

    //Exi Lin
    public function fileExiLin($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtArcsTypelinesExiLin($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Exi Lin
    public function exportTxtArcsTypelinesExiLin($txt, $separator_txt){

        $this->Arcs = TableRegistry::get('Arcs');

        $arcs_typelines = $this->Arcs->getArcsWithTypeLine();

        foreach($arcs_typelines as $arc_typeline){
            $exi_lin_tmp = [$arc_typeline->id_region_1, $arc_typeline->id_region_2, $arc_typeline->ArcsTypelines['id_typeline'], $arc_typeline->distance];
            fputcsv($txt, $exi_lin_tmp, $separator_txt);
        }

        return $txt;

    }

    //For Mar
    public function fileForMar($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtRegionsForMar($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }


    //For Mar
    public function exportTxtRegionsForMar($txt, $separator_txt){

        $this->Regions = TableRegistry::get('Regions');

        $regions = $this->Regions->find('all');

        foreach($regions as $region){
            $for_mar_tmp = [$region->dem_for, $region->ren_for];
            fputcsv($txt, $for_mar_tmp, $separator_txt);
        }

        return $txt;

    }

    //Fue
    public function fileFue($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtFuelsFue($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Fue
    public function exportTxtFuelsFue($txt, $separator_txt){

        $this->Fuels = TableRegistry::get('Fuels');

        $fuels = $this->Fuels->find('list')->toArray();

        foreach($fuels as $fuel){
            fputcsv($txt, [$fuel], $separator_txt);
        }

        return $txt;

    }

    //Reg
    public function fileReg($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtRegionsReg($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Reg
    public function exportTxtRegionsReg($txt, $separator_txt){

        $this->Regions = TableRegistry::get('Regions');

        $regions = $this->Regions->find('list')->toArray();

        foreach($regions as $region){
            fputcsv($txt, [$region], $separator_txt);
        }

        return $txt;

    }
    // Tec
    public function fileTec($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtTechnologiesTec($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Tec
    public function exportTxtTechnologiesTec($txt, $separator_txt){

        $this->Technologies = TableRegistry::get('Technologies');

        $technologies = $this->Technologies->find('list')->toArray();

        foreach($technologies as $technology){
            fputcsv($txt, [$technology], $separator_txt);
        }

       return $txt;

    }

    //TypFue
    public function fileTypFue($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtFuelsTypFue($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //TypFue
    public function exportTxtFuelsTypFue($txt, $separator_txt){

        $this->Fuels = TableRegistry::get('Fuels');

        $fuels = $this->Fuels->find('all')->toArray();

        fputcsv($txt, ['FueCos', 'FueNat'], $separator_txt);
        foreach($fuels as $fuel){
            fputcsv($txt, [$fuel->fue_cos, $fuel->production], $separator_txt);
        }

        return $txt;

    }

    //TypPla
    public function fileTypPla($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtTechnologiesTypPla($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //TypPla
    public function exportTxtTechnologiesTypPla($txt, $separator_txt){

        $this->Technologies = TableRegistry::get('Technologies');

        $technologies = $this->Technologies->getQueryTechnologiesTypPla();

        fputcsv($txt, ['FueCos', 'FueNat'], $separator_txt);

        foreach($technologies as $technology){
            $tmp = [
                $technology->cap,
                $technology->new_cap_cos,
                $technology->man_cos,
                $technology->man_cos_new_cap,
                $technology->gen_cos,
                $technology->gen_cos_new_cap,
                $technology->ghg_emi,
                $technology->wat_con,
                $technology->wat_wit,
            ];
            foreach($technology['FuelsTechnologies'] as $fuel_technology){
                $tmp[] = $fuel_technology->perc_con;
            }
            foreach($technology['FuelsTechnologies'] as $fuel_technology){
                $tmp[] = $fuel_technology->fue_con;
            }
                $tmp[] = $technology->genco_pri;
            fputcsv($txt, $tmp, $separator_txt);
        }

        return $txt;

    }

    //TypLin
    public function fileTypLin($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTxtTypLin($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //TypLin
    public function exportTxtTypLin($txt, $separator_txt){

        $this->Typelines = TableRegistry::get('Typelines');

        $typelines = $this->Typelines->find('all')->toArray();

        fputcsv($txt, ['LinCap', 'NewLinCos', 'ManLinCos', 'FloCos', 'EffLinBas'], $separator_txt);

        foreach($typelines as $typeline){
            $tmp = [
                $typeline->lin_cap,
                $typeline->new_cap_cos,
                $typeline->new_lin_cos,
                $typeline->man_lin_cos,
                $typeline->flo_cos,
                $typeline->eff_lin_bas,
            ];
            fputcsv($txt, $tmp, $separator_txt);
        }

        return $txt;

    }

    //Hours
    public function fileHours($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportHours($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Hours
    public function exportHours($txt, $separator_txt){

        $this->Rangemeteos = TableRegistry::get('Rangemeteos');


        //Calcular en un array todos los años que tenemos.
        $query = $this->Rangemeteos->find();
        $query->select(['start'])->distinct(['year(start)']);
        $query->order('year(start)');

        $year_objs = $query->toArray();

        foreach($year_objs as $year){

            $year = $year->start->format('Y');

            $query = $this->Rangemeteos->getNumberHoursByYear($year);
    
            $hours = $query->first()->toArray();

            fputcsv($txt, [$hours['count']], $separator_txt);
        }

        return $txt;

    }

    //Dem
    public function fileDem($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportDem($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Dem
    public function exportDem($txt, $separator_txt){

        
        $this->Rangedemands = TableRegistry::get('Rangedemands');
        
        
        //Calcular en un array todos los años que tenemos.
        $query = $this->Rangedemands->find();
        $query->select(['start'])->distinct(['year(start)']);
        $query->order('year(start)');
        
        $year_objs = $query->toArray();
        
        foreach($year_objs as $year){
            
            $year = $year->start->format('Y');
            
            $query = $this->Rangedemands->find();
            $query 
                ->select(['avg' => $query->func()->avg('Rangedemands.demand')])
                ->where(['year(start) = ' . $year]);

            $avg = $query->first()->toArray();

            fputcsv($txt, [$avg['avg']], $separator_txt);
        }

        return $txt;

    }

    //Tem
    public function fileTem($zip, $separator_txt, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $txt = $this->exportTem($txt, $separator_txt);

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }

    //Dem
    public function exportTem($txt, $separator_txt){

        
        $this->Rangemeteos = TableRegistry::get('Rangemeteos');
        
        
        //Calcular en un array todos los años que tenemos.
        $query = $this->Rangemeteos->find();
        $query->select(['start'])->distinct(['year(start)']);
        $query->order('year(start)');
        
        $year_objs = $query->toArray();
        
        foreach($year_objs as $year){
            
            $year = $year->start->format('Y');
            
            $query = $this->Rangemeteos->find();
            $query 
                ->select(['avg' => $query->func()->avg('Rangemeteos.temp')])
                ->where(['year(start) = ' . $year]);

            $avg = $query->first()->toArray();

            fputcsv($txt, [$avg['avg']], $separator_txt);
        }

        return $txt;

    }

    //Data/Objectives.json
    public function fileObjectives($zip, $session, $txt_name){
        $txt = fopen('php://temp/maxmemory:1048576', 'w');
        fputs($txt, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // para solucionar problema encoding (utf-8)
        if (false === $txt) {
            die('Failed to create temporary file');
        }

        $objectives = [];

        $objectives['ec_cost_new_plant'] = ($session->read('Objectives.ec_cost_new_plant') != null) ? $session->read('Objectives.ec_cost_new_plant') : "0";
        $objectives['ec_cost_oper_maint_plant'] = ($session->read('Objectives.ec_cost_oper_maint_plant') != null) ? $session->read('Objectives.ec_cost_oper_maint_plant') : "0";
        $objectives['ec_cost_generation'] = ($session->read('Objectives.ec_cost_generation') != null) ? $session->read('Objectives.ec_cost_generation') : "0";
        $objectives['ec_cost_new_lines'] = ($session->read('Objectives.ec_cost_new_lines') != null) ? $session->read('Objectives.ec_cost_new_lines') : "0";
        $objectives['ec_cost_oper_maint_lines'] = ($session->read('Objectives.ec_cost_oper_maint_lines') != null) ? $session->read('Objectives.ec_cost_oper_maint_lines') : "0";
        $objectives['ec_cost_import_fuel'] = ($session->read('Objectives.ec_cost_import_fuel') != null) ? $session->read('Objectives.ec_cost_import_fuel') : "0";
        $objectives['ec_cost_public_politics'] = ($session->read('Objectives.ec_cost_public_politics') != null) ? $session->read('Objectives.ec_cost_public_politics') : "0";
        $objectives['en_environmental_impact'] = ($session->read('Objectives.en_environmental_impact') != null) ? $session->read('Objectives.en_environmental_impact') : "0";
        $objectives['en_emission_gases'] = ($session->read('Objectives.en_emission_gases') != null) ? $session->read('Objectives.en_emission_gases') : "0";
        $objectives['en_water_usage'] = ($session->read('Objectives.en_water_usage') != null) ? $session->read('Objectives.en_water_usage') : "0";
        $objectives['en_water_withdrawal'] = ($session->read('Objectives.en_water_withdrawal') != null) ? $session->read('Objectives.en_water_withdrawal') : "0";
        $objectives['so_generation_plants'] = ($session->read('Objectives.so_generation_plants') != null) ? $session->read('Objectives.so_generation_plants') : "0";
        $objectives['so_employment_contruc'] = ($session->read('Objectives.so_employment_contruc') != null) ? $session->read('Objectives.so_employment_contruc') : "0";
        $objectives['so_dismantling_plants'] = ($session->read('Objectives.so_dismantling_plants') != null) ? $session->read('Objectives.so_dismantling_plants') : "0";
        $objectives['so_maintenance_plants'] = ($session->read('Objectives.so_maintenance_plants') != null) ? $session->read('Objectives.so_maintenance_plants') : "0";
        $objectives['so_generated_transport'] = ($session->read('Objectives.so_generated_transport') != null) ? $session->read('Objectives.so_generated_transport') : "0";
        $objectives['so_employment_transmission'] = ($session->read('Objectives.so_employment_transmission') != null) ? $session->read('Objectives.so_employment_transmission') : "0";
        $objectives['so_employment_installation'] = ($session->read('Objectives.so_employment_installation') != null) ? $session->read('Objectives.so_employment_installation') : "0";
        $objectives['so_employment_operation'] = ($session->read('Objectives.so_employment_operation') != null) ? $session->read('Objectives.so_employment_operation') : "0";
        $objectives['so_employment_maintenance'] = ($session->read('Objectives.so_employment_maintenance') != null) ? $session->read('Objectives.so_employment_maintenance') : "0";
        $objectives['so_social_cost'] = ($session->read('Objectives.so_social_cost') != null) ? $session->read('Objectives.so_social_cost') : "0";
        $objectives['so_cost_public'] = ($session->read('Objectives.so_cost_public') != null) ? $session->read('Objectives.so_cost_public') : "0";
        $objectives['so_accidents_produced'] = ($session->read('Objectives.so_accidents_produced') != null) ? $session->read('Objectives.so_accidents_produced') : "0";
        $objectives['so_cost_energy'] = ($session->read('Objectives.so_cost_energy') != null) ? $session->read('Objectives.so_cost_energy') : "0";

        fwrite($txt, json_encode($objectives));

        rewind($txt);
        $zip->addFromString($txt_name, stream_get_contents($txt) );
        fclose($txt);

        return $zip;
    }


}