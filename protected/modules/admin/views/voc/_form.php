<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'vocabulary-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div>
    <?php    
    echo $form->textFieldRow($model, 'name', array(
        'class' => 'span5',
        'maxlength' => 255,
        'onkeyup' => CHtml::ajax(
                    array(
                        'type' => 'POST',
                        'url' => $this->createUrl('generateAlias'),
                        'success' => 'function(html) {
                            $("#Vocabulary_alias").val(html)
                        }'
                    )
            ),
        ));
    echo $form->textFieldRow($model, 'alias', array('class' => 'span5', 'maxlength' => 255));
    echo $form->textAreaRow($model, 'description', array('rows' => 6, 'cols' => 50, 'class' => 'span8'));
    echo $form->textFieldRow($model, 'weight', array('class' => 'span5'));
    ?>    
</div>

<div class="form-actions text-center">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger')); ?>
</div>

<?php $this->endWidget(); ?>
