<?php
$this->pageTitle = UserModule::t('View User') . ' "' . $model->username . '"';
$this->breadcrumbs = array(
    UserModule::t('Users') => array('admin'),
    $model->username,
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->pageTitle; ?></h3>
    </div>
    <div class="panel-body">
        <?php
        $attributes = array(
            'id',
            'username',
        );

        $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
        if ($profileFields) {
            foreach ($profileFields as $field) {
                array_push($attributes, array(
                    'label' => UserModule::t($field->title),
                    'name' => $field->varname,
                    'type' => 'raw',
                    'value' => (($field->widgetView($model->profile)) ? $field->widgetView($model->profile) : (($field->range) ? Profile::range($field->range, $model->profile->getAttribute($field->varname)) : $model->profile->getAttribute($field->varname))),
                ));
            }
        }

        array_push($attributes, 'password', 'email', 'activkey', array(
            'name' => 'createtime',
            'value' => date("d.m.Y H:i:s", $model->createtime),
                ), array(
            'name' => 'lastvisit',
            'value' => (($model->lastvisit) ? date("d.m.Y H:i:s", $model->lastvisit) : UserModule::t("Not visited")),
                ), array(
            'name' => 'superuser',
            'value' => User::itemAlias("AdminStatus", $model->superuser),
                ), array(
            'name' => 'status',
            'value' => User::itemAlias("UserStatus", $model->status),
                )
        );

        $this->widget('zii.widgets.CDetailView', array(
            'cssFile' => App()->theme->baseUrl . '/css/yii.css',
            'data' => $model,
            'attributes' => $attributes,
        ));
        ?>
    </div>
</div>
