<?php
$this->breadcrumbs = array(
    UserModule::t('Profile Fields') => array('index'),
    UserModule::t($model->title),
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>View Profile Fields #<?php echo $model->id; ?></h3>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'cssFile' => App()->theme->baseUrl . '/css/yii.css',
            'attributes' => array(
                'id',
                'varname',
                'title',
                'field_type',
                'field_size',
                'field_size_min',
                'required',
                'match',
                'range',
                'error_message',
                'other_validator',
                'widget',
                'widgetparams',
                'default',
                'position',
                'visible',
            ),
        ));
        ?>
        <div class="form-actions text-center">
            <?php
            $linkUpdate = isset($_GET['ajax']) ? $this->createUrl('update', array('id' => $model->id, 'ajax' => true)) : $this->createUrl('update', array('id' => $model->id));
            echo CHtml::button('Update', array('class' => 'btn btn-primary', 'onclick' => "location.href='" . $linkUpdate . "'")) . ' ';
            echo CHtml::ajaxButton('Delete', array('delete', 'ajax' => true), array(
                'type' => 'post',
                'data' => "chk[]={$model->id}",
                'success' => 'function(data){ $("#' . App()->controller->getId() . '").html(data);}'
                    ), array('class' => 'btn btn-danger', 'confirm' => 'Are your sure?'));
            ?>
        </div>
    </div>
</div>
