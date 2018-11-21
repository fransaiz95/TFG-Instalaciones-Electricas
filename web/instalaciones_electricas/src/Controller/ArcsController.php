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

    public function home(){

        $region_name = (isset($_GET['region_name'])) ? $_GET['region_name'] : '';

        $filters = [];

        if($region_name != '' ){
            $filters['or']['Regions.name LIKE'] = '%' . $region_name . '%';
            $filters['or']['Regions2.name LIKE'] = '%' . $region_name . '%';
        }

        $query = $this->Arcs->getQueryArcsWithRegions($filters);
        $arcs = $this->paginate($query);

        $this->request->data = $_GET;

        $this->set(compact('arcs'));
        $this->set('_serialize', ['arcs']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $arc = $this->Arcs->newEntity();
        if ($this->request->is('post')) {
            $arc = $this->Arcs->patchEntity($arc, $this->request->data);
            if ($this->Arcs->save($arc)) {
                $this->Flash->success('Arc has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Arc could not be saved. Please, try again.');
            }
        }
        $this->set(compact('arc'));
        $this->set('_serialize', ['arc']);
    }

    
    /**
     * View method
     *
     * @param string $id_region Region id.
     */
    public function view($id_arc)
    {
        $arcs = $this->Arcs->getArcsWithRegionsAndTypeLine($id_arc);

        $this->set(
            compact('arcs')
        );
        $this->set('_serialize', ['arcs']);
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
        $arc_with_regions = $this->Arcs->getArcsWithRegions($arc_id);
        $regions = $this->Arcs->Regions->search_list(); 
        $typelines = $this->Arcs->Typelines->search_list();
        
        if(!$this->request->is('get')){
            
            $arc_with_regions = $this->Arcs->patchEntity($arc_with_regions, $this->request->data);


            //Problemas al guardar, la relacion ya está echa.


            debug($arc_with_regions);Exit;
            if ($this->Arcs->save($arc_with_regions)) {





                $arc_typeline['ArcTypelines']['id_arc'] = $arc_with_regions['id_arc'];
                $arc_typeline['ArcTypelines']['id_typeline'] = $arc_with_regions['Typelines']['id'];




                

                if($this->Arcs->ArcsTypelines->save($arc_typeline)){
                    $this->Flash->success('Arc has been saved.');
                    return $this->redirect(['controller' => 'regions', 'action' => 'view', $arc_with_regions->id_region_1]);
                }
            } else {
                $this->Flash->error('Arc could not be saved. Please, try again.');
            }

        }

        
                
        $this->set(compact('arc_with_regions', 'regions', 'typelines'));
        $this->set('_serialize', ['arc_with_regions', 'regions', 'typelines']);
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