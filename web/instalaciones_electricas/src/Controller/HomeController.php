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
use ConstantesFuels;

class HomeController extends AppController
{

    public function ajaxDeleteDatabase(){

        ini_set('memory_limit', '-1'); //All
        set_time_limit(0); //Infinite

        $path_delete = ROOT . DS . 'files' . DS . 'restore_database' . DS . 'delete_tables.sql';
        $file_delete = file_get_contents($path_delete);

        $conn = ConnectionManager::get('default'); 
        $stmt = $conn->execute($file_delete); 

        $this->autoRender = false;

    }

    public function ajaxCreateDatabase(){

        ini_set('memory_limit', '-1'); //All
        set_time_limit(0); //Infinite

        $path_create = ROOT . DS . 'files' . DS . 'restore_database' . DS . 'restore_tables.sql';
        $file_create = file_get_contents($path_create);

        $conn = ConnectionManager::get('default'); 
        $stmt = $conn->execute($file_create); 

        $this->autoRender = false;

    }

    public function home(){
        
    }

    public function homeCountries(){
        
    }

    public function homeTechnologies(){
        
    }

    public function homeSimulation(){
        
    }

    public function loadData(){

        ini_set('memory_limit', '-1'); //All
        set_time_limit(0); //Infinite

        $file_tmp = "/files/initial_data/DDBB_CyberSyn 2.0.xlsx";
        $path = ROOT . $file_tmp;
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);

        // // Regions - ForMar.
        // $regions_tmp = $spreadsheet->setActiveSheetIndexByName('ForMar')->toArray(null, true, true, true);
        // $this->_load_regions($regions_tmp);

        // // Technologies - TypPla
        // $technologies_tmp = $spreadsheet->setActiveSheetIndexByName('TypPla')->toArray(null, true, true, true);
        // $this->_load_technologies($technologies_tmp);

        // // Fuels - TypFue
        // $fuels_tmp = $spreadsheet->setActiveSheetIndexByName('TypFue')->toArray(null, true, true, true);
        // $this->_load_fuels($fuels_tmp);

        // // Technologies_fuels - TypPla
        // $technologies_fuel_tmp = $spreadsheet->setActiveSheetIndexByName('TypPla')->toArray(null, true, true, true);
        // $this->_load_technologies_fuels($technologies_fuel_tmp);

        // // Typelines - TypLin 
        // $tyipelines_tmp = $spreadsheet->setActiveSheetIndexByName('TypLin')->toArray(null, true, true, true);
        // $this->_load_typelines($tyipelines_tmp);
        
        // // Region - Technology
        // // ExiCap -  (power)
        // $regions_techs_tmp = $spreadsheet->setActiveSheetIndexByName('ExiCap')->toArray(null, true, true, true);
        // $this->_load_region_tech($regions_techs_tmp, 'power');
        // // CapAva - (cap_ava)
        // $regions_techs_tmp = $spreadsheet->setActiveSheetIndexByName('CapAva')->toArray(null, true, true, true);
        // $this->_load_region_tech($regions_techs_tmp, 'cap_ava');

        // // Rangerenewables - GenAva
        // $rangerenewables_tmp = $spreadsheet->setActiveSheetIndexByName('GenAva')->toArray(null, true, true, true);
        // $this->_load_region_tech($regions_techs_tmp, 'power');

        // // Arcs & arcs_typelines - ExiLin
        // $arcs_tmp = $spreadsheet->setActiveSheetIndexByName('ExiLin')->toArray(null, true, true, true);
        // $this->_load_arcs($arcs_tmp);

