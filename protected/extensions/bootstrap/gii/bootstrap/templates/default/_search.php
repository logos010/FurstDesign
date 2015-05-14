<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get',
        'type' => 'inline',
)); ?>\n"; ?>

<?php 
echo "<?php \n ";
foreach($this->tableSchema->columns as $column): ?>
<?php
	$field=$this->generateInputField($this->modelClass,$column);
	if(strpos($field,'password')!==false)
		continue;
            echo "echo ".$this->generateActiveRow($this->modelClass,$column).";\n"; 
        endforeach;
        echo "\n?>\n";
?>
	<div class="form-actions">
            <?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Submit')); ?>\n"; ?>
            <?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Reset')); ?>\n"; ?>
        </div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
