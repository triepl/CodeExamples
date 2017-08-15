<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Books'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Publishers'), ['controller' => 'Publishers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Publisher'), ['controller' => 'Publishers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders Items'), ['controller' => 'OrdersItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Orders Item'), ['controller' => 'OrdersItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Raitings'), ['controller' => 'Raitings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raiting'), ['controller' => 'Raitings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="books form large-9 medium-8 columns content">
    <?= $this->Form->create($book) ?>
    <fieldset>
        <legend><?= __('Add Book') ?></legend>
        <?php
            echo $this->Form->control('isbn');
            echo $this->Form->control('title');
            echo $this->Form->control('subtitle');
            echo $this->Form->control('abstract');
            echo $this->Form->control('num_pages');
            echo $this->Form->control('author');
            echo $this->Form->control('prize');
            echo $this->Form->control('img');
            echo $this->Form->control('publisher_id', ['options' => $publishers, 'empty' => true]);
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
