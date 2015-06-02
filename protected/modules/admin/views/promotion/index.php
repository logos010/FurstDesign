<?php
/* @var $this PromotionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Promotions',
);

$this->menu=array(
	array('label'=>'Create Promotion', 'url'=>array('create')),
	array('label'=>'Manage Promotion', 'url'=>array('admin')),
);
?>

<h1>Promotions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
