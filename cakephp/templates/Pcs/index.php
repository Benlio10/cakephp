<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pc[]|\Cake\Collection\CollectionInterface $pcs
 */
?>
<div class="pcs index content">
    <?= $this->Html->link(__('New Pc'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Pcs') ?></h3>
    <?= $this->Html->link(__('Avarias'),['controller' => 'avarias']) ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pcs as $pc): ?>
                <tr>
                    <td><?= $this->Number->format($pc->id) ?></td>
                    <td><?= h($pc->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $pc->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pc->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pc->id)]) ?>
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
