<?php
/* @var $this MaterialController */
/* @var $model Material */

$this->breadcrumbs=array(
	'Materials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Material', 'url'=>array('index')),
	array('label'=>'Manage Material', 'url'=>array('admin')),
);
?>

<h1>Create Material</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>