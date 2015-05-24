<?php
$this->pageTitle = 'Manage Products';
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
            'id' => 'product-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
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
                'name',                
                array(
                    'name' => 'image',
                    'filter' => false,
                    'type' => 'html',
                    'value' => 'CHtml::image(BASE_URL . "/" . $data->image, "", array("width" => "85"))',
                    'htmlOptions' => array(
                        'width' => '100',
                        'align' => 'center'
                    )
                ),
                array(
                    'name' => 'sku',
                    'htmlOptions' => array(
                        'align' => 'center'
                    )
                ),
                array(
                    'name' => 'quantity',
                    'value' => 'number_format($data->quantity, 0, " ", ",")',
                    'htmlOptions' => array(
                        'align' => 'center'
                    )
                ),
                array(
                    'name' => 'price',
                    'value' => 'number_format($data->price, 0, " ", ",")',
                    'htmlOptions' => array(
                        'align' => 'center'
                    )
                ),
                array(
                    'name' => 'discount',
                    'htmlOptions' => array(
                        'align' => 'center'
                    )
                ),
                array(
                    'name' => 'status',
                    'htmlOptions' => array('width' => 80),
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::image(App()->theme->baseUrl. "/images/" . (($data->status==1)?"tick_circle.png":"cross_circle.png")), array("//admin/default/update_status", "model" => "Product", "pk"=>$data->id), array("class" => "update-status"))',
                    'filter' => array(1 => 'Active', 0 => 'Inactive'),
                    'htmlOptions' => array(
                        'align' => 'center'
                    )
                ),
                /*                 
                  'price',
                  'wholesale_price',
                  'bought',                  
                  'sale_promotion',
                  'like',
                  'subscripbe',
                  'description',
                  'detail',                  
                  'create',
                  'update',
                 */
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{gallery}{view} {update} {delete}',
                    'buttons' => array(
                        'gallery' => array(
                            'label' => 'Gallery',
                            'url' => 'url("/admin/product/gallery/index", array("pid" => $data->id))',
                            'icon' => 'icon-picture',
                        )
                    )
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
         $.fn.yiiGridView.update('product-grid', {
         data: $(this).serialize()
         });
         return false;
         });
         */

        // DELETE
        /*
         $('#delete').bind('click', function() {
         $.params = ($.fn.yiiGridView.getSelection('product-grid') + '');
         if ($.params != '') {
         if(!confirm('Do you want to delete selected records:' + $.params))
         return false;
         $.params = 'YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>&chk[]=' + $.params.replace(/\,/g, '&chk[]=');
         $.ajax({
         type: 'POST',
         url: '<?php echo $this->createUrl('delete'); ?>',
         data: $.params,
         success: function(data) {
         $.fn.yiiGridView.update('product-grid');
         } 
         });
         } else {
         alert('No record selected to delete !');
         }
         return false;
         });*/

        // CREATE, VIEW, UPDATE
        $.bind_data = function () {
            $('#create, a.view, a.update').each(function (index) {
                $(this).bind('click', function () {
                    $.fancybox.open({
                        href: $(this).attr('href') + '?ajax=1&t=<?php echo date('Ymdh'); ?>',
                        type: 'iframe',
                        width: 760,
                        helpers: {overlay: {closeClick: false}},
                        afterClose: function () {
                            $.fn.yiiGridView.update('product-grid');
                        }
                    });
                    return false;
                });
            });
        };
        $.bind_data();

        //UPDATE STATUS
        $('a.update-status').live('click', function() {
            $.fn.yiiGridView.update('product-grid', {
                type: 'POST',
                url: $(this).attr('href'),
                success: function() {
                    $.fn.yiiGridView.update('product-grid');
                }
            });
            return false;
        });
    });
</script>