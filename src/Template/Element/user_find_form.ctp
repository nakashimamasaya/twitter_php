<div class='user__find clearfix'>
  <?= $this->Form->create(false, ['url' => 'users/result']) ?>
  <?= $this->Form->control('find',['label' => '誰を検索しますか', 'type' => 'text']); ?>
  <?= $this->Form->button('検索') ?>
  <?= $this->Form->end() ?>
</div>
<p>ユーザー名や名前で検索</p>