        // rangedemands - Dem
        $demands_tmp = $spreadsheet->setActiveSheetIndexByName('Dem')->toArray(null, true, true, true);
        $this->_load_demands($demands_tmp);
    }

    private function _load_regions($regions_tmp){

        //Delete first and second rows. 
        unset($regions_tmp[1]);
        unset($regions_tmp[2]);

        try {
            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;
            $this->Regions = TableRegistry::get('Regions');
            $id = 1;
            foreach($regions_tmp as $region_tmp){
                $region_to_save = array(
                    'id' => $id,
                    'id_country' => 1, //Mexico
                    'name' => $region_tmp['A'],
                    'dem_for' => $region_tmp['B'],
                    'ren_for' => $region_tmp['C'],
                );
                $region = $this->Regions->newEntity();
                $region = $this->Regions->patchEntity($region, $region_to_save);
                $region_bd = $this->Regions->save($region);
                if(!$region_bd){
                    $error = true;
                }
                $id ++;
            }
            if($error == false){
                $connection->commit();
            }
        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

    private function _load_technologies($technologies_tmp){

        //Delete first and second rows. 
        unset($technologies_tmp[1]);
        unset($technologies_tmp[2]);

        try {
            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;
            $this->Technologies = TableRegistry::get('Technologies');
            $id = 1;

            $technologies_renewables = [
                'WIND',
                'HYDRO',
                'PV'
            ];

            foreach($technologies_tmp as $technology_tmp){
                
                if($technology_tmp['A'] != null){
                    $technology_to_save = array(
                        'id' => $id,
                        'name' => $technology_tmp['A'],
                        'renewable' => (in_array($technology_tmp['A'], $technologies_renewables)) ? ConstantesBooleanas::SI : ConstantesBooleanas::NO ,
                        'wat_wit' => $technology_tmp['P'],
                        'genco_pri' => $technology_tmp['AI'],
                        'cap' => $technology_tmp['B'],
                        'new_cap_cos' => $technology_tmp['C'],
                        'man_cos' => $technology_tmp['D'],
                        'man_cos_new_cap' => $technology_tmp['E'],
                        'gen_cos' => $technology_tmp['F'],
                        'gen_cos_new_cap' => $technology_tmp['G'],
                        'life_time' => $technology_tmp['H'],
                        'ghg_emi' => $technology_tmp['I'],
                        'inv_cap_emp' => $technology_tmp['J'],
                        'man_cap_emp' => $technology_tmp['K'],
                        'dec_cam_emp' => $technology_tmp['L'],
                        'om_cap_emp' => $technology_tmp['M'],
                        'fue_cap_emp' => $technology_tmp['N'],
                        'wat_con' => $technology_tmp['O'],
                    );
                    $technology = $this->Technologies->newEntity();
                    $technology = $this->Technologies->patchEntity($technology, $technology_to_save);
                    $technology_bd = $this->Technologies->save($technology);
                    if(!$technology_bd){
                        $error = true;
                    }
                    $id ++;
                }
            }
            if($error == false){
                $connection->commit();
            }
        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

    private function _load_fuels($fuels_tmp){

        //Delete first and second rows. 
        unset($fuels_tmp[1]);
        unset($fuels_tmp[2]);

        try {
            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;
            $this->Fuels = TableRegistry::get('Fuels');

            foreach($fuels_tmp as $fuel_tmp){
                
                if($fuel_tmp['A'] != null){
                    $fuel_to_save = array(
                        'name' => $fuel_tmp['A'],
                        'fue_cos' => $fuel_tmp['B'],
                        'production' => $fuel_tmp['C'],
                    );
                    $fuel = $this->Fuels->newEntity();
                    $fuel = $this->Fuels->patchEntity($fuel, $fuel_to_save);
                    $fuel_bd = $this->Fuels->save($fuel);
                    if(!$fuel_bd){
                        $error = true;
                    }
                }
            }
            if($error == false){
                $connection->commit();
            }
        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

    private function _load_technologies_fuels($technologies_fuel_tmp){

        
        //Delete first and second rows. 
        unset($technologies_fuel_tmp[1]);
        unset($technologies_fuel_tmp[2]);

        try {
            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;
            $this->FuelsTechnologies = TableRegistry::get('FuelsTechnologies');
            $this->Technologies = TableRegistry::get('Technologies');
            $this->Fuels = TableRegistry::get('Fuels');

            $perc_con = [ 
                'Q' => ConstantesFuels::BAG, 
                'R' => ConstantesFuels::BIO,
                'S' => ConstantesFuels::COAL, 
                'T' => ConstantesFuels::OIL, 
                'U' => ConstantesFuels::COKE, 
                'V' => ConstantesFuels::DIE, 
                'W' => ConstantesFuels::NG, 
                'X' => ConstantesFuels::SOW, 
                'Y' => ConstantesFuels::URA
            ];
            $fue_con = [ 
                ConstantesFuels::BAG => 'Z', 
                ConstantesFuels::BIO => 'AA',
                ConstantesFuels::COAL => 'AB', 
                ConstantesFuels::OIL => 'AC', 
                ConstantesFuels::COKE => 'AD', 
                ConstantesFuels::DIE => 'AE', 
                ConstantesFuels::NG => 'AF', 
                ConstantesFuels::SOW => 'AG', 
                ConstantesFuels::URA => 'AH'
            ];

            // Fuels.
            $fuels = $this->Fuels->find('list', [
                'keyField' => 'name',
                'valueField' => 'id'
            ])
            ->toArray();

            foreach($technologies_fuel_tmp as $technology_fuel_tmp){
                
                if($technology_fuel_tmp['A'] != null){

                    $technology = $this->Technologies->find()
                                ->select('Technologies.id', 'Technologies.name')
                                ->where([ 'Technologies.name' => $technology_fuel_tmp['A'] ])
                                ->first();

                    $technology_id = $technology->id;

                    foreach($technology_fuel_tmp as $letter => $value){

                        if(array_key_exists($letter, $perc_con)){
                            $fuel_id = $perc_con[$letter];
                            $fuel_technology_to_save = array(
                                'id_fuel' => $fuel_id,
                                'id_technology' => $technology_id,
                                'perc_con' => $value,
                                'fue_con' => $technology_fuel_tmp[$fue_con[$fuel_id]],
                            );

                            $fuel_technology = $this->FuelsTechnologies->newEntity();
                            $fuel_technology = $this->FuelsTechnologies->patchEntity($fuel_technology, $fuel_technology_to_save);
                            $fuel_technology_bd = $this->FuelsTechnologies->save($fuel_technology);
                            if(!$fuel_technology_bd){
                                $error = true;
                            }
                        }

                    }
                    
                }
            }
            if($error == false){
                $connection->commit();
            }
        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

    private function _load_typelines($typelines_tmp){

        //Delete first and second rows. 
        unset($typelines_tmp[1]);
        unset($typelines_tmp[2]);

        try {
            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;
            $this->Typelines = TableRegistry::get('Typelines');
            $id = 1;

            foreach($typelines_tmp as $typeline_tmp){
                
                if($typeline_tmp['B'] != null){
                    $typeline_to_save = array(
                        'id' => $id,
                        'lin_cap' => $typeline_tmp['B'],
                        'new_line_cos' => $typeline_tmp['C'],
                        'man_lin_cos' => $typeline_tmp['D'],
                        'flo_cos' => $typeline_tmp['E'],
                        'new_lim_emp' => $typeline_tmp['F'],
                        'man_lim_emp' => $typeline_tmp['G'],
                        'flo_emp' => $typeline_tmp['H'],
                        'eff_lin' => $typeline_tmp['I'],
                    );
                    $typeline = $this->Typelines->newEntity();
                    $typeline = $this->Typelines->patchEntity($typeline, $typeline_to_save);
                    $typeline_bd = $this->Typelines->save($typeline);
                    if(!$typeline_bd){
                        $error = true;
                    }
                }
                $id++;
            }
            if($error == false){
                $connection->commit();
            }
        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

    private function _load_region_tech($regions_techs_tmp, $field){

        $header = $regions_techs_tmp[1];
        //Delete first row. 
        unset($regions_techs_tmp[1]);

        try {
            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;
            $this->RegionsTechnologies = TableRegistry::get('RegionsTechnologies');
            $this->Regions = TableRegistry::get('Regions');
            $this->Technologies = TableRegistry::get('Technologies');

            foreach($regions_techs_tmp as $region_tech_tmp){

                if($region_tech_tmp['A'] != null){

                    //Region:
                    $region = $this->Regions->find()
                        ->select([ 'Regions.id', 'Regions.name' ])
                        ->where([ 'name' => $region_tech_tmp['A'] ])
                        ->first();

                    $region_id = $region->id;

                    //Technologies. We must iterate this row.
                    $technologies = $this->Technologies->find('list', [
                        'keyField' => 'name',
                        'valueField' => 'id'
                    ])
                    ->toArray();

                    unset($region_tech_tmp['A']);
                    foreach($region_tech_tmp as $letter => $value){

                        if($value != null){

                            $technology_name = $header[$letter];
                            $technology_id = $technologies[$technology_name];

                            $region_tech_to_save = [
                                'id_region' => $region_id,
                                'id_technology' => $technology_id,
                                $field => $value
                            ];

                            $region_technology = $this->RegionsTechnologies->newEntity();
                            $region_technology = $this->RegionsTechnologies->patchEntity($region_technology, $region_tech_to_save);
                            $region_technology_bd = $this->RegionsTechnologies->save($region_technology);
                            if(!$region_technology_bd){
                                $error = true;
                            }

                        }

                    }

                }
            }
            if($error == false){
                $connection->commit();
            }
        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

    private function _load_arcs($arcs_tmp){

        unset($arcs_tmp[1]);
        $header = $arcs_tmp[2];
        unset($arcs_tmp[2]);

        try {
            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;
            $this->Arcs = TableRegistry::get('Arcs');
            $this->ArcsTypelines = TableRegistry::get('ArcsTypelines');
            $this->Typelines = TableRegistry::get('Typelines');

            foreach($arcs_tmp as $arc_tmp){

                if($arc_tmp['A'] != null){

                    $arc_to_save = [
                        'id_region_1' => $arc_tmp['B'],
                        'id_region_2' => $arc_tmp['C'],
                        'distance' => $arc_tmp['Q']
                    ];

                    $arc = $this->Arcs->newEntity();
                    $arc = $this->Arcs->patchEntity($arc, $arc_to_save);
                    $arc_bd = $this->Arcs->save($arc);
                    if(!$arc_bd){
                        $error = true;
                    }else{
                        $arc_id = $arc_bd->id;

                        foreach($arc_tmp as $letter => $num_lines){
                            if($num_lines > 0){

                                // Check if it's a correct typeline
                                $typeline_id = $header[$letter];

                                $typeline = $this->Typelines->find()
                                    ->select('Typelines.id')
                                    ->where([ 'id' => $typeline_id ])
                                    ->first();

                                if(!empty($typeline)){

                                    $arc_typeline_to_save = [
                                        'id_arc' => $arc_id,
                                        'id_typeline' => $typeline->id,
                                        'num_lines' => $num_lines
                                    ];

                                    $arc_typeline = $this->ArcsTypelines->newEntity();
                                    $arc_typeline = $this->ArcsTypelines->patchEntity($arc_typeline, $arc_typeline_to_save);
                                    $arc_typeline_bd = $this->ArcsTypelines->save($arc_typeline);

                                    if(!$arc_typeline_bd){
                                        $error = true;
                                    }
                                }
                            }
                        }
                    }

                }
            }
            if($error == false){
                $connection->commit();
            }
        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

    private function _load_demands($demands_tmp){

        unset($demands_tmp[1]);
        $header = $demands_tmp[2];
        unset($demands_tmp[2]);
        unset($demands_tmp[3]);
        
        try {

            $connection = ConnectionManager::get('default');
            $connection->begin();
            $error = false;

            $this->Regions = TableRegistry::get('Regions');
            $this->Rangedemands = TableRegistry::get('Rangedemands');

            $regions = $this->Regions->find('list', [
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
                            
                            if(!$rangedemand_bd){
                                $error = true;
                            }

                        }
                    }
                }
            }

            if($error == false){
                $connection->commit();
            }

        } catch(\Cake\ORM\Exception\PersistenceFailedException $e) {
            $connection->rollback();
        }

    }

}