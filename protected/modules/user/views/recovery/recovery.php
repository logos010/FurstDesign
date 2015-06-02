<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Restore");
$this->breadcrumbs = array(
    UserModule::t("Login") => array('/user/login'),
    UserModule::t("Restore"),
);
?>

<h1><?php echo UserModule::t("Restore"); ?></h1>

<?php if (Yii::app()->user->hasFlash('recoveryMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
    </div>
<?php else: ?>

    <div>
        <?php
        echo CHtml::beginForm('', 'post', array(
            'class' => 'form-horizontal',
            'data-toggle' => 'validator'));
        ?>
        <?php echo CHtml::errorSummary($form); ?>	
        <div class="form-group">
            <?php echo CHtml::activeLabel($form, 'login_or_email', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo CHtml::activeTextField($form, 'login_or_email', array(                    
                    'required' => 'required',
                    'class' => 'form-control',
                    'placeholder' => 'Email or Username')) ?>
                <p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div>
            <?php echo CHtml::submitButton(UserModule::t("Restore"), array('class' => 'btn')); ?>
        </div>

        <?php echo CHtml::endForm(); ?>
    </div><!-- form -->
<?php endif; ?>