<?php
$this->pageTitle = 'Term DATA';
$this->breadcrumbs = array(
    $this->pageTitle,
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
<!--        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>-->

        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'vocabulary-grid',
            'dataProvider' => $model->search(),
//            'filter' => $model,
            'cssFile' => App()->theme->baseUrl . '/css/yii.css',
            'pager' => array('cssFile' => false),
            'selectableRows' => 2,
            'afterAjaxUpdate' => 'js:function(id,data){$.bind_data()}',
            'columns' => array(
                array(
                    'name' => 'id',
                    'header' => '',
                    'type' => 'html',
                    'value' => '"<span class=stick></span>"',
                    'filter' => false,
                    'htmlOptions' => array('align' => 'center', 'width' => 40)
                ),
                'id',
                'alias',
                'name',
                'description',
                'weight',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{term} {update}',
                    'buttons' => array(
                        'term' => array('label' => 'List Data', 'url' => 'url("/admin/term/index", array("Term[vid]" => $data->id))', 'options' => array('class' => 'icon-th'), 'imageUrl' => App()->theme->baseUrl . '/images/1.gif'),
                    )
                )
            ),
        ));
        ?>    </div>
</div>

<?php
?>
<script>
    $(document).ready(function() {
        // CREATE, VIEW, UPDATE
        $.bind_data = function() {
            $('#create, a.view, a.update').each(function(index) {
                $(this).bind('click', function() {
                    $.fancybox.open({
                        href: $(this).attr('href') + '?ajax=1',
                        type: 'iframe',
                        width: 500,
                        helpers: {overlay: {closeClick: false}},
                        afterClose: function() {
                            $.fn.yiiGridView.update('vocabulary-grid');
                        }
                    });
                    return false;
                });
            });
        };
        $.bind_data();
    });
</script>