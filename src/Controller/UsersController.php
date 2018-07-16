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
        $this->Auth->allow();
    }

    public function view($id = null){
        $this->loadModel('Messages');
        $this->loadModel('Following');
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
        $follow = $this->Following->followUsers($id);
        $follower = $this->Following->followerUsers($id);
        $this->set(compact('show_user', 'messages', 'message_count' ,'follow', 'follower'));
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
                $user = $this->Users->patchEntity($new_user, $this->request->getData());
                if ($this->Users->save($user)){
                    $this->set('user', $user);
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
    public function find(){

    }

    public function result($find = null){
        $this->loadModel('Messages');
        $this->loadModel('Following');
        if($this->request->is('post')){
            $find = $this->request->getData('find');
            $find = urlencode($find);
            $this->redirect(['action' => 'result', $find]);
        }
        else{
            $this->paginate = [
                'limit' => 10,
                'order' => [
                    'Users.id' => 'desc'
                ],
                'contain' => ['Messages']
            ];
            $results = $this->paginate($this->Users->find('all')->where(["name like " => '%'. $find . '%'])->Where(["username like " => '%' . $find . '%']));
            $follower = $this->Following->followUsers($this->Auth->user()['id']);
            $find = urldecode($find);
            $this->set(compact('find', 'results', 'follower'));
        }
    }

    public function follow($id = null){
        $this->loadModel('Messages');
        $this->loadModel('Following');

        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Users.id' => 'desc'
            ],
            'contain' => ['Users']
        ];


        $show_user = $this->Users->find()->where(['id = ' => $id])->first();
        $message_count = $this->Messages->countMessage($id);
        $follow = $this->Following->followUsers($id);
        $follower = $this->Following->followerUsers($id);
        $login_user_follow = $this->Following->followUsers($this->Auth->user()['id']);

        $users = $this->paginate($this->Following->find('all')->contain('Users')->where(["user_id = " => $id]));
        foreach(array_map(null, $follow, $users->toArray()) as [$follow_id, $user]) {
            $user->user = $this->Users->find()->contain('Messages')->where(['id = ' => $follow_id])->first();
        }
        $this->set(compact('users', 'show_user', 'message_count' ,'follow', 'follower', 'login_user_follow'));

    }

    public function follower($id = null){
        $this->loadModel('Messages');
        $this->loadModel('Following');

        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Users.id' => 'desc'
            ],
            'contain' => ['Users']
        ];


        $users = $this->paginate($this->Following->find()->where(['follower_id = ' => $id]));
        $show_user = $this->Users->find()->where(['id = ' => $id])->first();
        $message_count = $this->Messages->countMessage($id);
        $follow = $this->Following->followUsers($id);
        $follower = $this->Following->followerUsers($id);
        $login_user_follow = $this->Following->followUsers($this->Auth->user()['id']);
        foreach(array_map(null, $follower, $users->toArray()) as [$follower_id, $user]) {
            $user->user = $this->Users->find()->contain('Messages')->where(['id = ' => $follower_id])->first();
        }
        $this->set(compact('users', 'show_user', 'message_count' ,'follow', 'follower', 'login_user_follow', 'test'));
    }


}
