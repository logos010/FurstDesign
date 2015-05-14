<?php
$this->pageTitle = 'ElFinder';
$this->breadcrumbs = array(
    'ElFinder',
);
$model = new Term();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            ElFinder
        </h3>
    </div>
    <div class="panel-body">
        <?php
        //server file input
        $this->widget('ext.elFinder.ServerFileInput', array(
            'model' => $model,
            'attribute' => 'name',
            'connectorRoute' => 'admin/elfinder/connector',
                )
        );

// ElFinder widget
        $this->widget('ext.elFinder.ElFinderWidget', array(
            'connectorRoute' => 'admin/elfinder/connector',
                )
        );
        ?>


    </div>
</div>