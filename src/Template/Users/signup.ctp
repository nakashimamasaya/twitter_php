<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
 echo $this->Html->css('user.css');
?>
<div class="users form large-9 medium-8 columns content">
    <h2>ついったーに参加しましょう
        <div class='login'>
            もうついったーに登録していますか？
            <?php
                echo $this->Html->link('ログイン',['action' => 'login'])
            ?>
        </div>
    </h2>
    
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
            echo $this->Form->control('name', [
                'label' => '名前'
            ]);
            echo $this->Form->control('username', [
                'label' => 'ユーザー名'
            ]);
            echo $this->Form->control('password', [
                'label' => 'パスワード'
            ]);
            echo $this->Form->input('password_confirm',[
                'type' => 'password',
                'label' => 'パスワード（確認）'
            ]);
            echo $this->Form->control('email', [
                'label' => 'メールアドレス'
            ]);
            echo $this->Form->control('private', [
                'label' => 'つぶやきを非公開にする',
                'id' => 'check'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('アカウントを作成する')) ?>
    <?= $this->Form->end() ?>
</div>
