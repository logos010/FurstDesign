<?php
$this->breadcrumbs = array(
    'Create Parameters',
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            Create Key <?php echo ucwords($model->name); ?>
        </h3>
    </div>
    <div class="panel-body">
        <?php if (isset($name)) { ?>
            <form method="get" action="<?php echo url('create'); ?>">
                <div>
                    <label>Name:</label>
                    <input id="name" name="name" type="text" class="span4" />
                </div>

                <div>
                    <label>Type:</label>
                    <select id="type" name="type">
                        <option value="text">Text</option>
                        <option value="json">JSon</option>
                        <option value="file">File</option>
                    </select>
                </div>

                <div class="form-actions text-center">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')) ?>
                </div>

            </form>


            <script>
                $('form').submit(function() {
                    if ($('#name').val() == '')
                        return false;
                    $.url = '<?php echo BASE_URL ?>/admin/config/create/name/' + $('#name').val() + '/type/' + $('#type').val() + '/ajax/<?php echo $_GET['ajax'] ?>';
                    $(location).attr('href', $.url);
                    return false;
                });
            </script>
            <?php
        } else {
            echo $this->renderPartial('_form', array('model' => $model));
        }
        ?>
    </div>
</div>





