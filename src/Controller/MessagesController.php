<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function index()
    {
        $this->loadModel('Following');
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Messages.id' => 'desc'
            ],
            'contain' => ['Users']
        ];
        $messages = $this->paginate($this->Messages);
        $latest_message = $this->Messages->find('all')->last();
        $user = $this->Auth->user();
        $message_count = $this->Messages->countMessage($user['id']);
        $follow = $this->Following->followUsers($user['id']);
        $follower = $this->Following->followerUsers($user['id']);

        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $stamp = Time::now();
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            $message->set([
                'stamp' => $stamp->i18nFormat('YYYY-MM-dd HH:mm:ss'),
                'user' => $user,
                'user_id' => $user['id']
            ]);
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('ツイートしました。'));

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('message', 'messages', 'latest_message', 'user', 'message_count', 'follow', 'follower'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('ツイートを削除しました。'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
