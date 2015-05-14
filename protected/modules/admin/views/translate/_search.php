<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'type' => 'inline',
)); ?>

<?php 
 echo $form->textFieldRow($model,'id',array('class'=>'span5'));
echo $form->textFieldRow($model,'message',array('class'=>'span5','maxlength'=>128));
echo $form->textFieldRow($model,'category',array('class'=>'span5','maxlength'=>255));
echo $form->textFieldRow($model,'language_code',array('class'=>'span5','maxlength'=>8));
echo $form->textFieldRow($model,'translation',array('class'=>'span5','maxlength'=>255));

?>
	<div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Submit')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Reset')); ?>
        </div>

<?php $this->endWidget(); ?>
