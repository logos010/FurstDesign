<?php
$this->pageTitle = 'Create Contacts'; 
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Create',
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->pageTitle; ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array(
'model'=>$model,
)); ?>   </div>
</div>