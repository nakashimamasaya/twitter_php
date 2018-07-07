<div class="messages index large-9 medium-8 content message__list columns">
    <h3><?= __('ホーム') ?></h3>
    <?php foreach ($messages as $message): ?>
        <div class='message__index'>
            <div class='message__body'>
                <?= $message->has('user') ? $this->Html->link($message->user->name, ['controller' => 'Users', 'action' => 'view', $message->user->id]) : '' ?>
                <?= nl2br($this->Text->autoLink($message->body)) ?>
                <!-- <?php echo $this->Text->autoLink($message->body) ?> -->
            </div>
            <div class='message__stamp'>
                <?= h($message->stamp->i18nFormat('YYYY-MM-dd HH:mm:ss')) ?>
            </div>
            <?php if($user['id'] == $message->user->id): ?>
                <div class="actions">
                    <?= $this->Form->postLink(__('削除'), ['controller' => 'messages','action' => 'delete', $message->id], ['confirm' => __('削除してよろしいですか？ # {0}?', $message->id)]) ?>
                </div>
            <?php endif ?>
        </div>
    <?php endforeach; ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('前へ')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('次へ') . ' >') ?>
        </ul>
    </div>
</div>
<?php if(isset($show_user)): ?>
    <div class="user_profile">
        <h3><?= h($show_user['username']) ?></h3>
        <table>
            <thead>
                <tr>
                    <th>フォロー数</th>
                    <th>フォロワー数</th>
                    <th><?= $message->has('user') ? $this->Html->link('投稿数', ['controller' => 'Users', 'action' => 'view', $message->user->id]) : '' ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0</td>
                    <td>0</td>
                    <td><?= $message_count ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif ?>