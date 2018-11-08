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

        $query = $this->Regions->getQueryRegionsAndCountry();
                
        $regions = $this->paginate($query);

        $this->set('regions', $regions);
        $this->set('_serialize', ['regions']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $region = $this->Regions->newEntity();
        if ($this->request->is('post')) {
            $region = $this->Regions->patchEntity($region, $this->request->data);
            if ($this->Regions->save($region)) {
                $this->Flash->success('Region has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Region could not be saved. Please, try again.');
            }
        }
        $this->set(compact('region'));
        $this->set('_serialize', ['region']);
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

        if(!$this->request->is('get')){
            $region = $this->Regions->patchEntity($region, $this->request->data);
            if ($this->Regions->save($region)) {
                $this->Flash->success('Region has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Region could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('region', 'countries'));
        $this->set('_serialize', ['region', 'countries']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return void Redirects to home.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if(!$this->request->is('get')){
            $region = $this->Regions->get($id);
            if ($this->Regions->delete($region)) {
                $this->Flash->success('Region has been deleted.');
            } else {
                $this->Flash->error('Region could not be deleted. Please, try again.');
            }
        }
        return $this->redirect(['action' => 'home']);
    }

}