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

// src/Controller/UsersController.php

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    // public function beforeFilter(Event $event)
    // {
    //     parent::beforeFilter($event);
    //     $this->Auth->allow('add');
    // }

    public function index()
    {
        $this->set('users', $this->Users->find('all'));
    }

    public function view($id)
    {
        if (!$id) {
            debug('fail!!');Exit;
        }

        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        $roles = $this->Users->Roles->search_list();
        if ($this->request->is('post')) {
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

    public function login()
    {
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
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }

        // $this->render('login'); 
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

}