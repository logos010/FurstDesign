<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'type' => 'inline',
)); ?>

<?php 
 echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10));
echo $form->textFieldRow($model,'pid',array('class'=>'span5'));
echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>225));
echo $form->textFieldRow($model,'uri',array('class'=>'span5','maxlength'=>225));
echo $form->textFieldRow($model,'width',array('class'=>'span5'));
echo $form->textFieldRow($model,'height',array('class'=>'span5'));
echo $form->textFieldRow($model,'filesize',array('class'=>'span5'));
echo $form->textFieldRow($model,'create_time',array('class'=>'span5'));

?>
	<div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Submit')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Reset')); ?>
        </div>

<?php $this->endWidget(); ?>
