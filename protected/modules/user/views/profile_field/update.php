<?php
$this->pageTitle = UserModule::t('Update ProfileField ') . $model->id;
$this->breadcrumbs = array(
    UserModule::t('Profile Fields') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    UserModule::t('Update'),
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->pageTitle; ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>