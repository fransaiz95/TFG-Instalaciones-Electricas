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

class TechnologiesController extends AppController
{

    public function home(){

        $technology_name = (isset($_GET['technology_name'])) ? $_GET['technology_name'] : '';
        $is_renowable_yes = (isset($_GET['is_renowable_yes'])) ? $_GET['is_renowable_yes'] : '';
        $is_renowable_no = (isset($_GET['is_renowable_no'])) ? $_GET['is_renowable_no'] : '';

        $filters = [];

        if( $technology_name != '' ){
            $filters['Technologies.name LIKE'] = '%' . $technology_name . '%';
        }
        if( $is_renowable_yes == ConstantesBooleanas::SI ){
            $filters['Technologies.renowable'] = ConstantesBooleanas::SI;
        }
        if( $is_renowable_no == ConstantesBooleanas::SI ){
            $filters['Technologies.renowable'] = ConstantesBooleanas::NO;
        }
        if( $is_renowable_yes == ConstantesBooleanas::SI && $is_renowable_no == ConstantesBooleanas::SI ){
            // Así coge todas las renowables y no renowables.
            unset($filters['Technologies.renowable']);
        }

        $query = $this->Technologies->getQueryTechnologies($filters);
        $technologies = $this->paginate($query);

        $this->request->data = $_GET;

        $this->set(compact('technologies'));
        $this->set('_serialize', ['technologies']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $technology = $this->Technologies->newEntity();
        
        if ($this->request->is('post')) {
            $technology = $this->Technologies->patchEntity($technology, $this->request->data);
            if ($this->Technologies->save($technology)) {
                $this->Flash->success('Technology has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Technology could not be saved. Please, try again.');
            }
        }
        $this->set(compact('technology'));
        $this->set('_serialize', ['technology']);
    }

    /**
     * View method
     *
     * @param string $id_region Region id.
     */
    public function view($id_technology)
    {
        $technology = $this->Technologies->findById($id_technology)->first()->toArray();

        $this->set(
            compact('technology')
        );
        $this->set('_serialize', ['technology']);
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
        $technology = $this->Technologies->get($id);

        if(!$this->request->is('get')){
            $technology = $this->Technologies->patchEntity($technology, $this->request->data);
            if ($this->Technologies->save($technology)) {
                $this->Flash->success('Technology has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Technology could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('technology'));
        $this->set('_serialize', ['technology']);
    }

    /**
     * Delete method
     *
     * @param string|null $id_technology Technology id.
     * @return void Redirects to home.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id_technology)
    {
        if(!$this->request->is('get')){
            $technology = $this->Technologies->get($id_technology);
            if ($this->Technologies->delete($technology)) {
                $this->Flash->success('Technology has been deleted.');
            } else {
                $this->Flash->error('Technology could not be deleted. Please, try again.');
            }
        }
        return $this->redirect(['action' => 'home']);
    }

}