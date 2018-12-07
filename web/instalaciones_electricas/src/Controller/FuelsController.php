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

class FuelsController extends AppController
{

    public function home(){

        $fuel_name = (isset($_GET['fuel_name'])) ? $_GET['fuel_name'] : '';

        $filters = [];

        if($fuel_name != '' ){
            $filters['Fuels.name LIKE'] = '%' . $fuel_name . '%';
        }

        $query = $this->Fuels->getQueryFuels($filters);
        $fuels = $this->paginate($query);

        $this->request->data = $_GET;

        $this->set(compact('fuels'));
        $this->set('_serialize', ['fuels']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fuel = $this->Fuels->newEntity();
        
        if ($this->request->is('post')) {
            $fuel = $this->Fuels->patchEntity($fuel, $this->request->data);
            if ($this->Fuels->save($fuel)) {
                $this->Flash->success('Fuel has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Fuel could not be saved. Please, try again.');
            }
        }
        $this->set(compact('fuel'));
        $this->set('_serialize', ['fuel']);
    }

    /**
     * View method
     *
     * @param string $id_region Region id.
     */
    public function view($id_fuel)
    {
        $fuel = $this->Fuels->findById($id_fuel)->first()->toArray();

        $fuels_technologies = $this->Fuels->getTechnologiesByFuelId($id_fuel); 

        $enabled_tabs = [
            ConstantesTabs::TECHNOLOGIES,
        ];

        $active_tab = ConstantesTabs::TECHNOLOGIES;

        $this->set(
            compact('fuel', 'fuels_technologies', 'enabled_tabs', 'active_tab')
        );
        $this->set('_serialize', ['fuel', 'fuels_technologies', 'enabled_tabs', 'active_tab']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Region id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fuel = $this->Fuels->get($id);

        if(!$this->request->is('get')){
            $fuel = $this->Fuels->patchEntity($fuel, $this->request->data);
            if ($this->Fuels->save($fuel)) {
                $this->Flash->success('Fuel has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Fuel could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('fuel'));
        $this->set('_serialize', ['fuel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return void Redirects to home.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete(){
        $id = $this->request->data['id'];
        if(!$this->request->is('get')){
            $fuel = $this->Fuels->get($id);
            if ($this->Fuels->delete($fuel)) {
                echo 'OK';
            } else {
                echo __('An error has occurred while we were deleting this fuel.');
            }
        }
        $this->autoRender = false;
    }

}