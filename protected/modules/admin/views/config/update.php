<?php
$btn_delete = '';
$js_delete = '';
$btn_create = '';
if (is_array($model)) {
    $this->breadcrumbs = array(
        'Update Parameters ' . $model->name
    );
    $btn_create = CHtml::link('Create Key', array('create'), array('class' => 'btn btn-default', 'id' => 'create'));
} else {
    $this->breadcrumbs = array(
        'Parameters' => array('update'),
        'Update: ' . $model->name
    );
    $btn_delete = CHtml::tag('button', array('id' => 'delete', 'class' => 'btn btn-default'), '<i class="icon-trash"></i> Delete Key', true);
    $js_delete = "
        $('#delete').live('click', function() {
            if(!confirm('Bạn có muốn xóa key {{$model->name}}?'))
                    return false;
            $.url = '" . $this->createUrl('delete', array('name' => $model->name)) . "'
            $(location).attr('href', $.url);
            return false;
        });
    ";
}
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Update Key  <?php echo ucfirst($model->name); ?>
            <span class="pull-right">
                <!--<button type="button" class="btn btn-default" onclick="window.open('<?php echo url('/admin/elfinder/index') ?>', 'Ajax File Manager', 'width=600,height=600')"><i class="icon-folder-open"></i> Browser Images</button>-->
                <span class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Update Key <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        if (!is_array($model))
                            $array_key = Config::model()->findAll(array('select' => 'name', 'order' => 'name'));
                        else
                            $array_key = $model;
                        foreach ($array_key as $node)
                            echo CHtml::tag('li', array(), CHtml::link($node->name, array('update', 'name' => $node->name)));
                        ?>

                    </ul>
                </span>
                <?php
                echo $btn_create;
                echo $btn_delete;
                ?>
            </span>
        </h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>
<?php
$script = "
    $.bind_data = function() { 
       $('#create').live('click', function() {
            $.fancybox.open({
                href: $(this).attr('href') + '?ajax=1&t=".time()."',
                type : 'iframe',
                width: 500,
                helpers: { overlay: { closeClick: false } }
            });
            return false;
        }); 
        {$js_delete}
    };
    $.bind_data();
";

cs()->registerScript('fancybox', $script);
?>