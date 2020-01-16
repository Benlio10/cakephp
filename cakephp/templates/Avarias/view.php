<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Avaria $avaria
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Avaria'), ['action' => 'edit', $avaria->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Avaria'), ['action' => 'delete', $avaria->id], ['confirm' => __('Are you sure you want to delete # {0}?', $avaria->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Avarias'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Avaria'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="avarias view content">
            <h3><?= h($avaria->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Body') ?></th>
                    <td><?= h($avaria->body) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($avaria->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
