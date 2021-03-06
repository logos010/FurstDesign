<?php
$this->pageTitle = 'View News #' . $model->id; 
$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->title,
);
?>
<div style="display: none" class="alert alert-success alert-dismissable" id="delete_msg">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    BrandBase ID #<?php echo $model->id ?> has been deleted.</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->pageTitle; ?></h3>
    </div>
    <div class="panel-body">
		
        <?php 
		if ($model->term[1]->alias != '') {
                    $url = "/tin-tuc/{$model->term[0]->alias}/{$model->term[1]->alias}/{$model->id}-{$model->alias}";
                } else {
                    $url = "/tin-tuc/{$model->term[0]->alias}/{$model->id}-{$model->alias}";
                }
		echo CHtml::tag('div', array('style' => 'text-align: right; padding: 5px 0'), "<a href=\"" . $url . "\" target=\"_blank\">" . $url . "</a>");
		$this->widget('zii.widgets.CDetailView',array(
            'data'=>$model,
            'cssFile' => App()->theme->baseUrl . '/css/yii.css',
            'attributes'=>array(
            		'id',
		'title',
		'alias',
		'thumb',
		'quote',
		'type',
		'teaser:html',
		'content:html',
		'promote',
		'create_time',
		'publish_time',
		'update_time',
		'status',
            ),
            )); ?>
            <div class="form-actions text-center">
                <?php echo CHtml::link('Update', array('update', 'id' => $model->id, 'ajax' => $_GET['ajax']), array('class' => 'btn btn-primary', 'id' => 'update')); ?>                <?php echo CHtml::link('Delete', array('delete', 'id' => $model->id), array('class' => 'btn btn-danger', 'id' => 'delete')); ?>            </div>
   </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#delete').bind('click', function() {
            if (!confirm('Are you sure you want to delete this item ?'))
                return false;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: $(this).attr('href') + '?ajax=1',
            }).done(function(data) {
                $('div.panel').toggle();
                $('#delete_msg').html(data.msg).toggle();
            });
            return false;
        });
    });
</script>