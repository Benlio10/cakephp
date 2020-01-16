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
            <?= $this->Html->link(__('Edit Registo Avaria'), ['action' => 'edit', $registoAvaria->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Registo Avaria'), ['action' => 'delete', $registoAvaria->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registoAvaria->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Registo Avarias'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Registo Avaria'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="registoAvarias view content">
            <h3><?= h($registoAvaria->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($registoAvaria->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Pc') ?></th>
                    <td><?= $this->Number->format($registoAvaria->id_pc) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Avaria') ?></th>
                    <td><?= $this->Number->format($registoAvaria->id_avaria) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($registoAvaria->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
