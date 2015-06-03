<?php
$this->pageTitle = 'Manage News';
$this->breadcrumbs = array(
    $this->pageTitle,
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <?php echo $this->pageTitle; ?>
            <span class="pull-right">
                <?php echo CHtml::link('Create', array('create'), array('class' => 'btn btn-default', 'id' => 'create', 'title' => 'Create New')); ?>
            </span>
        </h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

		<div class="text-center">
			<form class="form-search" id="form-search" action="<?php echo url($this->route); ?>" method="get" _lpchecked="1">
			<div class="input-prepend"><span class="add-on"><i class="icon-search"></i></span>
				<?php
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'name' => 'search',
					'source' => array('create_time:' . date('Y-m-d'), 'create_time:' . date('Y-m-d', strtotime('yesterday')), 'create_time:' . date('Y-m-d', strtotime('-2 days'))),
					// additional javascript options for the autocomplete plugin
		//            'options' => array(
		//                'minLength' => '2',
		//            ),
					'htmlOptions' => array(
						'class' => 'span6 input-xxlarge',
						'accesskey' => 's',
						'placeholder' => 'Key: Value',
						'maxlength' => 500,
					),
				));
				?></div>

			<button class="btn" type="submit" name="yt0" id="go"> Go </button>
		</form>
		</div>

        <?php
        /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));
          echo '<div class="search-form" style="display:none">';
          $this->renderPartial('_search',array(
          'model'=>$model,
          ));
          echo '</div><!-- search-form -->';
         */
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'news-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'cssFile' => App()->theme->baseUrl . '/css/yii.css',
            'pager' => array('cssFile' => false),
            'selectableRows' => 2,
            'afterAjaxUpdate' => 'js:function(id,data){$.bind_data()}',
            'columns' => array(
                array(
                    'name' => 'id',
                    'header' => '',
                    'type' => 'html',
                    'value' => '"<span class=stick></span>"',
                    'filter' => false,
                    'htmlOptions' => array('align' => 'center', 'width' => 40)
                ),
                'id',
				array(
					'name' => 'create_by',
					'visible' => App()->user->id == 1
				),
                array(
                    'name' => 'cate',
//                    'value' => 'var_dump($data->nTerms->)',
                    'filter' => Term::buildDataForList(Term::buildTree(3))
                ),
                'title',
                array(
                    'name' => 'status',
                    'htmlOptions' => array('width' => 80),
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::image(App()->theme->baseUrl. "/images/" . (($data->status==1)?"tick_circle.png":"cross_circle.png")), array("//admin/default/update_status", "model" => "News", "pk"=>$data->id), array("class" => "update-status"))',
                    'filter' => array(1 => 'Active', 0 => 'Inactive')
                ),
                'promote' => array(
                    'name' => 'promote',
                    'type' => 'html',
                    'value' => '$data->getPromote()'
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => array(
                        'view' => array(
                            'options' => array('target' => '_blank')
                        )
                    )
                )
            ),
        ));
        ?>    </div>
</div>

<?php
?>
<script>
    $(document).ready(function() {
        /*
         $('.search-button').click(function(){
         $('.search-form').toggle();
         return false;
         });
         $('.search-form form').submit(function(){
         $.fn.yiiGridView.update('news-grid', {
         data: $(this).serialize()
         });
         return false;
         });
         */

        // DELETE
        /*
         $('#delete').bind('click', function() {
         $.params = ($.fn.yiiGridView.getSelection('news-grid') + '');
         if ($.params != '') {
         if(!confirm('Do you want to delete selected records:' + $.params))
         return false;
         $.params = 'YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>&chk[]=' + $.params.replace(/\,/g, '&chk[]=');
         $.ajax({
         type: 'POST',
         url: '<?php echo $this->createUrl('delete'); ?>',
         data: $.params,
         success: function(data) {
         $.fn.yiiGridView.update('news-grid');
         } 
         });
         } else {
         alert('No record selected to delete !');
         }
         return false;
         });*/

        // CREATE, VIEW, UPDATE
        $.bind_data = function() {
            /*$('#create, a.view, a.update').each(function(index) {
                $(this).bind('click', function() {
                    $.fancybox.open({
                        href: $(this).attr('href') + '?ajax=1&t=<?php echo date('Ymdhi'); ?>',
                        type: 'iframe',
                        width: '100%',
                        helpers: {overlay: {closeClick: false}},
                        afterClose: function() {
                            $.fn.yiiGridView.update('news-grid');
                        }
                    });
                    return false;
                });
            });
			*/
            $.fn.editable.defaults.mode = 'popup';
            $.fn.editable.defaults.ajaxOptions = {dataType: 'json'};
            //make options editable
            $('.option-update').editable({
                source: <?php echo CJSON::encode(News::$promote) ?>,
                success: function(response, newValue) {
                    if (!response.success)
                        return response.msg;
                }
            });
        };
        $.bind_data();

        $('a.update-status').live('click', function() {
            $.fn.yiiGridView.update('news-grid', {
                type: 'POST',
                url: $(this).attr('href'),
                success: function() {
                    $.fn.yiiGridView.update('news-grid');
                }
            });
            return false;
        });
		
		/* SEARCH FORM */
        $('form#form-search').submit(function() {
            //            
            var search = $('#search').val().length;
            //if (search < 3) {
                //alert('Nhập tối thiểu 3 ký tự ? ');
                //return false;
            //}
            $('#go').focus();
            location.href = '<?php echo Yii::app()->request->getUrl() ?>#s/' + $(this).serialize();
            return false;
        });

        // Bind the event Hash change.
        $(window).hashchange(function() {
            $.fn.yiiGridView.update('news-grid', {
                data: location.hash.substring(3),
                complete: function(data) {
                }
            });
        });

        // Bind Window on load.
        $(window).load(function() {
            if (window.location.hash) {
                $.fn.yiiGridView.update('news-grid', {
                    data: location.hash.substring(3)
                });
            }
        });
    });
</script>