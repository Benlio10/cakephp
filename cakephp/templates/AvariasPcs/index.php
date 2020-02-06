<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AvariasPc[]|\Cake\Collection\CollectionInterface $avariasPcs
 */
?>
<div class="avariasPcs index content">
    <?= $this->Html->link(__('New Avarias Pc'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Avarias Pcs') ?></h3>
    <aside id="sidebar-wrapper">
        <?= $this->element('sidebar'); ?>
    </aside>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('pc_id') ?></th>
                    <th><?= $this->Paginator->sort('avaria_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avariasPcs as $avariasPc): ?>
                <tr>
                    <td><?= $this->Number->format($avariasPc->id) ?></td>
                    <td><?= $avariasPc->has('pc') ? $this->Html->link($avariasPc->pc->name, ['controller' => 'Pcs', 'action' => 'view', $avariasPc->pc->id]) : '' ?></td>
                    <td><?= $avariasPc->has('avaria') ? $this->Html->link($avariasPc->avaria->id, ['controller' => 'Avarias', 'action' => 'view', $avariasPc->avaria->id]) : '' ?></td>
                    <td><?= h($avariasPc->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $avariasPc->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $avariasPc->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $avariasPc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $avariasPc->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
