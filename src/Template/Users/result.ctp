<?php
  echo $this->Html->css('find.css');
  echo $this->Html->script('add_follower.js');
?>
<?php if(isset($find)): ?>
  <h1><?= h($find) ?>の検索結果:</h1>
<?php endif ?>
<?= $this->element('user_find_form')?>
<?php if($results->count() == 0 || is_null($find)):?>
  <h1 id='zero_result'>対象のユーザはいません</h1>
<?php else: ?>
  <?php foreach($results as $result): ?>
    <div class='find_list clearfix'>
      <?= $result->id ?>
      <?= $this->Html->link($result->username, ['controller' => 'Users', 'action' => 'view', $result->id]) ?> :
      <?= $result->name ?>
      <br>
      <?php if(isset($result->messages[0])): ?>
        <?= nl2br($this->Text->autoLink(end($result->messages)['body'])) ?>
        <br>
        <?= h(end($result->messages)['stamp']->i18nFormat('YYYY年MM月dd日 HH時mm分ss秒')) ?>
      <?php else: ?>
        <p>まだツイートしていません</p>
      <?php endif ?>
      <?php if(isset($user) && !in_array($result->id, $follower) && $user['id'] != $result->id): ?>
        <div class='follow_<?= $result->id ?>'>
          <div class='error_message' id='error_<?= $result->id ?>'></div>
          <?php echo "<div class='button' id='$result->id'>フォローする</div>"?>
        </div>
      <?php endif ?>
    </div>
  <?php endforeach ?>
  <div class="paginator">
    <ul class="pagination">
      <?= $this->Paginator->prev('< ' . __('前へ')) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next(__('次へ') . ' >') ?>
    </ul>
  </div>
<?php endif ?>
