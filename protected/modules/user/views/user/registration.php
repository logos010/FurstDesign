<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
$this->breadcrumbs = array(
    UserModule::t("Registration"),
);
?>

<h1><?php echo UserModule::t("Registration"); ?></h1>

<?php if (Yii::app()->user->hasFlash('registration')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('registration'); ?>
    </div>
<?php else: ?>

    <div class="form">
        <?php
        $form = $this->beginWidget('UActiveForm', array(
            'id' => 'registration-form',
            'enableAjaxValidation' => true,
            'disableAjaxValidationAttributes' => array('RegistrationForm_verifyCode'),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal',
                'data-toggle' => 'validator'
            ),
        ));
        ?>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="RegistrationForm[username]" id="username" placeholder="Username" data-minlength="5"
                       data-error="Username should not left empty OR less than 5 characters" required >
                <div class="help-block with-errors"></div>
            </div>            
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="RegistrationForm[password]" id="password" data-minlength="8"
                       data-error="Password must content a symbol" placeholder="Password" required >
                <span class="help-block">Minimum of 8 characters</span>
                <div class="help-block with-errors"></div>
            </div>            
        </div>

        <div class="form-group">
            <label for="verifyPassword" class="col-sm-2 control-label">Retype Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="RegistrationForm[verifyPassword]" id="retype-password" placeholder="Retype Password" data-match="#password" required >
                <div class="help-block with-errors"></div>
            </div>            
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="RegistrationForm[email]" id="email" placeholder="Email" data-error="Email invalid" required >
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="fullname" class="col-sm-2 control-label">Fullname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Profile[fullname]" id="fullname" placeholder="Fullname" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-10">
                <input type="tel" class="form-control" name="Profile[phone]" id="phone" placeholder="Phone" required >
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Profile[address]" id="address" placeholder="Address" required >
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="birthday" class="col-sm-2 control-label">Birthday</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Profile[birthday]" id="birthday" data-date-viewmode="years" data-provide="datepicker" placeholder="Birthday">
                <div class="help-block with-errors"></div>
            </div>
            <div id="birthday"></div>
        </div>

        <div class="form-group">
            <!--            <label for="capcha" class="col-sm-2 control-label">Captcha</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Profile[fullname]" id="captcha" placeholder="Fullname">
                            <div class="help-block with-errors"></div>
                        </div>-->
            <?php $this->widget('CCaptcha'); ?>
            <?php echo $form->textField($model, 'verifyCode'); ?>
            <?php echo $form->error($model, 'verifyCode'); ?>
        </div>

        <?php echo CHtml::submitButton(UserModule::t("Register"), array('class' => 'btn btn-default')); ?>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
<?php endif; ?>

<script type="text/javascript">
    $('#birthday').datepicker()
</script>