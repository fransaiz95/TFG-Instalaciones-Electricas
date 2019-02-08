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

class ObjectivesController extends AppController
{

    public function home(){
        
    }

    public function homeEconomic(){
        
        $session = $this->request->session();

        if(!$this->request->is('get')){
            $this->_set_session_values($session, $this->request->data);
            $this->Flash->success('Economic objectives have been saved correctly.');
            return $this->redirect(['controller' => 'objectives' , 'action' => 'home']);
            
        }

        $this->set(compact('session'));
        $this->set('_serialize', ['session']);
    }

    public function homeEnvironmental(){

        $session = $this->request->session();

        if(!$this->request->is('get')){
            $this->_set_session_values($session, $this->request->data);
            $this->Flash->success('Environmental objectives have been saved correctly.');
            return $this->redirect(['controller' => 'objectives' , 'action' => 'home']);
        }

        $this->set(compact('session'));
        $this->set('_serialize', ['session']);

    }

    public function homeSocial(){

        $session = $this->request->session();

        if(!$this->request->is('get')){
            $this->_set_session_values($session, $this->request->data);
            $this->Flash->success('Social objectives have been saved correctly.');
            return $this->redirect(['controller' => 'objectives' , 'action' => 'home']);
        }

        $this->set(compact('session'));
        $this->set('_serialize', ['session']);

    }

    private function _set_session_values($session, $data){

        if(isset($data['ec_cost_new_plant'])){
            $session->write('Objectives.ec_cost_new_plant', $data['ec_cost_new_plant']); 
        }

        if(isset($data['ec_cost_oper_maint_plant'])){
            $session->write('Objectives.ec_cost_oper_maint_plant', $data['ec_cost_oper_maint_plant']); 
        }

        if(isset($data['ec_cost_generation'])){
            $session->write('Objectives.ec_cost_generation', $data['ec_cost_generation']); 
        }

        if(isset($data['ec_cost_new_lines'])){
            $session->write('Objectives.ec_cost_new_lines', $data['ec_cost_new_lines']); 
        }

        if(isset($data['ec_cost_oper_maint_lines'])){
            $session->write('Objectives.ec_cost_oper_maint_lines', $data['ec_cost_oper_maint_lines']); 
        }

        if(isset($data['ec_cost_import_fuel'])){
            $session->write('Objectives.ec_cost_import_fuel', $data['ec_cost_import_fuel']); 
        }

        if(isset($data['ec_cost_public_politics'])){
            $session->write('Objectives.ec_cost_public_politics', $data['ec_cost_public_politics']); 
        }

        if(isset($data['en_environmental_impact'])){
            $session->write('Objectives.en_environmental_impact', $data['en_environmental_impact']); 
        }

        if(isset($data['en_emission_gases'])){
            $session->write('Objectives.en_emission_gases', $data['en_emission_gases']); 
        }

        if(isset($data['en_water_usage'])){
            $session->write('Objectives.en_water_usage', $data['en_water_usage']); 
        }

        if(isset($data['en_water_withdrawal'])){
            $session->write('Objectives.en_water_withdrawal', $data['en_water_withdrawal']); 
        }

        if(isset($data['so_generation_plants'])){
            $session->write('Objectives.so_generation_plants', $data['so_generation_plants']); 
        }

        if(isset($data['so_employment_contruc'])){
            $session->write('Objectives.so_employment_contruc', $data['so_employment_contruc']); 
        }

        if(isset($data['so_dismantling_plants'])){
            $session->write('Objectives.so_dismantling_plants', $data['so_dismantling_plants']); 
        }

        if(isset($data['so_maintenance_plants'])){
            $session->write('Objectives.so_maintenance_plants', $data['so_maintenance_plants']); 
        }

        if(isset($data['so_generated_transport'])){
            $session->write('Objectives.so_generated_transport', $data['so_generated_transport']); 
        }

        if(isset($data['so_employment_transmission'])){
            $session->write('Objectives.so_employment_transmission', $data['so_employment_transmission']); 
        }

        if(isset($data['so_employment_installation'])){
            $session->write('Objectives.so_employment_installation', $data['so_employment_installation']); 
        }

        if(isset($data['so_employment_operation'])){
            $session->write('Objectives.so_employment_operation', $data['so_employment_operation']); 
        }

        if(isset($data['so_employment_maintenance'])){
            $session->write('Objectives.so_employment_maintenance', $data['so_employment_maintenance']); 
        }

        if(isset($data['so_social_cost'])){
            $session->write('Objectives.so_social_cost', $data['so_social_cost']); 
        }

        if(isset($data['so_cost_public'])){
            $session->write('Objectives.so_cost_public', $data['so_cost_public']); 
        }

        if(isset($data['so_accidents_produced'])){
            $session->write('Objectives.so_accidents_produced', $data['so_accidents_produced']); 
        }

        if(isset($data['so_cost_energy'])){
            $session->write('Objectives.so_cost_energy', $data['so_cost_energy']); 
        }

    }

}