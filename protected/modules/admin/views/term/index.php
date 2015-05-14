<?php
$this->pageTitle = 'Term DATA';
$this->breadcrumbs = array(
    $this->pageTitle,
);
$vid = isset($_GET['Term']['vid']) ? $_GET['Term']['vid'] : '';
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <?php echo $this->pageTitle; ?>
            <span class="pull-right">
                <?php echo CHtml::link('Create', array('create', 'vid' => $vid), array('class' => 'btn btn-default', 'id' => 'create', 'title' => 'Create New')); ?>
                <?php //echo CHtml::tag('button', array('id' => 'delete', 'class' => 'btn btn-default'), '<i class="icon-trash"></i> Delete', true); ?>
            </span>
        </h3>
    </div>
    <div class="panel-body">
        <?php
        echo '<div class="search-form text-center">';
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        echo '</div><!-- search-form -->';

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'term-grid',
            'dataProvider' => $model->search(),
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
                array(
                    'name' => 'id',
                    'htmlOptions' => array('width' => 80),
                ),
                array(
                    'name' => 'name',
                    'type' => 'html',
                    'value' => 'str_repeat("&nbsp;", $data->level*10) . $data->name',
                ),
                array(
                    'name' => 'weight',
                    'htmlOptions' => array('width' => 80),
//                    'filter' => false
                ),
                array(
                    'name' => 'status',
                    'htmlOptions' => array('width' => 80),
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::image(App()->theme->baseUrl. "/images/" . (($data->status==1)?"tick_circle.png":"cross_circle.png")), array("//admin/default/update_status", "model" => "Term", "pk"=>$data->id), array("class" => "update-status"))',
                    'filter' => array(1 => 'Active', 0 => 'Inactive')
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{view} {update} {delete}',
                )
            ),
        ));
        ?>    </div>
</div>

<?php
?>
<script>
    $(document).ready(function() {

        $('.search-button').click(function() {
            $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function() {
            $.fn.yiiGridView.update('term-grid', {
                data: $(this).serialize()
            });
            return false;
        });

        // CREATE, VIEW, UPDATE
        $.bind_data = function() {
            $('#create, a.view, a.update').each(function(index) {
                $(this).bind('click', function() {
                    $.fancybox.open({
                        href: $(this).attr('href') + '?ajax=1&t=<?php echo date('Ymdh') ?>',
                        type: 'iframe',
                        width: 760,
                        helpers: {overlay: {closeClick: false}},
                        afterClose: function() {
                            $.fn.yiiGridView.update('term-grid');
                        }
                    });
                    return false;
                });
            });
        };
        $.bind_data();

        $('a.update-status').live('click', function() {
            $.fn.yiiGridView.update('term-grid', {
                type: 'POST',
                url: $(this).attr('href'),
                success: function() {
                    $.fn.yiiGridView.update('term-grid');
                }
            });
            return false;
        });

        // SEARCH FORM
        $('.search-form form').submit(function() {
            location.href = '<?php echo Yii::app()->request->getUrl() ?>#search/' + $(this).serialize();
            return false;
        });

        // Bind the event Hash change.
        $(window).hashchange(function() {
            $.fn.yiiGridView.update('term-grid', {
                data: location.hash.substring(8),
                complete: function(data) {
                }
            });
        });

        // Bind Window on load.
        $(window).load(function() {
            if (window.location.hash) {
                $.fn.yiiGridView.update('user-grid', {
                    data: location.hash.substring(8)
                });
            }
        });
    });
</script>