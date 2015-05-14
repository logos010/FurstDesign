<?php
$this->pageTitle = 'Manage Profile Fields';
$this->breadcrumbs = array(
    $this->pageTitle
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->pageTitle; ?>
            <span class="pull-right">
                <?php echo CHtml::link('Create', array('create'), array('class' => 'btn btn-default', 'id' => 'create')); ?>
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
            'id' => 'profile-field-grid',
            'dataProvider' => $dataProvider,
            'cssFile' => App()->theme->baseUrl . '/css/yii.css',
            'pager' => array('cssFile' => false),
            'afterAjaxUpdate' => 'js:function(id,data){$.bind_data()}',
            'selectableRows' => 2,
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
                'varname',
                array(
                    'name' => 'title',
                    'value' => 'UserModule::t($data->title)',
                ),
                'field_type',
                'field_size',
                //'field_size_min',
                array(
                    'name' => 'required',
                    'value' => 'ProfileField::itemAlias("required",$data->required)',
                ),
                //'match',
                //'range',
                //'error_message',
                //'other_validator',
                //'default',
                'position',
                array(
                    'name' => 'visible',
                    'value' => 'ProfileField::itemAlias("visible",$data->visible)',
                ),
                //*/
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                ),
            ),
        ));
        ?>
    </div>
</div>
<script  type="text/javascript">
    $(document).ready(function() {
        $.bind_data = function() {
            $(".grid-view a.view, .grid-view a.update").click(function() {
                var url = $(this).attr('href') + '?ajax=true';
                $.fancybox.open({
                    href: url,
                    width: '600px',
                    type: 'iframe',
                    afterClose: function() {
                        $.fn.yiiGridView.update('profile-field-grid')
                    }
                });
                return false;
            });
        }

        // bind data
        $.bind_data();

        $("#create").click(function() {
            $.fancybox.open({
                href: '<?php echo $this->createUrl('create', array('ajax' => true)) ?>',
                type: 'iframe',
                width: '600px',
                afterClose: function() {
                    $.fn.yiiGridView.update('profile-field-grid')
                }
            });
            return false;
        });

        $('#delete').live('click', function() {
            var count = 0;
            var params = 'YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>';
            $("input[name='chk[]']").each(function() {
                if ($(this).is(":checked")) {
                    count++;
                    params += '&chk[]=' + $(this).val();
                }
            });
            if (count >= 1) {
                if (!confirm("Delete selected records"))
                    return false;
            } else {
                alert("No checkbox is selected");
                return false;
            }

            $.ajax({
                type: "POST",
                url: '<?php echo $this->createUrl('delete', array('ajax' => true)) ?>',
                data: params,
                success: function(data) {
                    $.fn.yiiGridView.update('profile-field-grid');
                } //success
            });//ajax
            return false;
        });
    });
</script>