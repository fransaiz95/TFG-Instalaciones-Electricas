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
    public function add($id_region_1)
    {
        $arc = $this->Arcs->newEntity();
        $regions = $this->Arcs->Regions->search_list(); 
        $typelines = $this->Arcs->Typelines->search_list();

        $region = $this->Arcs->Regions->get([$id_region_1]);

        if(!$this->request->is('get')){

            $connection = ConnectionManager::get('default');
            $connection->begin();

            $arc = $this->Arcs->patchEntity($arc, $this->request->data);
            $arc_bd = $this->Arcs->save($arc);
            $error = false;


            if ($arc_bd) {

                $typeline_recived = $this->request->data['ArcsTypelines']['id_typeline']; 
                $num_typeline_recived = $this->request->data['ArcsTypelines']['num_lines']; 

                //Añadimos si el nuevo no viene vacio.
                if($typeline_recived != ''){
                    //Añadimos
                    $entity = $this->Arcs->ArcsTypelines->newEntity();
                    $arc_typeline = array();
                    $arc_typeline['id_arc'] = $arc_bd->id;
                    $arc_typeline['id_typeline'] = $typeline_recived;
                    $arc_typeline['num_lines'] = $num_typeline_recived;
                    $arc_typeline = $this->Arcs->ArcsTypelines->patchEntity($entity, $arc_typeline);
                    $bd = $this->Arcs->ArcsTypelines->save($arc_typeline);
                }else{
                    //No hacemos nada porque ni teniamos antes ni tenemos ahora.
                    $bd = true;
                }

                if($bd){
                    $this->Flash->success('Arc has been saved.');
                    $connection->commit();
                    // return $this->redirect(['controller' => 'arcs', 'action' => 'home']);
                    return $this->redirect(['controller' => 'regions' , 'action' => 'view', $id_region_1]);
                }else{
                    $connection->rollback();
                }

            }

        }
                
        $this->set(compact('arc', 'regions', 'typelines', 'region'));
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

        $region = $this->Arcs->Regions->get($arc_with_regions['Regions']['id']);

        if(!$this->request->is('get')){

            $connection = ConnectionManager::get('default');
            $connection->begin();


            $arc_with_regions = $this->Arcs->patchEntity($arc_with_regions, $this->request->data);
            $arc_bd = $this->Arcs->save($arc_with_regions);

            $error = false;

            if ($arc_bd) {

                $typeline_old = $arc_with_regions['ArcsTypelines']['id_typeline'];
                $typeline_recived = $this->request->data['ArcsTypelines']['id_typeline']; 
                $num_typeline_recived = $this->request->data['ArcsTypelines']['num_lines']; 

                if($typeline_old != null){
                    //Aunque ahora tengamos o no tengamos, lo borramos:
                    $arc_typeline = $this->Arcs->ArcsTypelines->get([$arc_id, $typeline_old]);
                    $this->Arcs->ArcsTypelines->delete($arc_typeline);

                    if($typeline_recived != ''){
                        //Añadimos
                        $entity = $this->Arcs->ArcsTypelines->newEntity();
                        $arc_typeline = $this->Arcs->ArcsTypelines->patchEntity($arc_typeline, $arc_typeline->toArray());
                        $arc_typeline->id_typeline = $typeline_recived;
                        $arc_typeline->num_lines = $num_typeline_recived;
                        $arc_typeline = $this->Arcs->ArcsTypelines->patchEntity($entity, $arc_typeline->toArray());
                        $bd = $this->Arcs->ArcsTypelines->save($arc_typeline);
                    }else{
                        //Dejamos vacío
                        $bd = true;
                    }
                }else{
                    //Añadimos si el nuevo no viene vacio.
                    if($typeline_recived != ''){
                        //Añadimos
                        $entity = $this->Arcs->ArcsTypelines->newEntity();
                        $arc_typeline = array();
                        $arc_typeline['id_arc'] = $arc_id;
                        $arc_typeline['id_typeline'] = $typeline_recived;
                        $arc_typeline['num_lines'] = $num_typeline_recived;
                        $arc_typeline = $this->Arcs->ArcsTypelines->patchEntity($entity, $arc_typeline);
                        $bd = $this->Arcs->ArcsTypelines->save($arc_typeline);
                    }else{
                        //No hacemos nada porque ni teniamos antes ni tenemos ahora.
                        $bd = true;
                    }
                }

                if($bd){
                    $this->Flash->success('Arc has been saved.');
                    $connection->commit();
                    // return $this->redirect(['controller' => 'arcs', 'action' => 'home']);
                    return $this->redirect(['controller' => 'regions' , 'action' => 'view', $arc_with_regions->id_region_1]);
                }else{
                    $connection->rollback();
                }

            }else {
                $error = true;
                $this->Flash->error('Arc could not be saved. Please, try again.');
            }

        }
                
        $this->set(compact('arc_with_regions', 'regions', 'typelines', 'region'));
        $this->set('_serialize', ['arc_with_regions', 'regions', 'typelines']);
    }

    /**
     * Delete method
     *
     * @param string|null Arc id.
     * @return void Redirects to home.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete(){

        $id_arc = $this->request->data['id'];

        if(!$this->request->is('get')){
            $arc = $this->Arcs->get($id_arc);

            //Comprobamos si esta asociado con alguna otra entidad.
            $arcs_typelines = $this->Arcs->ArcsTypelines->findByIdArc($id_arc)->toArray();
            if(empty($arcs_typelines)){
                if ($this->Arcs->delete($arc)) {
                    echo 'OK';
                } else {
                    echo __('An error has occurred while we were deleting this arc.');
                }
            }else{
                echo __('An error was ocurred. This arc is associated with an arc typeline.');
            }

        }
        $this->autoRender = false;
    }

}