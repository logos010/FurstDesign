<?php
$this->pageTitle = 'Manage Translates'; 
$this->breadcrumbs=array(
	$this->pageTitle,
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <?php echo $this->pageTitle;?>
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
    'id'=>'translate-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'cssFile' => App()->theme->baseUrl . '/css/yii.css',
    'pager' => array('cssFile' => false),
    'selectableRows' => 2,
    'afterAjaxUpdate' => 'js:function(id,data){$.bind_data()}',
    'columns'=>array(
    array(
        'name' => 'id',
        'header' => '',
        'type' => 'html',
        'value' => '"<span class=stick></span>"',
        'filter' => false,
        'htmlOptions' => array('align' => 'center', 'width' => 40)
    ),
		'id',
		'message',
		'category',
		'language_code',
		'translation',
        array(
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'template' => '{view} {update} {delete}',
        )

        ),
        )); ?>    </div>
</div>

<?php
?>
<script>
    $(document).ready(function(){
        /*
        $('.search-button').click(function(){
                $('.search-form').toggle();
                return false;
        });
        $('.search-form form').submit(function(){
                $.fn.yiiGridView.update('translate-grid', {
                        data: $(this).serialize()
                });
                return false;
        });
        */
    
        // DELETE
        /*
        $('#delete').bind('click', function() {
            $.params = ($.fn.yiiGridView.getSelection('translate-grid') + '');
            if ($.params != '') {
                if(!confirm('Do you want to delete selected records:' + $.params))
                    return false;
                $.params = 'YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>&chk[]=' + $.params.replace(/\,/g, '&chk[]=');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->createUrl('delete'); ?>',
                    data: $.params,
                    success: function(data) {
                        $.fn.yiiGridView.update('translate-grid');
                    } 
                });
            } else {
                alert('No record selected to delete !');
            }
        return false;
        });*/
        
        // CREATE, VIEW, UPDATE
        $. bind_data = function(){
            $('#create, a.view, a.update').each(function(index){
                $(this).bind('click', function() {
                $.fancybox.open({
                    href: $(this).attr('href') + '?ajax=1',
                    type: 'iframe',
                    width: 500,
                    helpers: { overlay: { closeClick: false } },
                        afterClose: function() { $.fn.yiiGridView.update('translate-grid');} 
                    });
                return false;
                });
            });
        };
        $. bind_data();
        
    });
</script>