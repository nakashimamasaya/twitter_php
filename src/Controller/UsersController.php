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
        parent::beforeFilter($event);
        $this->set('user', $this->Auth->user());
    }

    public function view($id){
        $this->loadModel('Messages');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Messages.id' => 'desc'
            ],
            'contain' => ['Users']
        ];
        $show_user = $this->Users->find()->where(['id = ' => $id])->first();
        $messages = $this->paginate($this->Messages->find()->where(['user_id = ' => $id]));
        $message_count = $this->Messages->countMessage($id);
        $this->set(compact('show_user', 'messages', 'message_count'));
    }

    public function signup()
    {
        $user = $this->Auth->user();
        if(isset($user)){
            $this->redirect(['controller'=>'Users','action'=>'index']);
        }
        else{
            $new_user = $this->Users->newEntity();
            if ($this->request->is('post')){
                $new_user = $this->Users->patchEntity($new_user, $this->request->getData());
                if ($this->Users->save($new_user)){
                    $this->set('new_user', $new_user);
                    $this->render('complete');
                }
            }
            $this->set(compact('new_user'));
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
