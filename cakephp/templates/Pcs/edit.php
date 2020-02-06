<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pc $pc
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pc->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pc->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Pcs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pcs form content">
            <?= $this->Form->create($pc) ?>
            <fieldset>
                <legend><?= __('Edit Pc') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('avarias._ids', ['options' => $avarias]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
