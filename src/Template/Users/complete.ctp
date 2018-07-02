<?php
    echo $this->Html->css('user.css');
?>

<div class='signup__success'>
    <h2>ついったーに参加しました。</h2>
    <p><?= $user->username ?>さんはついったーに参加されました。</p>
    <p>ログインをクリックしてログインしつぶやいてください。</p>
    <?php
        echo $this->Html->link('twitterにログイン',['action' => 'login'])
    ?>
</div>
