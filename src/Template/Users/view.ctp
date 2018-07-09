<?php
 echo $this->Html->css('message.css');
?>

<?= $this->element('message_list',[
    'messages' => $messages,
    'show_user' => $show_user,
    'user' => $user,
    'message_count' => $message_count
    ])
?>

<?= $this->element('user_details',[
    'messages' => $messages,
    'show_user' => $show_user,
    'user' => $user,
    'message_count' => $message_count,
    'follow' => $follow,
    'follower' => $follower
    ])
?>
