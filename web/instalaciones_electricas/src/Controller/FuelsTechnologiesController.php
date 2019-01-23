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

class FuelsTechnologiesController extends AppController
{

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id_fuel)
    {
        $fuel = $this->FuelsTechnologies->Fuels->get($id_fuel);
        $technologies = $this->FuelsTechnologies->Technologies->search_list();
        $fuel_technology = $this->FuelsTechnologies->newEntity();

        if(!$this->request->is('get')){
            //find if exists other fuel_technology with this pk.
            $fuel_technology = $this->FuelsTechnologies->patchEntity($fuel_technology, $this->request->data);
            if ($this->FuelsTechnologies->save($fuel_technology)) {
                $this->Flash->success('Fuel technology has been saved.');
                return $this->redirect(['controller' => 'fuels', 'action' => 'view', $id_fuel]);
            } else {
                $this->Flash->error('Fuel technology could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('fuel', 'fuel_technology', 'technologies'));
        $this->set('_serialize', ['fuel', 'fuel_technology', 'technologies']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Region id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id_fuel, $id_technology)
    {
        $fuel_technology = $this->FuelsTechnologies->get([$id_fuel, $id_technology]);
        $fuel = $this->FuelsTechnologies->Fuels->get($id_fuel);
        $technology = $this->FuelsTechnologies->Technologies->get($id_technology);

        if(!$this->request->is('get')){
            $fuel_technology = $this->FuelsTechnologies->patchEntity($fuel_technology, $this->request->data);
            if ($this->FuelsTechnologies->save($fuel_technology)) {
                $this->Flash->success('Fuel technology has been saved.');
                return $this->redirect(['controller' => 'fuels', 'action' => 'view', $id_fuel]);
            } else {
                $this->Flash->error('Fuel technology could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('fuel', 'technology', 'fuel_technology'));
        $this->set('_serialize', ['fuel', 'technology', 'fuel_technology']);
    }

    /**
     * Delete method
     *
     * @param string|null $id_region Region id.
     * @param string|null $id_technology Technology id.
     * @return void Redirects to home.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete(){
        $id_fuel = $this->request->data['id_fuel'];
        $id_technology = $this->request->data['id_technology'];

        if(!$this->request->is('get')){
            $fuel_technology = $this->FuelsTechnologies->get([$id_fuel, $id_technology]);
            if ($this->FuelsTechnologies->delete($fuel_technology)) {
                echo 'OK';
            } else {
                echo __('An error has occurred while we were deleting this arc.');
            }
        }
        $this->autoRender = false;
    }

}