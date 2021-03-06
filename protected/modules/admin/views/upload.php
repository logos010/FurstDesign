<div id="form-multi-upload">
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
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'image-grid',
        'dataProvider' => new CArrayDataProvider(array('id' => 'id')),
        'cssFile' => App()->theme->baseUrl . '/css/yii.css',
        'template' => '{items}',
        'hideHeader' => true,
        'columns' => array(
            array(
                'name' => 'id',
                'type' => 'raw',
                'value' => 'LastUpload::out()',
            ),
        )
    ));
    $this->widget('ext.gui.swfupload.CSwfUpload', array(
        'jsHandlerUrl' => App()->theme->baseUrl . '/js/handlers.js', //Relative path
        'postParams' => array(),
        'config' => array(
            'use_query_string' => true,
            'upload_url' => isset($url) ? $url : Yii::app()->createUrl('/admin/upload/uploadImage'), //Use $this->createUrl method or define yourself
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
    ?>
</div>