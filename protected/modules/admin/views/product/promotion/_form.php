<?php
/* @var $this PromotionController */
/* @var $model Promotion */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'prmotion-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'stateful' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    ));
    ?>

    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row-fluid">
                <p class="note">Fields with <span class="required">*</span> are required.</p>

                <?php echo $form->errorSummary($model); ?>

                <div class="pull-left span4">                    
                    <?php
                    echo $form->textFieldRow($model, 'name', array('class' => 'span10', 'maxlength' => 150,
                        'onkeyup' => CHtml::ajax(
                                array(
                                    'type' => 'POST',
                                    'url' => $this->createUrl('generateAlias'),
                                    'success' => 'function(html) {
                                            $("#Promotion_alias").val(html)
                                        }'
                                )
                        ),
                    ));
                    ?>
                    <?php echo $form->textFieldRow($model, 'alias', array('class' => 'span10', 'maxlength' => 150)); ?>
                    <?php echo $form->fileFieldRow($model, 'image', array('class' => 'span10', 'maxlength' => 255)); ?>
                    <?php echo $form->textFieldRow($model, 'url', array(
                        'class' => 'span10',
                        'maxlength' => 150,
                        'readonly' => true
                        )); ?>
                    <?php
                    echo $form->dropDownlistRow($model, 'position', array(
                        1 => 'Position 1',
                        2 => 'Position 2',
                        3 => 'Position 3',
                        4 => 'Position 4',
                        5 => 'Position 5',
                        6 => 'Position 6'));
                    ?>
                    <?php echo $form->dropDownlistRow($model, 'status', array(1 => 'Active', 0 => 'Inactive')); ?>
                </div>

                <div class="pull-left span3">
                    <?php if($model->image !== ''): ?>
                    <img src="<?php echo BASE_URL . "/" . $model->image; ?>" alt="<?php echo $model->name; ?>" />
                    <?php endif; ?>
                </div>
                
                <div class="pull-left span4" style="height: 500px; border: 1px solid #4b4b4b; padding: 5px; overflow-y: scroll">
                    <?php echo $form->checkBoxListRow($model, 'cate', $term, array(
                        'click' => 'alert(1)'
                    )) ?>
                </div>


                <div class="pull-left span12">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->

<script type="text/javascript">
    $("input[type='checkbox']").change(function(){
        if ($(this).is(':checked')){
            $("#Promotion_url").val('/product/cate/tid/'+$(this).val());
        }
        else{
            $("#Promotion_url").val('');
        }
    });
</script>