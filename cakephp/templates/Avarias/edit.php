<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Avaria $avaria
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $avaria->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $avaria->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Avarias'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="avarias form content">
            <?= $this->Form->create($avaria) ?>
            <fieldset>
                <legend><?= __('Edit Avaria') ?></legend>
                <?php
                    echo $this->Form->control('body');
                    echo $this->Form->control('pcs._ids', ['options' => $pcs]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
