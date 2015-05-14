<?php $this->pageTitle = UTranslate::t('Contact Us', array(), UTranslate::CATEGORY_MENU);?>

<div id="contact" class="well">
    <h1>Contact US</h1>
    
    <?php echo $this->renderFlash(); ?>
    
    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</div>