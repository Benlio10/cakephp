<?php
    echo $this->form->create("Localizations", array('url'=>'/locale'));
    echo $this->Form->radio('locale', [
        ['value' => 'en_US', 'text' => 'English'],
        ['value' => 'pt_PT', 'text' => 'Tuga'],
        ['value' => 'es_ES', 'text' => 'Esp'],
        ['value' => 'fr_FR', 'text' => 'Français'],
    ]);
    echo $this->Form->button('Change language');
    echo $this->Form->end();
?>
<?php echo __('msg'); ?>
<br>
<?php echo __('xpto'); ?>