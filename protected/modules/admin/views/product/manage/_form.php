<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'product-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'stateful' => true,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="panel panel-primary">
    <div class="panel-body">
        <div class="row-fluid">
            <div class="pull-left span6">
                <?php
                echo $form->textFieldRow($model, 'name', array(
                    'class' => 'span10',
                    'maxlength' => 150,
                    'onkeyup' => CHtml::ajax(
                            array(
                                'type' => 'POST',
                                'url' => $this->createUrl('generateAlias'),
                                'success' => 'function(html) {
                            $("#Product_alias").val(html)
                        }'
                            )
                    ),
                ));

                echo $form->textFieldRow($model, 'alias', array('class' => 'span10', 'maxlength' => 150));
                echo $form->fileFieldRow($model, 'image', array('class' => 'span10', 'maxlength' => 255));
                
                if ($model->image != '') {
                    echo CHtml::image(BASE_URL . '/' . $model->image, $v->name, array('width' => '80'));
                }
                echo $form->textFieldRow($model, 'quantity', array(
                    'class' => 'span10',
                    'onkeyup' => "$('#Product_quantity').val($.number($(this).val()));"
                ));

                echo $form->textFieldRow($model, 'price', array(
                    'class' => 'span10',
                    'onkeyup' => "$('#Product_price').val($.number($(this).val()));"
                ));
                echo $form->textFieldRow($model, 'discount', array(
                    'class' => 'span10',
//                    'onkeyup' => "$('#Product_discount').val($.number($(this).val()));"
                ));
                echo $form->textFieldRow($model, 'sale_promotion', array('class' => 'span10'));
//                echo $form->labelEx($model, 'status');
                echo $form->dropDownlistRow($model, 'status', array(1 => 'Active', 0 => 'Inactive'), array('class' => 'span10'));
                echo $form->dropDownlistRow($model, 'promote', array(1 => 'Active', 0 => 'Inactive'), array('class' => 'span10'));
                ?>                
            </div>
            <div class="pull-left span6" style="height: 500px; border: 1px solid #4b4b4b; padding: 5px; overflow-y: scroll">
                <?php echo $form->checkBoxListRow($model, 'cate', $term); ?>
            </div>
            <div class="pull-left span12">
                <?php
                echo $form->labelEx($model, 'description');
                $this->widget('application.extensions.gui.tinymce.ETinyMce', array(
                    'name' => 'Product[description]',
                    'value' => $model->description,
                    'editorTemplate' => 'simple',
                    'width' => '800px',
                    'height' => '150px'
                ));
                echo $form->labelEx($model, 'detail');
                $this->widget('application.extensions.gui.tinymce.ETinyMce', array(
                    'name' => 'Product[detail]',
                    'value' => $model->detail,
                    'editorTemplate' => 'full',
                    'width' => '800px',
                    'height' => '150px',                    
                ));
                ?>
            </div>
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger')); ?>
</div>

<?php $this->endWidget(); ?>
