<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->pageTitle = 'Create $label'; \n";
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Create',
);\n";
?>
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo "<?php echo \$this->pageTitle; ?>"; ?></h3>
    </div>
    <div class="panel-body">
        <?php echo "<?php echo \$this->renderPartial('_form', array(\n'model'=>\$model,\n)); ?>"; ?>
   </div>
</div>