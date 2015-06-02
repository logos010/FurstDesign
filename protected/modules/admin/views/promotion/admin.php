<?php
/* @var $this PromotionController */
/* @var $model Promotion */

$this->breadcrumbs = array(
    'Promotions' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Promotion', 'url' => array('index')),
    array('label' => 'Create Promotion', 'url' => array('create')),
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <?php echo $this->pageTitle; ?>
            <span class="pull-right">
                <?php echo CHtml::link('Create', array('create'), array('class' => 'btn btn-default', 'id' => 'create', 'title' => 'Create New')); ?>
                <?php //echo CHtml::tag('button', array('id' => 'delete', 'class' => 'btn btn-default'), '<i class="icon-trash"></i> Delete', true); ?>
            </span>
        </h3>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'promotion-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'cssFile' => App()->theme->baseUrl . '/css/yii.css',
            'pager' => array('cssFile' => false),
            'columns' => array(
                array(
                    'name' => 'id',
                    'filter' => false,
                ),
                'name',
                array(
                    'name' => 'image',
                    'filter' => false,
                    'type' => 'html',
                    'value' => 'CHtml::image(BASE_URL . "/" . $data->image, "", array("width" => "85"))',
                ),
                'url',
                array(
                    'name' => 'position',
                    'htmlOptions' => array('width' => 80),
                    'type' => 'raw',
                    'filter' => array(1 => 'Active', 0 => 'Inactive'),
                    'htmlOptions' => array(
                        'align' => 'center'
                    )
                ),
                array(
                    'name' => 'status',
                    'htmlOptions' => array('width' => 80),
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::image(App()->theme->baseUrl. "/images/" . (($data->status==1)?"tick_circle.png":"cross_circle.png")), array("//admin/default/update_status", "model" => "Promotion", "pk"=>$data->id), array("class" => "update-status"))',
                    'filter' => array(1 => 'Active', 0 => 'Inactive'),
                    'htmlOptions' => array(
                        'align' => 'center'
                    )
                ),
                array(
                    'class' => 'CButtonColumn',
                    'htmlOptions' => array('style'=>'width:120px')
                ),
            ),
        ));
        ?>
    </div>
</div>

