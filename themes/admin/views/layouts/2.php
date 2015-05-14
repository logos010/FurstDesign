<?php $this->beginContent('//layouts/main'); ?>
<div id="splitter">
    <div id="sidebar-left">
        <div id="sidebar-left-inner">
            <?php
            $cs = Yii::app()->clientScript;
            cs()->registerScriptFile(App()->theme->baseUrl. '/js/splitter.js');
            cs()->registerCssFile(App()->theme->baseUrl . '/css/portlet.css');
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title' => UTranslate::t('Operations'),
            ));
            $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'operations'),
            ));
            $this->endWidget();
            ?>
        </div>
    </div>

    <div id="content">
        <div id="content-inner">
            <div class="box">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>
<script type="text/javascript">
    $(function() {
        $('#splitter').splitter({
            outline: true,
            minLeft: 200,
            sizeLeft: 210,
            minRight: 600,
            resizeToWidth: false
        });
        $("#splitter").css("height", $("#content-inner").css("height")).trigger("resize");
    });
</script>