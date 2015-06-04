<?php
$this->pageTitle = 'Manage Galleries';
$this->breadcrumbs = array(
    'Product' => array('/admin/product/manage'),
    $this->pageTitle,
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <?php echo $this->pageTitle; ?>
            <span class="pull-right">
                <?php echo CHtml::tag('button', array('id' => 'delete', 'class' => 'btn btn-default'), '<i class="icon-trash"></i> Delete', true); ?>
            </span>
        </h3>
    </div>
    <div class="panel-body">
        <div>
            <form>
                <div class="form">
                    <div class="row">
                        <div id="divFileProgressContainer"></div>
                        <div class="swfupload"><span id="swfupload"></span></div>
                    </div>
                </div>
            </form>
        </div>


        <?php
        $this->widget('ext.gui.swfupload.CSwfUpload', array(
            'jsHandlerUrl' => App()->theme->baseUrl . '/js/handlers.js', //Relative path
            'postParams' => array(),
            'config' => array(
                'use_query_string' => true,
                'upload_url' => isset($url) ? $url : Yii::app()->createUrl('/admin/product/gallery/upload', array('pid' => $_GET['pid'])), //Use $this->createUrl method or define yourself
                'file_size_limit' => '2 MB',
                'file_types' => '*.jpg;*.png;*.gif',
                'file_types_description' => 'Image Files',
                'file_upload_limit' => 0,
                'file_queue_error_handler' => 'js:fileQueueError',
                'file_dialog_complete_handler' => 'js:fileDialogComplete',
                'upload_progress_handler' => 'js:uploadProgress',
                'upload_error_handler' => 'js:uploadError',
                'upload_success_handler' => 'js:uploadSuccess',
                'upload_complete_handler' => 'js:uploadComplete',
                'custom_settings' => array('upload_target' => 'divFileProgressContainer'),
                'button_placeholder_id' => 'swfupload',
                'button_width' => 170,
                'button_height' => 20,
                'button_text' => '<span class="button">' . 'Upload Image' . ' (Max 2 MB)</span>',
                'button_text_style' => '.button { font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif; font-size: 11pt; text-align: center; }',
                'button_text_top_padding' => 0,
                'button_text_left_padding' => 0,
                'button_window_mode' => 'js:SWFUpload.WINDOW_MODE.TRANSPARENT',
                'button_cursor' => 'js:SWFUpload.CURSOR.HAND',
            ),
                )
        );

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'image-grid',
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
                    'name' => 'uri',
                    'type' => 'html',
                    'value' => 'CHtml::image(BASE_URL . "/" . $data->uri , "", array("width" => "85"))',
                ),
                'name',
                'width',
                'height',
                'filesize',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                )
            ),
        ));
        ?>    </div>
</div>
<script>
    $(document).ready(function () {
        /*
         $('.search-button').click(function(){
         $('.search-form').toggle();
         return false;
         });
         $('.search-form form').submit(function(){
         $.fn.yiiGridView.update('gallery-grid', {
         data: $(this).serialize()
         });
         return false;
         });
         */

        // DELETE

        $('#delete').bind('click', function () {
            $.params = ($.fn.yiiGridView.getSelection('image-grid') + '');
            if ($.params != '') {
                if (!confirm('Do you want to delete selected records:' + $.params))
                    return false;
                $.params = 'YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>&chk[]=' + $.params.replace(/\,/g, '&chk[]=');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->createUrl('delete'); ?>',
                    data: $.params,
                    success: function (data) {
                        $.fn.yiiGridView.update('image-grid');
                    }
                });
            } else {
                alert('No record selected to delete !');
            }
            return false;
        });



    });
</script>