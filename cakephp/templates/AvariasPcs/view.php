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
            <?= $this->Html->link(__('Edit Avarias Pc'), ['action' => 'edit', $avariasPc->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Avarias Pc'), ['action' => 'delete', $avariasPc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $avariasPc->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Avarias Pcs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Avarias Pc'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="avariasPcs view content">
            <h3><?= h($avariasPc->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Pc') ?></th>
                    <td><?= $avariasPc->has('pc') ? $this->Html->link($avariasPc->pc->name, ['controller' => 'Pcs', 'action' => 'view', $avariasPc->pc->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Avaria') ?></th>
                    <td><?= $avariasPc->has('avaria') ? $this->Html->link($avariasPc->avaria->id, ['controller' => 'Avarias', 'action' => 'view', $avariasPc->avaria->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($avariasPc->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($avariasPc->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
