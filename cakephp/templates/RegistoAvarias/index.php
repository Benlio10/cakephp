<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistoAvaria[]|\Cake\Collection\CollectionInterface $registoAvarias
 */
?>
<div class="registoAvarias index content">
    <?= $this->Html->link(__('New Registo Avaria'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Registo Avarias') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('id_pc') ?></th>
                    <th><?= $this->Paginator->sort('id_avaria') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registoAvarias as $registoAvaria): ?>
                <tr>
                    <td><?= $this->Number->format($registoAvaria->id) ?></td>
                    <td><?= $this->Number->format($registoAvaria->id_pc) ?></td>
                    <td><?= $this->Number->format($registoAvaria->id_avaria) ?></td>
                    <td><?= h($registoAvaria->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $registoAvaria->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registoAvaria->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $registoAvaria->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registoAvaria->id)]) ?>
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
