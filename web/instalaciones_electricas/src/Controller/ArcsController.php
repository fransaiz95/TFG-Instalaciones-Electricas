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
        $regions = $this->Arcs->Regions->search_list(); 
        $typelines = $this->Arcs->Typelines->search_list();
        
        if(!$this->request->is('get')){

            $connection = ConnectionManager::get('default');
            $connection->begin();

            $arc = $this->Arcs->patchEntity($arc, $this->request->data);
            $arc_bd = $this->Arcs->save($arc);
            $error = false;

            if ($arc_bd) {

                $arc_id = $arc_bd['id'];

                $arc_typeline['id_typeline'] = intval($this->request->data['Typelines']['id']);
                $arc_typeline['num_lines'] = $this->request->data['ArcsTypelines']['num_lines'];

                $entity = $this->Arcs->ArcsTypelines->newEntity();
                $arc_typeline['id_arc'] = $arc_id;
                $arc_typeline = $this->Arcs->ArcsTypelines->patchEntity($entity, $arc_typeline);
                
                if($this->Arcs->ArcsTypelines->save($arc_typeline)){
                    $this->Flash->success('Arc has been saved.');
                }else{
                    $error = true;
                }

            } else {
                $error = true;
                $this->Flash->error('Arc could not be saved. Please, try again.');
            }

            if($error == false){
                $connection->commit();
                return $this->redirect(['controller' => 'arcs', 'action' => 'home']);
            }else{
                $connection->rollback();
            }

        }
                
        $this->set(compact('arc', 'regions', 'typelines'));
        $this->set('_serialize', ['arc', 'regions', 'typelines']);
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

            $connection = ConnectionManager::get('default');
            $connection->begin();

            $arc_with_regions = $this->Arcs->patchEntity($arc_with_regions, $this->request->data);
            $arc_bd = $this->Arcs->save($arc_with_regions);
            $error = false;

            if ($arc_bd) {

                $create = false;

                $typeline_recived = $arc_with_regions['ArcsTypelines']['id_typeline'];

                // Si el typeline recibido es diferente al que teníamos y veníamos de tener algo, borramos si existe y añadimos el nuevo mas adelante.
                if( !empty(array_filter($arc_with_regions['ArcsTypelines'])) && $this->request->data['Typelines']['id'] != $typeline_recived ){
                    $arc_typeline = $this->Arcs->ArcsTypelines->get([$arc_id, $arc_with_regions['ArcsTypelines']['id_typeline']]);
                    $arc_typeline['ArcsTypelines']['id_typeline'] = $this->request->data['Typelines']['id'];
                    //Calculamos la entidad para borrarla
                    $tmp = $this->Arcs->ArcsTypelines->delete($arc_typeline);
                    $create = true;
                }

                $arc_typeline['id_typeline'] = intval($this->request->data['Typelines']['id']);
                $arc_typeline['num_lines'] = $this->request->data['ArcsTypelines']['num_lines'];

                if($create == true){
                    $entity = $this->Arcs->ArcsTypelines->newEntity();
                    $arc_typeline = $this->Arcs->ArcsTypelines->patchEntity($arc_typeline, $arc_typeline->toArray());
                    $arc_typeline = $this->Arcs->ArcsTypelines->patchEntity($entity, $arc_typeline->toArray());
                }else{
                    //Si viene vacio, es decir, no hay creado ningún arc_typeline, lo creamos
                    if( empty(array_filter($arc_with_regions['ArcsTypelines'])) ){
                        $entity = $this->Arcs->ArcsTypelines->newEntity();
                        $arc_typeline['id_arc'] = $arc_id;
                        $arc_typeline = $this->Arcs->ArcsTypelines->patchEntity($entity, $arc_typeline);
                    }else{
                        $entity = $this->Arcs->ArcsTypelines->get([$arc_id, $arc_with_regions['ArcsTypelines']['id_typeline']]);
                        $arc_typeline = $this->Arcs->ArcsTypelines->patchEntity($entity, $arc_typeline);
                    }
                }
                
                if($this->Arcs->ArcsTypelines->save($arc_typeline)){
                    $this->Flash->success('Arc has been saved.');
                }else{
                    $error = true;
                }

            } else {
                $error = true;
                $this->Flash->error('Arc could not be saved. Please, try again.');
            }

            if($error == false){
                $connection->commit();
                return $this->redirect(['controller' => 'arcs', 'action' => 'home']);
            }else{
                $connection->rollback();
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