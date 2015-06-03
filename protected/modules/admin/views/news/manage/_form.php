<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'news-form',
    'action' => $model->isNewRecord ? url($this->route, array('ajax' => $_GET['ajax'])) : '',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php //cs()->registerCssFile(App()->theme->baseUrl . '/css/cswf-upload.css'); ?>
<?php echo $form->errorSummary($model); ?>
<?php
if ($model->isNewRecord || !isset($_GET['desc'])) {
    echo '<div class="row-fluid">
				<div class="span6">';
    echo $form->textFieldRow($model, 'title', array('class' => 'span11', 'maxlength' => 255,
        'onblur' => CHtml::ajax(
                array(
                    'type' => 'POST', 'url' => url('admin/default/generateAlias', array('model' => get_class($model), 'att' => 'title')),
                    'success' =>
                    'function(html) { $("#' . get_class($model) . '_alias").val(html) }'
        ))
    ));
    echo $form->textFieldRow($model, 'alias', array('class' => 'span11', 'maxlength' => 255));
    echo $form->labelEx($model, 'stream');
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' => $model,
        'attribute' => 'stream',
        'sourceUrl' => $this->createUrl('autoCompleteEvent', array('id' => $model->id)),
        // additional javascript options for the autocomplete plugin
        'options' => array(
            'minLength' => '2',
        ),
        'htmlOptions' => array(
            'class' => 'span10',
            'maxlength' => 255,
        ),
    ));

    echo $form->labelEx($model, 'quote');
    $quote = explode(',', strip_tags(UConfig::get('quote')));
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' => $model,
        'attribute' => 'quote',
        'source' => $quote,
        'htmlOptions' => array(
            'maxlength' => 255,
        ),
    ));
    echo $form->fileFieldRow($model, 'thumb', array('class' => 'span10', 'maxlength' => 255));
    echo $form->textFieldRow($model, 'uri', array('class' => 'span11', 'maxlength' => 255, 'hidden' => !$model->isNewRecord));
    
    echo '</div>';
    echo '<div class="span3">';
    echo CHtml::link('News Cate', array('/admin/term/index/Term[vid]/3'), array('target' => '_blank'));
    echo '<div class="listbox" style="height: 320px; overflow-y: scroll">' . $form->checkBoxListRow($model, 'cate', $term, array()) . '</div>';
    echo '</div>';
    echo '<div class="span3">';
    echo $form->dropDownlistRow($model, 'status', array('0' => 'Inactive', '1' => 'Active', '-1' => 'Request Delete'));
    echo $form->textFieldRow($model, 'publish_time');
    echo $form->dropDownlistRow($model, 'promote', array(0 => 'Bình thường', 1 => 'Nổi Bật', 2 => 'Top Nổi bật'), array('hint' => '( Tin nổi bật )'));
    echo $form->dropDownlistRow($model, 'type', array(0 => 'Tin Tức', 1 => 'Hình ảnh', 2 => 'Video'), array('onchange' => 'if($(this).val()==2) {$("#News_strip_tag").attr("checked", false)} else {$("#News_strip_tag").attr("checked", true)}'));

    echo '</div>
			</div>';
    echo $form->textAreaRow($model, 'teaser', array('rows' => 6, 'class' => 'span10'));
    if (!$model->isNewRecord) {
        echo '<div class="span12">';
        echo CHtml::image(App()->homeUrl . $model->thumb);
        echo '</div>';
    }
}

echo CHtml::tag('div', array('style' => 'float: right'), CHtml::link('Full controls', '?full=1'));

echo '<div class="row-fluid">';
echo '<div class="span6">';
echo $form->labelEx($model, 'tag');
$this->widget('ext.multicomplete.MultiComplete', array(
    'model' => $model,
    'attribute' => 'tag',
    'sourceUrl' => $this->createUrl('autoCompleteTag', array('id' => $model->id)),
    'options' => array(
        'minLength' => '2',
    ),
    'htmlOptions' => array(
        'class' => 'span11',
        'maxlength' => 255,
    ),
));
echo '</div>';
echo '<div class="span6">';
echo $form->checkBoxRow($model, 'strip_tag', array('hint' => '( Remove Tag HTML. But allow (i,b,p) )'));
echo '</div>';
echo '</div>';
//echo CHtml::tag('div', array('align' => 'right'), CHtml::image(BASE_URL . '/' . $model->thumb, '', array('style' => 'height: 80px')));
echo $form->labelEx($model, 'content');
$this->widget('ext.gui.tinymce.ETinyMce', array(
    'model' => $model,
    'attribute' => 'content',
    'editorTemplate' => 'full',
    'htmlOptions' => array('style' => 'height: 500px; width: 100%'),
    'editorTemplate' => 'full',
    'options' => isset($_GET['full']) ? array() :
            array(
        'theme_advanced_buttons1' => 'save,newdocument,print,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,undo,redo,|,removeformat,cleanup,|,spellchecker,|,visualaid,visualchars,|,ltr,rtl,|,code,preview,fullscreen,|,help',
        'theme_advanced_buttons2' => 'formatselect,fontselect,fontsizeselect,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,outdent, indent,|,sub,sup,|,bullist,numlist',
        'theme_advanced_buttons3' => '',
        'theme_advanced_buttons4' => '',
        'theme_advanced_toolbar_location' => 'top',
        'theme_advanced_toolbar_align' => 'left',
        'theme_advanced_statusbar_location' => 'none',
        'theme_advanced_font_sizes' => "10=10pt,11=11pt,12=12pt,13=13pt,14=14pt,15=15pt,16=16pt,17=17pt,18=18pt,19=19pt,20=20pt",
            )
));
echo $form->error($model, 'content');
?>
<div class="form-actions text-center">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary', 'accesskey' => 's')); ?>
    <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger')); ?>
</div>

<?php $this->endWidget(); ?>

<?php $this->renderPartial('/upload', array('url' => $this->createUrl('uploadImage', array('id' => $model->id)))); ?>
<br/><br/><br/>