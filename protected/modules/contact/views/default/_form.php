<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'contact-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p> 

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'fullname', array('class' => 'span5', 'maxlength' => 225)); ?>

<?php echo $form->textFieldRow($model, 'phone', array('class' => 'span5', 'maxlength' => 15)); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 126)); ?>

<?php echo $form->textFieldRow($model, 'address', array('class' => 'span5', 'maxlength' => 225)); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 225)); ?>

<?php
echo $form->textAreaRow($model, 'content', array('rows' => 6, 'cols' => 50, 'class' => 'span8'));
//    $this->widget('application.extensions.gui.tinymce.ETinyMce', array(
//                'name' => 'Contact[content]',
//                'value' => $model->content,
//                'editorTemplate' => 'simple',
//                'options' => array('theme_advanced_toolbar_location' => 'top'),
//                'htmlOptions' => array('style' => 'width: 60%')
//            ));
?>

<div class="form-actions text-center"> 
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')) . ' ' ?>
<?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger')) ?>
</div> 

<?php $this->endWidget(); ?>