<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Orders Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ordersItems index large-9 medium-8 columns content">
    <h3><?= __('Orders Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_price') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ordersItems as $ordersItem): ?>
            <tr>
                <td><?= $this->Number->format($ordersItem->id) ?></td>
                <td><?= $ordersItem->has('order') ? $this->Html->link($ordersItem->order->id, ['controller' => 'Orders', 'action' => 'view', $ordersItem->order->id]) : '' ?></td>
                <td><?= $ordersItem->has('book') ? $this->Html->link($ordersItem->book->title, ['controller' => 'Books', 'action' => 'view', $ordersItem->book->id]) : '' ?></td>
                <td><?= $this->Number->format($ordersItem->amount) ?></td>
                <td><?= $this->Number->format($ordersItem->item_price) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ordersItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ordersItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ordersItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordersItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
