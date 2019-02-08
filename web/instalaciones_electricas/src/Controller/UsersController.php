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
use ConstantesRoles;

// src/Controller/UsersController.php

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function home(){

        if(!$this->Auth->id_admin()){
            return $this->redirect(['controller' => 'home', 'action' => 'home']);
        }

        $name = (isset($_GET['name'])) ? $_GET['name'] : '';
        $surname = (isset($_GET['surname'])) ? $_GET['surname'] : '';
        $username = (isset($_GET['username'])) ? $_GET['username'] : '';
        $id_role = (isset($_GET['id_role'])) ? $_GET['id_role'] : '';

        $filters = [];

        if($name != '' ){
            $filters['Users.name LIKE'] = '%' . $name . '%';
        }
        if($surname != '' ){
            $filters['Users.surname LIKE'] = '%' . $surname . '%';
        }
        if($username != '' ){
            $filters['Users.username LIKE'] = '%' . $username . '%';
        }
        if($id_role != '' ){
            $filters['Users.id_role '] = $id_role;
        }

        $query = $this->Users->getQueryUsersAndRole($filters);
        $users = $this->paginate($query);

        $roles = $this->Users->Roles->search_list();

        $this->request->data = $_GET;

        $this->set(compact('users', 'roles'));
        $this->set('_serialize', ['users', 'roles']);
    }

    public function add(){

        if(!$this->Auth->id_admin()){
            return $this->redirect(['controller' => 'home', 'action' => 'home']);
        }

        $user = $this->Users->newEntity();
        $roles = $this->Users->Roles->search_list();
        if (!$this->request->is('get')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'home', 'action' => 'home']);
            }else{
                $this->Flash->error(__('Unable to add the user.'));
            }
        }
        // $this->set(['user', 'roles']);
        $this->set(compact('user', 'roles'));

    }

    public function edit($id_user){

        $user = $this->Users->get($id_user);
        $roles = $this->Users->Roles->search_list();


        $query = $this->Users->find();
        $query->select(['count' => $query->func()->count('*')]);
        $query->where(['id_role' => ConstantesRoles::ADMIN]);
        $count_users_admin = $query->first()->toArray()['count'];

        if (!$this->request->is('get')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'home', 'action' => 'home']);
            }else{
                $this->Flash->error(__('Unable to add the user.'));
            }
        }
        // $this->set(['user', 'roles']);
        $this->set(compact('user', 'roles', 'count_users_admin'));

    }

    public function delete($id_user = null)
    {
        $id_user = $this->request->data['id'];
        if(!$this->request->is('get')){
           
            $user = $this->Users->get($id_user);

            if ($this->Users->delete($user)) {
                echo 'OK';
            } else {
                echo __('An error has occurred while we were deleting this country.');
            }
        }
        $this->autoRender = false;
    }

    public function login(){

        $this->viewBuilder()->setLayout(false);

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                // return $this->redirect($this->Auth->redirectUrl());
                $this->redirect(array(
                    'controller' => 'home',
                    'action' => 'home',
                ));
            }else{
                $this->Flash->error(__('Invalid username or password, try again'), ['flash']);
            }
        }

    }

    public function logout()
    {
        $this->request->session()->destroy();

        return $this->redirect($this->Auth->logout());
    }

}