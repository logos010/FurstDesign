<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->pageTitle = 'Manage $label'; \n";
echo "\$this->breadcrumbs=array(
	\$this->pageTitle,
);\n";
?>
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <?php echo '<?php '; ?>echo $this->pageTitle;<?php echo "?>\n"; ?>
            <span class="pull-right">
                <?php echo "<?php echo CHtml::link('Create', array('create'), array('class' => 'btn btn-default', 'id' => 'create', 'title' => 'Create New')); ?>\n"; ?>
                <?php echo "<?php //echo CHtml::tag('button', array('id' => 'delete', 'class' => 'btn btn-default'), '<i class=\"icon-trash\"></i> Delete', true); ?>\n"; ?>
            </span>
        </h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>
        
        <?php echo "<?php
 /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));
 echo '<div class=\"search-form\" style=\"display:none\">';   
 \$this->renderPartial('_search',array(
	'model'=>\$model,
 ));
 echo '</div><!-- search-form -->';\n*/"; ?>

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
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
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
    if (++$count == 7)
        echo "\t\t/*\n";
    echo "\t\t'" . $column->name . "',\n";
}
if ($count >= 7)
    echo "\t\t*/\n";
?>
        array(
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'template' => '{view} {update} {delete}',
        )

        ),
        )); <?php echo "?>" ; ?>
    </div>
</div>
<?php echo "\n<?php\n"; ?>
?>
<script>
    $(document).ready(function(){
        /*
        $('.search-button').click(function(){
                $('.search-form').toggle();
                return false;
        });
        $('.search-form form').submit(function(){
                $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
                        data: $(this).serialize()
                });
                return false;
        });
        */
    
        // DELETE
        /*
        $('#delete').bind('click', function() {
            $.params = ($.fn.yiiGridView.getSelection('<?php echo $this->class2id($this->modelClass); ?>-grid') + '');
            if ($.params != '') {
                if(!confirm('Do you want to delete selected records:' + $.params))
                    return false;
                $.params = 'YII_CSRF_TOKEN=<?php echo "<?php echo Yii::app()->request->csrfToken; ?>"; ?>&chk[]=' + $.params.replace(/\,/g, '&chk[]=');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo "<?php echo \$this->createUrl('delete'); ?>"?>',
                    data: $.params,
                    success: function(data) {
                        $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid');
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
                    href: $(this).attr('href') + '?ajax=1&t=<?php echo "<?php echo date('Ymdh'); ?>"; ?>',
                    type: 'iframe',
                    width: 760,
                    helpers: { overlay: { closeClick: false } },
                        afterClose: function() { $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid');} 
                    });
                return false;
                });
            });
        };
        $. bind_data();
        
    });
</script>