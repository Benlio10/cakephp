<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AvariasPc $avariasPc
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Avarias Pcs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="avariasPcs form content">
            <?= $this->Form->create($avariasPc) ?>
            <fieldset>
                <legend><?= __('Add Avarias Pc') ?></legend>
                <?php
                    echo $this->Form->control('pc_id', ['options' => $pcs, 'empty' => true]);
                    echo $this->Form->control('avaria_id', ['options' => $avarias, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
