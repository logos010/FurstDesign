<?php
$this->pageTitle = UserModule::t('Update User') . " " . $model->id;
$this->breadcrumbs = array(
    (UserModule::t('Users')) => array('index'),
    $model->username => array('view', 'id' => $model->id),
    (UserModule::t('Update')),
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <?php echo $this->pageTitle; ?>   
        </h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model, 'profile' => $profile)); ?>
    </div>
</div>
