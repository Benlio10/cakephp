<?php echo $this->Form->create(null, ['type' => 'file']); ?>
<label>Arquivos</label>
<?php
	echo $this->Form->file('uploadfile.', ['multiple']);
	echo $this->Form->button('Submit', ['type' => 'submit']);
	echo $this->Form->end();
 ?>
