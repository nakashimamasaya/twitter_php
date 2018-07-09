<div class='user__find clearfix'>
  <?= $this->Form->create(false, ['action' => 'result']) ?>
  <?= $this->Form->input('find',['label' => '誰を検索しますか']); ?>
  <?= $this->Form->button('検索') ?>
  <?= $this->Form->end() ?>
</div>
<p>ユーザー名や名前で検索</p>
