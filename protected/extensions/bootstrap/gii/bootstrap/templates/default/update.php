<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->pageTitle = 'Update $label #' . \$model->{$this->tableSchema->primaryKey}; \n";
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Update',
);\n";
?>
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo "<?php echo \$this->pageTitle; ?>"; ?></h3>
    </div>
    <div class="panel-body">
        <?php echo "<?php echo \$this->renderPartial('_form',array(\n'model'=>\$model,\n)); ?>"; ?>
   </div>
</div>