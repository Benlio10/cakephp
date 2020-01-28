<br>
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel-register">
        <?= $this->Form->create($user); ?>
        <fieldset>
        <legend><?=__('Novo Registo')?></legend>
            <?php
                echo $this->Form->control('name');
                echo $this->Form->control('email');
                echo $this->Form->control('password');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Registar')); ?>
        <?= $this->Form->end();?>
    </div>
</div>
