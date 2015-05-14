<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'menu-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->dropDownListRow($model, 'type_id', array(Menu::MAIN_MENU => 'Main Menu', Menu::ADMIN_MENU => 'Admin Menu'), array(
    'empty' => ' === Select === ',
    'class' => 'span5',
    'ajax' => array(
        'type' => 'POST',
        'url' => $this->createUrl('loadDynamicType'),
        'update' => '#Menu_parent_id',
    )
));

echo $form->dropDownListRow($model, 'parent_id', $parent, array('class' => 'span5'));
echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 64,
    'onblur' => CHtml::ajax(
            array(
                'type' => 'POST',
                'url' => url('admin/default/generateAlias', array('model' => get_class($model), 'att' => 'name')),
                'success' =>
                'function(html) { $("#' . get_class($model) . '_alias").val(html) }'
            )
    ),));
echo $form->textFieldRow($model, 'alias', array('class' => 'span5', 'maxlength' => 64));
echo $form->textFieldRow($model, 'url', array('class' => 'span5', 'maxlength' => 128));
echo $form->textFieldRow($model, 'weight', array('class' => 'span5'));
echo $form->textFieldRow($model, 'status', array('class' => 'span5'));
echo $form->textFieldRow($model, 'visible_expression', array('class' => 'span5', 'maxlength' => 155));
?>
<div class="form-actions text-center">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger')); ?>
</div>

<?php $this->endWidget(); ?>
