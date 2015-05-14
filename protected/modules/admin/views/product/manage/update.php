<?php
$this->pageTitle = 'Update Products #' . $model->id;
$this->breadcrumbs = array(
    'Products' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->pageTitle; ?></h3>
    </div>
    <div class="panel-body">
        <?php
        echo $this->renderPartial('_form', array(
            'model' => $model,
            'term' => $term
        ));
        ?>   </div>
</div>