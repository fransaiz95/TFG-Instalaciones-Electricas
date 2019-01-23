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

class RegionsTechnologiesController extends AppController
{

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id_region)
    {
        $region = $this->RegionsTechnologies->Regions->get($id_region);
        $country = $this->RegionsTechnologies->Regions->Countries->get([$region->id_country]);
        $technologies = $this->RegionsTechnologies->Technologies->search_list();
        $region_technology = $this->RegionsTechnologies->newEntity();

        if(!$this->request->is('get')){
            //find if exists other region_technology with this pk.
            $region_technology = $this->RegionsTechnologies->patchEntity($region_technology, $this->request->data);
            if ($this->RegionsTechnologies->save($region_technology)) {
                $this->Flash->success('Region technology has been saved.');
                return $this->redirect(['controller' => 'regions', 'action' => 'view', $id_region]);
            } else {
                $this->Flash->error('Region technology could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('region', 'country', 'region_technology', 'technologies'));
        $this->set('_serialize', ['region', 'country', 'region_technology', 'technologies']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Region id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id_region, $id_technology)
    {
        $region_technology = $this->RegionsTechnologies->get([$id_region, $id_technology]);
        $region = $this->RegionsTechnologies->Regions->get($id_region);
        $country = $this->RegionsTechnologies->Regions->Countries->get([$region->id_country]);
        $technology = $this->RegionsTechnologies->Technologies->get($id_technology);

        if(!$this->request->is('get')){
            $region_technology = $this->RegionsTechnologies->patchEntity($region_technology, $this->request->data);
            if ($this->RegionsTechnologies->save($region_technology)) {
                $this->Flash->success('Region technology has been saved.');
                return $this->redirect(['controller' => 'regions', 'action' => 'view', $id_region]);
            } else {
                $this->Flash->error('Region technology could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('region', 'technology', 'region_technology', 'country'));
        $this->set('_serialize', ['region', 'technology', 'region_technology']);
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
        $ids = explode("/", $this->request->data['id']);
        $id_region = $ids[0];
        $id_technology = $ids[1];
        if(!$this->request->is('get')){
            $region_technology = $this->RegionsTechnologies->get([$id_region, $id_technology]);
            if ($this->RegionsTechnologies->delete($region_technology)) {
                echo 'OK';
            } else {
                echo __('An error has occurred while we were deleting this arc.');
            }
        }
        $this->autoRender = false;
    }

}