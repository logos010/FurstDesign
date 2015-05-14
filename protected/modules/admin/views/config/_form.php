<?php $this->pageTitle = 'Update Parameters'; ?>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'config-form',
    'enableAjaxValidation' => false,
        ));

// CREATE & UPDATE CONFIG TYPE TEXT
if ($model->type == 'text') {
    echo $form->errorSummary($model);
    echo $form->hiddenField($model, 'type');
    echo $form->hiddenField($model, 'name', array('readonly' => true));

    echo '<div>';
    echo $form->labelEx($model, 'value');
    $this->widget('ext.gui.tinymce.ETinyMce', array(
        'model' => $model,
        'attribute' => 'value',
        'editorTemplate' => 'full',
        'htmlOptions' => array('style' => 'height: 600px; width: 100%')
    ));
    echo $form->error($model, 'value');
    echo '</div>';
}

// CREATE && UPDATE CONFIG TYPE JSON & FILE
else {
    // UPDATE 1 MODEL
    if ($model instanceof Config) {
        echo $form->hiddenField($model, 'type');
        echo $form->hiddenField($model, 'name');

        echo '<div id="key_value" style="display: none">';
        echo $form->textFieldRow($model, 'key', array('name' => 'Keys[]', 'id' => '', 'value' => '', 'class' => 'span2', 'maxlength' => 255));
        echo $form->textFieldRow($model, 'value', array('name' => 'Values[]', 'id' => '', 'value' => '', 'class' => 'span4'));
        echo '</div>';

        echo '<div id="tblkey">';
        if ($model->isNewRecord) {
            echo CHtml::tag('script', array(), '$("#tblkey").append($("#key_value").html());');
        } else {
            $data = json_decode($model->value, true);
            ksort($data);
            foreach ($data as $k => $v) {
                echo $form->textFieldRow($model, 'key', array('name' => 'Keys[]', 'id' => '', 'value' => $k, 'class' => 'span2', 'maxlength' => 255, 'readonly' => true));
                if ($model->type == 'json') {
                    echo $form->textFieldRow($model, 'value', array('name' => 'Values[]', 'id' => '', 'value' => $v, 'class' => 'span4'));
                } else {
                    echo '<div>Value ';
                    $this->widget('ext.elFinder.ServerFileInput', array(
                        'name' => 'Values[]',
                        'value' => $v,
                        'id' => $k,
                        'connectorRoute' => 'admin/elfinder/connector',
                            )
                    );
                    echo '</div>';
                }
            }
        }
        echo '</div>';

        echo CHtml::tag('div', array('align' => 'right'), CHtml::button('Add Key', array(
                    'class' => 'btn btn-default',
                    'onclick' => '$("#tblkey").append($("#key_value").html());',
        )));
    }
    // UPDATE ALL CONFIG
    else {
        echo '<div class="form-actions text-center">';
            echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')) . ' ';
            echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger'));
        echo '</div>';
        echo $form->hiddenField($model[0], 'type');
        echo $form->hiddenField($model[0], 'name');
        foreach ($model as $node) {
            echo CHtml::tag('div', array('style' => 'clear: both'), CHtml::link(ucwords($node->name), array('update', 'name' => $node->name)));
            $data = json_decode($node->value, true);
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    echo '<div style="padding-left: 20px; clear: both">';
                    echo "<label>" . ucwords($key) . "</label>";
                    if ($node->type == 'json')
                        echo CHtml::textField("{$node->name}[{$key}]", $value) . ' ';
                    else
                        $this->widget('ext.elFinder.ServerFileInput', array(
                            'name' => "{$node->name}[{$key}]",
                            'value' => $value,
                            'connectorRoute' => 'admin/elfinder/connector',
                                )
                        );
                    echo '</div>';
                }
            } else {
                ?>
                <div>
                    <?php
                    $this->widget('ext.gui.tinymce.ETinyMce', array(
                        'name' => $node->name,
                        'value' => $node->value,
                        'htmlOptions' => array('rows' => 10)
                    ));
                    ?>
                    <?php echo $form->error($node, 'value'); ?>
                </div>
                <?php
            }
        }
    }
}
?>
<div class="form-actions text-center">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')) ?>
    <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger')) ?>
</div>

<?php $this->endWidget(); ?>
