<?php
$this->pageTitle = 'Update Contacts #' . $model->id; 
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->pageTitle; ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form',array(
'model'=>$model,
)); ?>   </div>
</div>