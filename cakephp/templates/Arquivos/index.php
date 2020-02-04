<?php echo $this->Form->create('Arquivo', array('type' => 'file')); ?>
<label for="">Arquivo</label>
<?php
    echo $this->Form->file('uploadfile', array('multiple'));
    echo $this->Form->end('Enviar');
?>
