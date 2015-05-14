<?php
$this->pageTitle = 'Create Vocabulary'; 
$this->breadcrumbs=array(
	'Vocabulary'=>array('index'),
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