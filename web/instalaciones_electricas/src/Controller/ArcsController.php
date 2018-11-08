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

class ArcsController extends AppController
{

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
     * Edit method
     *
     * @param string|null $id Region id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($arc_id)
    {
        $arc = $this->Arcs->get($arc_id);
        $arc_with_regions = $this->Arcs->getArcsWithRegions($arc_id);
        $regions = $this->Arcs->Regions->search_list(); 


        if(!$this->request->is('get')){
            $arc = $this->Arcs->patchEntity($arc, $this->request->data);
            if ($this->Arcs->save($arc)) {
                $this->Flash->success('Arc has been saved.');
                return $this->redirect(['controller' => 'regions', 'action' => 'view', $arc->id_region_1]);
            } else {
                $this->Flash->error('Arc could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('arc', 'arc_with_regions', 'regions'));
        $this->set('_serialize', ['arc', 'arc_with_regions', 'regions']);
    }

    /**
     * Delete method
     *
     * @param string|null $id_arc Arc id.
     * @return void Redirects to home.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id_arc)
    {
        if(!$this->request->is('get')){
            $arc = $this->Arcs->get($id_arc);
            if ($this->Arcs->delete($arc)) {
                $this->Flash->success('Arc has been deleted.');
            } else {
                $this->Flash->error('Arc could not be deleted. Please, try again.');
            }
        }
        return $this->redirect(['controller' => 'regions', 'action' => 'view', $arc->id_region_1]);
    }

}