<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Raiting'), ['action' => 'edit', $raiting->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Raiting'), ['action' => 'delete', $raiting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $raiting->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Raitings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raiting'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="raitings view large-9 medium-8 columns content">
    <h3><?= h($raiting->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $raiting->has('user') ? $this->Html->link($raiting->user->id, ['controller' => 'Users', 'action' => 'view', $raiting->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book') ?></th>
            <td><?= $raiting->has('book') ? $this->Html->link($raiting->book->title, ['controller' => 'Books', 'action' => 'view', $raiting->book->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($raiting->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Raiting') ?></th>
            <td><?= $this->Number->format($raiting->raiting) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($raiting->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($raiting->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Raiting Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($raiting->raiting_comment)); ?>
    </div>
</div>
