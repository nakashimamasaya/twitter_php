<?php if($length > 0):?>
  <div class="message__list left">
    <?php foreach($results as $result): ?>
      <div class='message__index clearfix'>
        <?= $this->Html->link($result->user->username, ['controller' => 'Users', 'action' => 'view', $result->user->id]) ?> :
        <?= $result->user->name ?>
        <br>
        <?php if(isset($result->user->messages[0])): ?>
          <?= nl2br(end($result->user->messages)['body']) ?>
          <br>
          <?= h(end($result->user->messages)['stamp']->i18nFormat('YYYY-MM-dd HH:mm:ss')) ?>
        <?php else: ?>
          <p>まだツイートしていません</p>
        <?php endif ?>
        <?php if(!in_array($result->user->id, $follow) && $user['id'] != $result->user->id): ?>
          <div class="actions">
            <?= $this->Form->postLink(__('フォロー設定'), ['controller' => 'following','action' => 'add', $result->user->id, $type, $show_user->id], ['confirm' => __('フォローしてよろしいですか？')]) ?>
          </div>
        <?php elseif($user['id'] != $result->user->id): ?>
          <div class="actions">
            <?= $this->Form->postLink(__('フォロー設定'), ['controller' => 'following','action' => 'delete', $result->user->id, $type, $show_user->id], ['confirm' => __('フォローを解除してよろしいですか？')]) ?>
          </div>
        <?php endif ?>
      </div>
    <?php endforeach ?>
    <div class="paginator">
      <ul cass="pagination">
        <?= $this->Paginator->prev('< ' . __('前へ')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('次へ') . ' >') ?>
      </ul>
    </div>
  </div>
<?php else: ?>
  <h2>対象のユーザーはいません</h2>
<?php endif ?>
