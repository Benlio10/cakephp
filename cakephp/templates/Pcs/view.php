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
            <?= $this->Html->link(__('Edit Pc'), ['action' => 'edit', $pc->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Pc'), ['action' => 'delete', $pc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pc->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Pcs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Pc'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pcs view content">
            <h3><?= h($pc->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($pc->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($pc->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
