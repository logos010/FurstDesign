
<?php echo CHtml::beginForm('', 'post', array('enctype' => 'multipart/form-data')); ?>

<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

<?php echo CHtml::errorSummary(array($model, $profile)); ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">Login Infomation</div>
    </div>
    <div class="panel-body">
        <div>
            <?php echo CHtml::activeLabelEx($model, 'username'); ?>
            <?php echo CHtml::activeTextField($model, 'username', array('class' => 'span8', 'maxlength' => 20)); ?>
            <?php echo CHtml::error($model, 'username'); ?>
        </div>

        <div class="row-fluid">
            <div class="pull-left span6">
                <?php echo CHtml::activeLabelEx($model, 'password'); ?>
                <?php echo CHtml::activePasswordField($model, 'password', array('class' => 'span10', 'maxlength' => 128)); ?>
                <?php echo CHtml::error($model, 'password'); ?>
                <?php echo CHtml::activeLabelEx($model, 'email'); ?>
                <?php echo CHtml::activeTextField($model, 'email', array('class' => 'span10', 'maxlength' => 128)); ?>
                <?php echo CHtml::error($model, 'email'); ?>
            </div>
            <div class="pull-left span6">
                <?php echo CHtml::activeLabelEx($model, 'superuser'); ?>
                <?php echo CHtml::activeDropDownList($model, 'superuser', User::itemAlias('AdminStatus'), array('class' => 'span10')); ?>
                <?php echo CHtml::error($model, 'superuser'); ?>
                <?php echo CHtml::activeLabelEx($model, 'status'); ?>
                <?php echo CHtml::activeDropDownList($model, 'status', User::itemAlias('UserStatus'), array('class' => 'span10')); ?>
                <?php echo CHtml::error($model, 'status'); ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">Profile Infomation</div>
    </div>
    <div class="panel-body">
        <?php
        $profileFields = $profile->getFields();
        if ($profileFields) {
            foreach ($profileFields as $field) {
                ?>
                <div>
                    <?php echo CHtml::activeLabelEx($profile, $field->varname); ?>
                    <?php
                    if ($field->widgetEdit($profile)) {
                        echo $field->widgetEdit($profile);
                    } elseif ($field->range) {
                        echo CHtml::activeDropDownList($profile, $field->varname, Profile::range($field->range), array('class' => 'span10'));
                    } elseif ($field->field_type == "TEXT") {
                        echo CHtml::activeTextArea($profile, $field->varname, array('rows' => 6, 'cols' => 50,));
                    } else {
                        echo CHtml::activeTextField($profile, $field->varname, array('class' => 'span10', 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                    }
                    ?>
                    <?php echo CHtml::error($profile, $field->varname); ?>
                </div>	
                <?php
            }
        }
        ?>
    </div>
</div>

<div class="form-actions text-center">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')) ?>
    <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger')) ?>
</div>

<?php echo CHtml::endForm(); ?>
