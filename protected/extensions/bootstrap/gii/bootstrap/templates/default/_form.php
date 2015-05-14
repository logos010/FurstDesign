<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation' => true,
)); ?>\n"; ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>
        
<?php
echo "<?php \n ";
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<?php echo "echo ".$this->generateActiveRow($this->modelClass,$column)."; \n"; ?>
<?php
} echo "\n?>\n";
?>
	<div class="form-actions text-center">
            <?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>\n"; ?>
                <?php echo "<?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger'));?>\n"; ?>
        </div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
