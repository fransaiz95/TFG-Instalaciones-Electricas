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

class TypelinesController extends AppController
{

    public function home(){

        $query = $this->Typelines->getQueryTypelines();
        $typelines = $this->paginate($query);

        $this->request->data = $_GET;

        $this->set(compact('typelines'));
        $this->set('_serialize', ['typelines']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeline = $this->Typelines->newEntity();
        
        if ($this->request->is('post')) {
            $typeline = $this->Typelines->patchEntity($typeline, $this->request->data);
            if ($this->Typelines->save($typeline)) {
                $this->Flash->success('Typeline has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Typeline could not be saved. Please, try again.');
            }
        }
        $this->set(compact('typeline'));
        $this->set('_serialize', ['typeline']);
    }

    /**
     * View method
     *
     * @param string $id_typeline Typeline id.
     */
    public function view($id_typeline)
    {
        $typeline = $this->Typelines->findById($id_typeline)->first()->toArray();

        $this->set(
            compact('typeline')
        );
        $this->set('_serialize', ['typeline']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Region id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id_typeline = null)
    {
        $typeline = $this->Typelines->get($id_typeline);

        if(!$this->request->is('get')){
            $typeline = $this->Typelines->patchEntity($typeline, $this->request->data);
            if ($this->Typelines->save($typeline)) {
                $this->Flash->success('Typeline has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Typeline could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('typeline'));
        $this->set('_serialize', ['typeline']);
    }

    /**
     * Delete method
     *
     * @param string|null $id_typeline Typeline id.
     * @return void Redirects to home.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete(){
        $id_typeline = $this->request->data['id'];
        if(!$this->request->is('get')){
            $typeline = $this->Typelines->get($id_typeline);
            if ($this->Typelines->delete($typeline)) {
                echo 'OK';
            } else {
                echo __('An error has occurred while we were deleting this arc.');
            }
        }
        $this->autoRender = false;
    }

}