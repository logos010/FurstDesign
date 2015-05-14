<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'term-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="panel panel-primary">
    <div class="panel-body">
        <div class="row-fluid">
            <div class="pull-left span6">
                <?php
                echo $form->dropDownlistRow($model, 'vid', $vocabulary, array(
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => $this->createUrl('loadDynamicTerm'),
                        'update' => '#Term_parent_id',
                    ),
                    'class' => 'span10',
                    'empty' => ' === Select ===',
                ));
                echo $form->dropDownlistRow($model, 'parent_id', $term, array('class' => 'span10', 'size' => 12));
                ?>
            </div>
            <div class="pull-left span6">
                <?php
                echo $form->textFieldRow($model, 'name', array('class' => 'span10', 'maxlength' => 255,
                    'onblur' => CHtml::ajax(
                            array(
                                'type' => 'POST', 'url' => url('admin/default/generateAlias', array('model' => get_class($model), 'att' => 'name')),
                                'success' =>
                                'function(html) { $("#' . get_class($model) . '_alias").val(html) }'
                    )),
                ));
                echo $form->textFieldRow($model, 'alias', array('class' => 'span10', 'maxlength' => 255));
//        echo $form->textFieldRow($model, 'name_seo', array('class' => 'span10', 'maxlength' => 255));
                echo $form->textFieldRow($model, 'url', array('class' => 'span10', 'maxlength' => 255));
                echo $form->dropDownlistRow($model, 'status', array(1 => 'Active', 0 => 'Inactive'), array('class' => 'span10'));
                echo $form->textFieldRow($model, 'weight', array('class' => 'span10'));
                ?>
            </div>
        </div>
    </div>
</div>

<?php echo $form->textAreaRow($model, 'description', array('rows' => 6, 'class' => 'span11')); ?>
<div class="form-actions text-center">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger')); ?>
</div>

<?php $this->endWidget(); ?>
