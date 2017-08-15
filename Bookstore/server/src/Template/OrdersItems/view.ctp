<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Orders Item'), ['action' => 'edit', $ordersItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Orders Item'), ['action' => 'delete', $ordersItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordersItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Orders Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Orders Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ordersItems view large-9 medium-8 columns content">
    <h3><?= h($ordersItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Order') ?></th>
            <td><?= $ordersItem->has('order') ? $this->Html->link($ordersItem->order->id, ['controller' => 'Orders', 'action' => 'view', $ordersItem->order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book') ?></th>
            <td><?= $ordersItem->has('book') ? $this->Html->link($ordersItem->book->title, ['controller' => 'Books', 'action' => 'view', $ordersItem->book->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ordersItem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($ordersItem->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Price') ?></th>
            <td><?= $this->Number->format($ordersItem->item_price) ?></td>
        </tr>
    </table>
</div>
