<div class="user_profile">
    <h3><?= h($show_user['username']) ?></h3>
    <table>
        <thead>
            <tr>
                <th><?= $this->Html->link('フォロー数', ['controller' => 'Users', 'action' => 'follow', $show_user['id']]) ?></th>
                <th><?= $this->Html->link('フォロワー数', ['controller' => 'Users', 'action' => 'follower', $show_user['id']]) ?></th>
                <?php if($this->request->action == 'index'): ?>
                    <th><?= $this->Html->link('投稿数', ['controller' => 'Users', 'action' => 'view', $show_user['id']]) ?></th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td><?php echo count($follow) ?></td>
                <td><?php echo count($follower) ?></td>
                <?php if($this->request->action == 'index'): ?>
                    <td><?= $message_count ?></td>
                <?php endif ?>
            </tr>
        </tbody>
    </table>
    <?php if($this->request->action != 'index'): ?>
        <div class="tweet clearfix">
            <?= $this->Html->link(
                "<div class='tweet__title'>つぶやき</div><div class='tweet__count'>${message_count}</div>",
                ['controller' => 'Users', 'action' => 'view', $show_user['id']],
                ['escape'=>false]
            ); ?>
        </div>
    <?php endif ?>
</div>
