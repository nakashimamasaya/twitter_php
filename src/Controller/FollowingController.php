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
    public function add()
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
        $this->set(compact('following'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $following = $this->Following->get($id);
        if ($this->Following->delete($following)) {
            $this->Flash->success(__('The following has been deleted.'));
        } else {
            $this->Flash->error(__('The following could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
