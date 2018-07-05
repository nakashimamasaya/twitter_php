<?php
 echo $this->Html->css('message.css');
?>

<div class="messages form large-9 medium-8 columns content message__form">
    <h1>いまなにしてる？</h1>
    <?= $this->Form->create($message) ?>
    <fieldset>
        <?php
            echo $this->Form->error('body');
            echo $this->Form->input('body',[
                'label' => '',
                'required' => true,
                'type' => 'textarea',
                'error' => false
            ]);
        ?>
    </fieldset>
    <div class='latest_message'>
        <b>最新つぶやき</b>
        <?= nl2br($this->Text->autoLink($latest_message->body)) ?>
        <br>
        <?php echo $latest_message->stamp->i18nFormat('YYYY-MM-dd HH:mm:ss') ?>
    </div>
    <?= $this->Form->button(__('投稿する')) ?>
    <?= $this->Form->end() ?>
</div>

<?= $this->element('message_list',[
    'messages' => $messages,
    'show_user' => $user,
    'user' => $user,
    'message_count' => $message_count
    ])
?>
