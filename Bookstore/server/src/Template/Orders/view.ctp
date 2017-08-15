<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders Items'), ['controller' => 'OrdersItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Orders Item'), ['controller' => 'OrdersItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orders view large-9 medium-8 columns content">
    <h3><?= h($order->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $order->has('user') ? $this->Html->link($order->user->id, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($order->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prize Brutto') ?></th>
            <td><?= $this->Number->format($order->prize_brutto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prize Netto') ?></th>
            <td><?= $this->Number->format($order->prize_netto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vat') ?></th>
            <td><?= $this->Number->format($order->vat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($order->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($order->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Orders Items') ?></h4>
        <?php if (!empty($order->orders_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Book Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Item Price') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->orders_items as $ordersItems): ?>
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
</div>
