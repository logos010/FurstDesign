<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'type' => 'inline',
)); ?>

<?php 
 echo $form->textFieldRow($model,'id',array('class'=>'span5'));
echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>150));
echo $form->textFieldRow($model,'alias',array('class'=>'span5','maxlength'=>150));
echo $form->textFieldRow($model,'uri',array('class'=>'span5','maxlength'=>255));
echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>255));
echo $form->textFieldRow($model,'sku',array('class'=>'span5','maxlength'=>15));
echo $form->textFieldRow($model,'quatity',array('class'=>'span5'));
echo $form->textFieldRow($model,'price',array('class'=>'span5'));
echo $form->textFieldRow($model,'wholesale_price',array('class'=>'span5'));
echo $form->textFieldRow($model,'bought',array('class'=>'span5'));
echo $form->textFieldRow($model,'discount',array('class'=>'span5'));
echo $form->textFieldRow($model,'sale_promotion',array('class'=>'span5'));
echo $form->textFieldRow($model,'like',array('class'=>'span5'));
echo $form->textFieldRow($model,'subscripbe',array('class'=>'span5'));
echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8'));
echo $form->textAreaRow($model,'detail',array('rows'=>6, 'cols'=>50, 'class'=>'span8'));
echo $form->textFieldRow($model,'status',array('class'=>'span5'));
echo $form->textFieldRow($model,'create',array('class'=>'span5'));
echo $form->textFieldRow($model,'update',array('class'=>'span5'));

?>
	<div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Submit')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Reset')); ?>
        </div>

<?php $this->endWidget(); ?>
