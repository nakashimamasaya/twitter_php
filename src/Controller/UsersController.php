<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->set('user', $this->Auth->user());
    }

    public function index(){
    }

    public function signup()
    {
        $user = $this->Auth->user();
        if(isset($user)){
            $this->redirect(['controller'=>'Users','action'=>'index']);
        }
        else{
            $user = $this->Users->newEntity();
            if ($this->request->is('post')){
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user)){
                    $this->set('user', $user);
                    $this->render('complete');
                }
            }
            $this->set(compact('user'));
        }
    }

    public function login(){
        $user = $this->Auth->user();
        if(isset($user)){
            $this->redirect(['controller'=>'Users','action'=>'index']);
        }
        else{
            if ($this->request->is('post')){
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error(__('ユーザ名もしくはパスワードが間違っています'));
            }

        }
    }

    public function logout(){
        $this->Flash->success('ログアウトしました');
        return $this->redirect($this->Auth->logout());
    }

}
