<?php
  echo $this->Html->css('find.css');
  echo $this->Html->script('add_follower.js');
?>
<h1><?= $find ?>の検索結果:</h1>
<?= $this->element('user_find_form')?>
<?php foreach($results as $result): ?>
  <div class='find_list clearfix'>
    <?= $result->id ?>
    <?= $this->Html->link($result->username, ['controller' => 'Users', 'action' => 'view', $result->id]) ?> :
    <?= $result->name ?>
    <br>
    <?php if(isset($result->messages[0])): ?>
      <?= nl2br(end($result->messages)['body']) ?>
      <br>
      <?= h(end($result->messages)['stamp']->i18nFormat('YYYY-MM-dd HH:mm:ss')) ?>
    <?php else: ?>
      <p>まだツイートしていません</p>
    <?php endif ?>
    <?php if(!in_array($result->id, $follower)): ?>
      <div class='follow_<?= $result->id ?>'>
        <div class='error_message' id='error_<?= $result->id ?>'></div>
        <?php echo "<div class='button' id='$result->id'>フォローする</div>"?>
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
