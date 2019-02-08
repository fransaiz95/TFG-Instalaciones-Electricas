<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use ConstantesBooleanas;
use ConstantesTabs;

class CountriesController extends AppController
{

    public function home(){

        $country_name = (isset($_GET['country_name'])) ? $_GET['country_name'] : '';

        $filters = [];

        if($country_name != '' ){
            $filters['Countries.name LIKE'] = '%' . $country_name . '%';
        }

        $query = $this->Countries->getQueryCountries($filters);
        $countries = $this->paginate($query);

        $this->request->data = $_GET;

        $this->set(compact('countries'));
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
                $this->Flash->success('Country has been saved.');
                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error('Country could not be saved. Please, try again.');
            }
        }
        // $departments = $this->Employees->Departments->find('list', ['limit' => 200]);
        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
    }

    /**
     * View method
     *
     * @param string|null $id_country Country id.
     */
    public function view($id_country)
    {
        $country = $this->Countries->findById($id_country)->first()->toArray();

        $region_name = (isset($_GET['region_name'])) ? $_GET['region_name'] : '';
        $filters = [];
        if($region_name != '' ){
            $filters['Regions.name LIKE'] = '%' . $region_name . '%';
        }
        $filters['Regions.id_country'] = $id_country;

        $query = $this->Countries->Regions->getQueryRegionsAndCountry($filters);
        $regions = $this->paginate($query);

        $this->request->data = $_GET;

        $this->set(
            compact('country', 'regions')
        );
        $this->set('_serialize', ['country', 'regions']);
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
    public function delete(){

        $id_country = $this->request->data['id'];
        if(!$this->request->is('get')){

            $country = $this->Countries->get($id_country);

            //Comprobamos si esta asociado con alguna otra entidad.
            $regions = $this->Countries->Regions->findByIdCountry($id_country)->toArray();
            if(empty($regions)){
                if ($this->Countries->delete($country)) {
                    echo 'OK';
                } else {
                    echo __('An error has occurred while we were deleting this country.');
                }
            }else{
                echo __('An error was ocurred. The country is associated with a region. Please, remove all its region first.');
            }
            
            $this->autoRender = false;
        }

    }
}