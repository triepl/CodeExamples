<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Book'), ['action' => 'edit', $book->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Book'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Publishers'), ['controller' => 'Publishers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Publisher'), ['controller' => 'Publishers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders Items'), ['controller' => 'OrdersItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Orders Item'), ['controller' => 'OrdersItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Raitings'), ['controller' => 'Raitings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raiting'), ['controller' => 'Raitings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="books view large-9 medium-8 columns content">
    <h3><?= h($book->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Isbn') ?></th>
            <td><?= h($book->isbn) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($book->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Author') ?></th>
            <td><?= h($book->author) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publisher') ?></th>
            <td><?= $book->has('publisher') ? $this->Html->link($book->publisher->name, ['controller' => 'Publishers', 'action' => 'view', $book->publisher->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $book->has('user') ? $this->Html->link($book->user->username ,
            ['controller' => 'Users', 'action' => 'view' ,
            $book->user->id]) : '' ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($book->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Num Pages') ?></th>
            <td><?= $this->Number->format($book->num_pages) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prize') ?></th>
            <td><?= $this->Number->format($book->prize) ?></td>
        </tr>
        <tr>
           <th scope="row"><?= __('Img') ?></th>
           <td><?= $this->Number->format($book->img) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($book->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($book->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Subtitle') ?></h4>
        <?= $this->Text->autoParagraph(h($book->subtitle)); ?>
    </div>
    <div class="row">
        <h4><?= __('Abstract') ?></h4>
        <?= $this->Text->autoParagraph(h($book->abstract)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Orders Items') ?></h4>
        <?php if (!empty($book->orders_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Book Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Item Price') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($book->orders_items as $ordersItems): ?>
            <tr>
                <td><?= h($ordersItems->id) ?></td>
                <td><?= h($ordersItems->order_id) ?></td>
                <td><?= h($ordersItems->book_id) ?></td>
                <td><?= h($ordersItems->amount) ?></td>
                <td><?= h($ordersItems->item_price) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'OrdersItems', 'action' => 'view', $ordersItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'OrdersItems', 'action' => 'edit', $ordersItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrdersItems', 'action' => 'delete', $ordersItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordersItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Raitings') ?></h4>
        <?php if (!empty($book->raitings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Book Id') ?></th>
                <th scope="col"><?= __('Raiting') ?></th>
                <th scope="col"><?= __('Raiting Comment') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($book->raitings as $raitings): ?>
            <tr>
                <td><?= h($raitings->id) ?></td>
                <td><?= h($raitings->user_id) ?></td>
                <td><?= h($raitings->book_id) ?></td>
                <td><?= h($raitings->raiting) ?></td>
                <td><?= h($raitings->raiting_comment) ?></td>
                <td><?= h($raitings->created) ?></td>
                <td><?= h($raitings->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Raitings', 'action' => 'view', $raitings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Raitings', 'action' => 'edit', $raitings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Raitings', 'action' => 'delete', $raitings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $raitings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tags') ?></h4>
        <?php if (!empty($book->tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($book->tags as $tags): ?>
            <tr>
                <td><?= h($tags->id) ?></td>
                <td><?= h($tags->title) ?></td>
                <td><?= h($tags->created) ?></td>
                <td><?= h($tags->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
