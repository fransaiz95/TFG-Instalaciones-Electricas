<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CountriesController extends AppController
{

    public function home(){

        $countries = $this->paginate($this->Countries);

        $this->set('countries', $countries);
        $this->set('_serialize', ['countries']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $country = $this->Countries->newEntity();
        if ($this->request->is('post')) {
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success('The country has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('The country could not be saved. Please, try again.');
            }
        }
        // $departments = $this->Employees->Departments->find('list', ['limit' => 200]);
        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
    }

    /**
     * View method
     *
     * @param string|null $id Country id.
     */
    public function view($id = null)
    {
        $country = $this->Countries->get($id);

        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Country id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $country = $this->Countries->get($id);
        if(!$this->request->is('get')){
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success('Country has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Country could not be saved. Please, try again.');
            }
        }
                
        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
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
            $country = $this->Countries->get($id);
            if ($this->Countries->delete($country)) {
                $this->Flash->success('Country has been deleted.');
            } else {
                $this->Flash->error('Country could not be deleted. Please, try again.');
            }
        }
        return $this->redirect(['action' => 'home']);
    }
}