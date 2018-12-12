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

class RegionsController extends AppController
{

    public function home(){

        $region_name = (isset($_GET['region_name'])) ? $_GET['region_name'] : '';
        $id_country = (isset($_GET['id_country'])) ? $_GET['id_country'] : '';

        $filters = [];

        if($region_name != '' ){
            $filters['Regions.name LIKE'] = '%' . $region_name . '%';
        }
        if($id_country != '' ){
            $filters['Countries.id '] = $id_country;
        }

        $query = $this->Regions->getQueryRegionsAndCountry($filters);
        $regions = $this->paginate($query);

        $countries = $this->Regions->Countries->search_list();

        $this->request->data = $_GET;

        $this->set(compact('regions', 'countries'));
        $this->set('_serialize', ['regions', 'countries']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id_country = null)
    {
        $region = $this->Regions->newEntity();
        $countries = $this->Regions->Countries->search_list();
        
        if ($this->request->is('post')) {
            $region = $this->Regions->patchEntity($region, $this->request->data);
            if ($this->Regions->save($region)) {
                $this->Flash->success('Region has been saved.');
                return $this->redirect(['controller' => 'countries', 'action' => 'view', $id_country]);
            } else {
                $this->Flash->error('Region could not be saved. Please, try again.');
            }
        }
        $this->set(compact('region', 'countries', 'id_country'));
        $this->set('_serialize', ['region', 'countries', 'id_country']);
    }

    /**
     * View method
     *
     * @param string $id_region Region id.
     */
    public function view($id_region)
    {
        $region = $this->Regions->getRegionAndCountryByRegionId($id_region);

        $region_technologies = $this->Regions->getTechnologiesByRegionId($id_region); 
        $region_arcs = $this->Regions->getArcsByRegionId($id_region); 

        $enabled_tabs = [
            ConstantesTabs::TECHNOLOGIES,
            ConstantesTabs::ARCS
        ];

        $active_tab = ConstantesTabs::TECHNOLOGIES;

        $this->set(
            compact('region', 'region_technologies', 'region_arcs', 'enabled_tabs', 'active_tab')
        );
        $this->set('_serialize', ['region', 'region_technologies', 'region_arcs', 'enabled_tabs', 'active_tab']);
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
        $region = $this->Regions->get($id);
        $countries = $this->Regions->Countries->search_list();

        $id_country = $region->id_country;

        if(!$this->request->is('get')){
            $region = $this->Regions->patchEntity($region, $this->request->data);
            if ($this->Regions->save($region)) {
                $this->Flash->success('Region has been saved.');
                return $this->redirect(['controller' => 'countries', 'action' => 'view', $id_country]);
            } else {
                $this->Flash->error('Region could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('region', 'countries', 'id_country'));
        $this->set('_serialize', ['region', 'countries', 'id_country']);
    }

    /**
     * Delete method
     *
     * @param string|null $id_region Country id.
     * @return void Redirects to home.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id_region = null)
    {
        $id_region = $this->request->data['id'];
        if(!$this->request->is('get')){
           
            $region = $this->Regions->get($id_region);

            if ($this->Regions->delete($region)) {
                echo 'OK';
            } else {
                echo __('An error has occurred while we were deleting this country.');
            }
        }
        $this->autoRender = false;
    }

}