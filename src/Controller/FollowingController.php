<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Following Controller
 *
 * @property \App\Model\Table\FollowingTable $Following
 *
 * @method \App\Model\Entity\Following[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FollowingController extends AppController
{
    public function add($id = null, $type = null, $source = null)
    {   
        $this->autoRender = false;
        $this->loadModel('Users');
        $following = $this->Following->newEntity();
        if ($this->request->is('ajax')) {
            $following->set([
                'user_id' => $this->Auth->user()['id'],
                'user' => $this->Auth->user(),
                'follower_id' => $this->request->getData('id'),
                'follower' => $this->Users->get($this->request->getData('id'))
            ]);
            if ($this->Following->save($following)) {
                echo "OK";
            }
            else {
                echo "NO";
            }
        }
        else if ($this->request->is('post')) {
            $following->set([
                'user_id' => $this->Auth->user()['id'],
                'user' => $this->Auth->user(),
                'follower_id' => $id,
                'follower' => $this->Users->get($id)
            ]);
            if ($this->Following->save($following)) {
                $this->Flash->success(__('フォローしました'));
            }
            if($type == null)
                $this->redirect(['controller'=>'Messages','action'=>'index']);
            else
                $this->redirect(['controller'=>'Users','action'=>$type, $source]);
        }

        $this->set(compact('following'));
    }


    public function delete($id = null, $type = null, $source = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $following = $this->Following->find()->where(['user_id = ' => $this->Auth->user()['id']])->andWhere(['follower_id = ' => $id])->first();
        if ($this->Following->delete($following)) {
            $this->Flash->success(__('フォローを解除しました'));
        }
        if($type == null)
            $this->redirect(['controller'=>'Messages','action'=>'index']);
        else
            $this->redirect(['controller'=>'Users','action'=>$type, $source]);
    }
}
