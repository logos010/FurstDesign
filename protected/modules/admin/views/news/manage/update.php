<?php
if ($model->term[1]->alias != '') {
                    $url = "/tin-tuc/{$model->term[0]->alias}/{$model->term[1]->alias}/{$model->id}-{$model->alias}";
                } else {
                    $url = "/tin-tuc/{$model->term[0]->alias}/{$model->id}-{$model->alias}";
                }
$this->pageTitle = 'Update News #' . $model->id;
$this->breadcrumbs = array(
    'News' => array('index'),
    $model->title => $url,
    'Update',
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->pageTitle; ?>
		<span class="pull-right">
                <?php echo CHtml::link('Create', array('create', 'ajax' => $_GET['ajax']), array('class' => 'btn btn-default', 'id' => 'create', 'title' => 'Create New')); ?>
                
            </span>
		</h3>
    </div>
    <div class="panel-body">
        <?php
        echo $this->renderPartial('_form', array(
            'model' => $model,
            'term' => $term
        ));
        ?>   </div>
</div>