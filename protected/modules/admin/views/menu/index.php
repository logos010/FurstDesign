<?php
$this->pageTitle = 'Manage Menus';
$this->breadcrumbs = array(
    $this->pageTitle,
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <?php echo $this->pageTitle; ?>
            <span class="pull-right">
<!--                <select id="admin-menu-type">
                    <option value="0">All menu</option>
                    <option value="1">Frond-end menu</option>
                    <option value="2">Back-end menu</option>
                </select>-->
                <?php echo CHtml::link('Create', array('create'), array('class' => 'btn btn-default', 'id' => 'create', 'title' => 'Create New')); ?>
                <?php //echo CHtml::tag('button', array('id' => 'delete', 'class' => 'btn btn-default'), '<i class="icon-trash"></i> Delete', true); ?>
            </span>
        </h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <?php
        /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));
          echo '<div class="search-form" style="display:none">';
          $this->renderPartial('_search',array(
          'model'=>$model,
          ));
          echo '</div><!-- search-form -->';
         */
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'menu-grid',
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
//                    'htmlOptions' => array('width' => 80),
                    'filter' => false,
                ),
                array(
                    'name' => 'name',
                    'type' => 'html',
                    'value' => 'str_repeat("&nbsp;", $data->level*10) . $data->name',
//                    'htmlOptions' => array('style' => 'min-width: 300px'),
                ),
                array(
                    'name' => 'url',
                    'filter' => false,
                ),
                array(
                    'name' => 'weight',
                    'filter' => false,
                ),
                array(
                    'name' => 'status',
//                    'htmlOptions' => array('width' => 80),
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::image(App()->theme->baseUrl. "/images/" . (($data->status==1)?"tick_circle.png":"cross_circle.png")), array("//admin/default/update_status", "model" => "Menu", "pk"=>$data->id), array("class" => "update-status"))',
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
    $(document).ready(function () {
        /*
         $('.search-button').click(function(){
         $('.search-form').toggle();
         return false;
         });
         $('.search-form form').submit(function(){
         $.fn.yiiGridView.update('menu-grid', {
         data: $(this).serialize()
         });
         return false;
         });
         */

        // CREATE, VIEW, UPDATE
        $.bind_data = function () {
            $('#create, a.view, a.update').each(function (index) {
                $(this).bind('click', function () {
                    $.fancybox.open({
                        href: $(this).attr('href') + '?ajax=1&t=<?php echo date('Ymdhs'); ?>',
                        type: 'iframe',
                        width: 500,
                        helpers: {overlay: {closeClick: false}},
                        afterClose: function () {
                            $.fn.yiiGridView.update('menu-grid');
                        }
                    });
                    return false;
                });
            });
        };
        $.bind_data();

        $('a.update-status').live('click', function () {
            $.fn.yiiGridView.update('menu-grid', {
                type: 'POST',
                url: $(this).attr('href'),
                success: function () {
                    $.fn.yiiGridView.update('menu-grid');
                }
            });
            return false;
        });        
    });
    
    $("#admin-menu-type").change(function(){
        var menu = $(this).val();
        console.log(menu);
        $.fn.yiiGridView.update('menu-grid', {
            type: 'POST',
            url: '',
            success: function(){
                $.fn.yiiGridView.update('menu-grid');
            }
        });
    });
</script>
