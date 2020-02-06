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
            <h3><?= h($pc->name) ?></h3>
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
            <div class="related">
                <h4><?= __('Related Avarias') ?></h4>
                <?php if (!empty($pc->avarias)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Body') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($pc->avarias as $avarias) : ?>
                        <tr>
                            <td><?= h($avarias->id) ?></td>
                            <td><?= h($avarias->body) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Avarias', 'action' => 'view', $avarias->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Avarias', 'action' => 'edit', $avarias->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Avarias', 'action' => 'delete', $avarias->id], ['confirm' => __('Are you sure you want to delete # {0}?', $avarias->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
