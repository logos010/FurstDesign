<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'gallery-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation' => true,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
<?php 
 	echo $form->textFieldRow($model,'pid',array('class'=>'span5')); 
	echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>225)); 
	echo $form->textFieldRow($model,'uri',array('class'=>'span5','maxlength'=>225)); 
	echo $form->textFieldRow($model,'width',array('class'=>'span5')); 
	echo $form->textFieldRow($model,'height',array('class'=>'span5')); 
	echo $form->textFieldRow($model,'filesize',array('class'=>'span5')); 
	echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); 

?>
	<div class="form-actions text-center">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
                <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger'));?>
        </div>

<?php $this->endWidget(); ?>
