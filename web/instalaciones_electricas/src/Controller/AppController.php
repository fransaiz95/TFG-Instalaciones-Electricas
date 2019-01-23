<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    // public function initialize()
    // {
    //     parent::initialize();

    //     $this->loadComponent('RequestHandler');
    //     $this->loadComponent('Flash');
    //     $this->loadComponent('Paginator');

    //     /*
    //      * Enable the following components for recommended CakePHP security settings.
    //      * see https://book.cakephp.org/3.0/en/controllers/components/security.html
    //      */
    //     //$this->loadComponent('Security');
    //     //$this->loadComponent('Csrf');
    // }


    public function initialize()
    {
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            // 'authorize' => ['Controller'], // Added this line
            'loginRedirect' => [
                'controller' => 'home',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'users',
                'action' => 'login',
                'home'
            ]
        ]);
    }
    
    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
    
        // Default deny
        return false;
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(
            ['controller' => 'users', 
            'action' => 'add']
        );
    }

    public function beforeRender(Event $event) {
    
        $this->set('Auth', $this->Auth);
    }

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}
