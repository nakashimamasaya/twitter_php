<div class="user_profile">
    <h3><?= h($show_user['username']) ?></h3>
    <table>
        <thead>
            <tr>
                <th><?= $this->Html->link('フォロー数', ['controller' => 'Users', 'action' => 'follow', $show_user['id']]) ?></th>
                <th><?= $this->Html->link('フォロワー数', ['controller' => 'Users', 'action' => 'follower', $show_user['id']]) ?></th>
                <th><?= $this->Html->link('投稿数', ['controller' => 'Users', 'action' => 'view', $show_user['id']]) ?></th>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td><?php echo count($follow) ?></td>
                <td><?php echo count($follower) ?></td>
                <td><?= $message_count ?></td>
            </tr>
        </tbody>
    </table>
</div>
