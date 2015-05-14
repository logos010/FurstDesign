<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'type' => 'inline',
)); ?>

<?php 
 echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10));
echo $form->textFieldRow($model,'type_id',array('class'=>'span5','maxlength'=>10));
echo $form->textFieldRow($model,'parent_id',array('class'=>'span5'));
echo $form->textFieldRow($model,'alias',array('class'=>'span5','maxlength'=>64));
echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>64));
echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>128));
echo $form->textFieldRow($model,'weight',array('class'=>'span5'));
echo $form->textFieldRow($model,'level',array('class'=>'span5','maxlength'=>155));
echo $form->textFieldRow($model,'status',array('class'=>'span5'));
echo $form->textFieldRow($model,'create_time',array('class'=>'span5'));
echo $form->textFieldRow($model,'update_time',array('class'=>'span5'));
echo $form->textFieldRow($model,'visible_expression',array('class'=>'span5','maxlength'=>155));

?>
	<div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Submit')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Reset')); ?>
        </div>

<?php $this->endWidget(); ?>
