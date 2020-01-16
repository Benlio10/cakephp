<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Avaria[]|\Cake\Collection\CollectionInterface $avarias
 */
?>
<div class="avarias index content">
    <?= $this->Html->link(__('New Avaria'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Avarias') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('body') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avarias as $avaria): ?>
                <tr>
                    <td><?= $this->Number->format($avaria->id) ?></td>
                    <td><?= h($avaria->body) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $avaria->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $avaria->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $avaria->id], ['confirm' => __('Are you sure you want to delete # {0}?', $avaria->id)]) ?>
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
