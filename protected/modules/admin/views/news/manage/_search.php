<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'type' => 'inline',
)); ?>

<?php 
 echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10));
echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255));
echo $form->textFieldRow($model,'alias',array('class'=>'span5','maxlength'=>255));
echo $form->textFieldRow($model,'thumb',array('class'=>'span5','maxlength'=>255));
echo $form->textFieldRow($model,'teaser',array('class'=>'span5','maxlength'=>500));
echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8'));
echo $form->textFieldRow($model,'promote',array('class'=>'span5'));
echo $form->textFieldRow($model,'create_time',array('class'=>'span5'));
echo $form->textFieldRow($model,'publish_time',array('class'=>'span5'));
echo $form->textFieldRow($model,'update_time',array('class'=>'span5'));
echo $form->textFieldRow($model,'status',array('class'=>'span5'));

?>
	<div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Submit')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Reset')); ?>
        </div>

<?php $this->endWidget(); ?>
