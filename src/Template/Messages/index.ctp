<?php
 echo $this->Html->css('message.css');
 echo $this->Html->script('submit_button.js');
?>

<?php if(isset($user)): ?>
    <div class="messages form large-9 medium-8 columns content message__form">
        <h1>いまなにしてる？</h1>
        <?= $this->Form->create($message) ?>
        <fieldset>
            <?php
                echo $this->Form->error('body');
                echo $this->Form->console('body',[
                    'label' => '',
                    'required' => true,
                    'type' => 'textarea',
                    'error' => false
                ]);
            ?>
        </fieldset>
        <div class='latest_message'>
            <b>最新つぶやき</b>
            <?php if(isset($latest_message)): ?>
                <?= nl2br($this->Text->autoLink($latest_message->body)) ?>
                <br>
                <?php echo $latest_message->stamp->i18nFormat('YYYY-MM-dd HH:mm:ss') ?>
            <?php else: ?>
                <p>つぶやきはありません</p>
            <?php endif ?>
        </div>
        <?= $this->Form->button(__('投稿する')) ?>
        <?= $this->Form->end() ?>
    </div>
<?php endif ?>

<?= $this->element('message_list',[
    'messages' => $messages,
    'show_user' => $user,
    'user' => $user,
    'message_count' => $message_count
    ])
?>

<?php if(isset($user)): ?>
    <?= $this->element('user_details',[
        'show_user' => $user,
        'message_count' => $message_count,
        'follow' => $follow,
        'follower' => $follower,
        ])
    ?>
<?php endif ?>
