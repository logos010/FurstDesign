<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'translate-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->dropDownlistRow($model, 'language_code', array(
    'en' => 'English'
        ), array('class' => 'span5', 'maxlength' => 8));
echo $form->dropDownlistRow($model, 'category', array(
    UTranslate::CATEGORY_BUTTON => ucfirst(UTranslate::CATEGORY_BUTTON),
    UTranslate::CATEGORY_LABEL => ucfirst(UTranslate::CATEGORY_LABEL),
    UTranslate::CATEGORY_MENU => ucfirst(UTranslate::CATEGORY_MENU),
    UTranslate::CATEGORY_MODEL => ucfirst(UTranslate::CATEGORY_MODEL)
        ), array('class' => 'span5', 'maxlength' => 255));
echo $form->textFieldRow($model, 'message', array('class' => 'span5', 'maxlength' => 128));
echo $form->textFieldRow($model, 'translation', array('class' => 'span5', 'maxlength' => 255));
?>
<div class="form-actions text-center">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger')); ?>
</div>

<?php $this->endWidget(); ?>
