<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistoAvaria $registoAvaria
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $registoAvaria->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $registoAvaria->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Registo Avarias'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="registoAvarias form content">
            <?= $this->Form->create($registoAvaria) ?>
            <fieldset>
                <legend><?= __('Edit Registo Avaria') ?></legend>
                <?php
                    echo $this->Form->control('id_pc');
                    echo $this->Form->control('id_avaria');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
