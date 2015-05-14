<?php
$this->pageTitle = 'Manage Users';
$this->breadcrumbs = array(
    $this->pageTitle
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3> <?php echo UserModule::t($this->pageTitle); ?>
            <span class="pull-right">
                <?php echo CHtml::link('Create', array('create'), array('class' => 'btn btn-default', 'id' => 'create')); ?>
            </span>
        </h3>
    </div>
    <div class="panel-body">
        <?php
        
        echo '<div class="search-form text-center">';
        $this->renderPartial('_search');
        echo '</div><!-- search-form -->';
        
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'user-grid',
            'dataProvider' => $dataProvider,
            'cssFile' => App()->theme->baseUrl . '/css/yii.css',
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
                array(
                    'name' => 'id',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id), array("class" => "update"))',
                ),
                array(
                    'name' => 'username',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::encode($data->username),array("admin/view","id"=>$data->id), array("class" => "view"))',
                ),
                array(
                    'name' => 'email',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::encode($data->email), "mailto:".$data->email)',
                ),
                array(
                    'name' => 'createtime',
                    'value' => 'date("d.m.Y H:i:s",$data->createtime)',
                ),
                array(
                    'name' => 'lastvisit',
                    'value' => '(($data->lastvisit)?date("d.m.Y H:i:s",$data->lastvisit):UserModule::t("Not visited"))',
                ),
                array(
                    'name' => 'status',
                    'value' => 'User::itemAlias("UserStatus",$data->status)',
                ),
                array(
                    'name' => 'superuser',
                    'value' => 'User::itemAlias("AdminStatus",$data->superuser)',
                ),
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
            $("a.view, a.update").click(function() {
                var url = $(this).attr('href') + '?ajax=true';
                $.fancybox.open({
                    href: url,
                    type: 'iframe',
                    width: 760,
                    afterClose: function() {
                        $.fn.yiiGridView.update('user-grid');
                    }
                });
                return false;
            });
        };

        // bind data
        $.bind_data();

        $("#create").click(function() {
            $.fancybox.open({
                href: '<?php echo $this->createUrl('create', array('ajax' => true)) ?>',
                type: 'iframe',
                width: 760,
                afterClose: function() {
                    $.fn.yiiGridView.update('user-grid');
                }
            });
            return false;
        });

        // SEARCH FORM
        $('.search-form form').submit(function() {
            location.href = '<?php echo Yii::app()->request->getUrl() ?>#search/' + $.URLEncode($('#search').val());
            $('#search-button').focus();
            return false;
        });

        // Bind the event Hash change.
        $(window).hashchange(function() {
            var search = location.hash.substring(8);
            $.fn.yiiGridView.update('user-grid', {
                data: 'search=' + search,
                complete: function(data) {
                }
            });
        });

        // Bind Window on load.
        $(window).load(function() {
            if (window.location.hash) {
                $.search = location.hash.substring(8);
                $('#search').val($.URLDecode($.search));
                $.fn.yiiGridView.update('user-grid', {
                    data: 'search=' + $.search
                });
            }
        });

    });
</script>

