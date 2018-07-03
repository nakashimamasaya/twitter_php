<?php
/**
 * @var \App\View\AppView $this
 */
 echo $this->Html->css('user.css');
?>
<div class="login__form">
  <div class="users form">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('ログイン') ?></legend>
        <?= $this->Form->control('username', ['label' => 'ユーザID', 'required' => true]) ?>
        <?= $this->Form->control('password', ['label' => 'パスワード', 'required' => true]) ?>
    </fieldset>
    <?= $this->Form->button(__('ログイン')); ?>
    <?= $this->Form->end() ?>
  </div>
  <div class="signup">
    <h5>ユーザー登録(無料)</h5>
    <?php
        echo $this->Html->link('ユーザー登録',['action' => 'signup'])
    ?>
  </div>
</div>
