<?php
  echo $this->Html->css('message.css');
?>
<h1><?= $show_user->username ?>は <?= count($follow) ?>人フォローしています</h1>

<?= $this->element('user_list',[
  'results' => $users,
  'show_user' => $show_user,
  'user' => $user,
  'follow' => $login_user_follow,
  'length' => count($follow),
  'type' => 'follow'
  ])
?>

<?= $this->element('user_details',[
  'show_user' => $show_user,
  'message_count' => $message_count,
  'follow' => $follow,
  'follower' => $follower
  ])
?>
