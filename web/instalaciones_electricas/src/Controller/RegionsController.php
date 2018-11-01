<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class RegionsController extends AppController
{

    public function home(){

        $regions = $this->paginate($this->Regions);

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
     * @param string|null $id Country id.
     */
    public function view($id = null)
    {
        $region = $this->Regions->get($id);

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
    public function edit($id = null)
    {
        $region = $this->Regions->get($id);
        if(!$this->request->is('get')){
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
                $this->Flash->success('Country has been deleted.');
            } else {
                $this->Flash->error('Country could not be deleted. Please, try again.');
            }
        }
        return $this->redirect(['action' => 'home']);
    }

}