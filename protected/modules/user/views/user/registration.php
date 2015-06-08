<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
$this->breadcrumbs = array(
    UserModule::t("Đăng ký"),
);
?>

<h1><?php echo UserModule::t("Đăng ký thành viên"); ?></h1>

<?php if (Yii::app()->user->hasFlash('registration')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('registration'); ?>
    </div>
<?php else: ?>

    <div>
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

        <?php echo $form->errorSummary(array($model, $profile)); ?>

        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
    <!--                <input type="text" class="form-control" name="RegistrationForm[username]" id="username" placeholder="Username" data-minlength="5"
                       data-error="Username should not left empty OR less than 5 characters" required >-->
                <?php
                echo $form->textField($model, 'username', array(
                    'class' => 'form-control',
                    'id' => 'username',
                    'placeholder' => 'Tên đăng nhập',
                    'data-minlength' => '5',
                    'data-error' => UTranslate::t('Tên đăng nhập không được trống hoặc nhỏ hơn 5 ký tự'),
                    'max-length' => '60',
                    'required' => 'required'
                ));
                ?>
                <div class="help-block with-errors"></div>
            </div>            
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
    <!--                <input type="password" class="form-control" name="RegistrationForm[password]" id="password" data-minlength="8"
                       data-error="Password must content a symbol" placeholder="Password" required >-->
                <?php
                echo $form->passwordField($model, 'password', array(
                    'class' => 'form-control',
                    'id' => 'pasword',
                    'placeholder' => 'Mật khẩu',
                    'data-minlength' => '8',
                    'data-error' => UTranslate::t('Mật khẩu không được trống hoặc nhỏ hơn 8 ký tự'),
                    'max-length' => '60',
                    'required' => 'required'
                ));
                ?>
                <span class="help-block">Minimum of 8 characters</span>
                <div class="help-block with-errors"></div>
            </div>            
        </div>

        <div class="form-group">
            <label for="verifyPassword" class="col-sm-2 control-label">Retype Password</label>
            <div class="col-sm-10">
    <!--                <input type="password" class="form-control" name="RegistrationForm[verifyPassword]" id="retype-password" 
                       placeholder="Retype Password" data-match="#password" required >-->
                <?php
                echo $form->passwordField($model, 'verifyPassword', array(
                    'class' => 'form-control',
                    'id' => 'retype-password',
                    'placeholder' => 'Xác nhận lại mật khẩu',
                    'data-match' => '#password',
                    'required' => 'required',
                ));
                ?>
                <div class="help-block with-errors"></div>
            </div>            
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
<!--                <input type="email" class="form-control" name="RegistrationForm[email]" id="email" 
                       placeholder="Email" data-error="Email invalid" required >-->
                       <?php
                       echo $form->textField($model, 'email', array(
                           'class' => 'form-control',
                           'type' => 'email',
                           'id' => 'email',
                           'placeholder' => 'Email',
                           'data-error' => UTranslate::t('Email không hợp lệ'),
                           'required' => 'required'
                       ));
                       ?>
                <div class="help-block with-errors"></div>
            </div>
        </div>

                <?php
                $profileFields = $profile->getFields();
                if ($profileFields) {
                    foreach ($profileFields as $field) {
                        ?>
                <div class="form-group">
                        <?php echo $form->labelEx($profile, $field->varname, array('class' => 'col-sm-2 control-label')); ?>̣̣̣
                    <div class="col-sm-10">
                        <?php
                        if ($field->widgetEdit($profile)) {
                            echo $field->widgetEdit($profile);
                        } elseif ($field->range) {
                            echo $form->dropDownList($profile, $field->varname, Profile::range($field->range, array('class' => 'form-control')));
                        } elseif ($field->field_type == "TEXT") {
                            echo$form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                        } else {
                            echo $form->textField($profile, $field->varname, array(
                                'size' => 60,
                                'maxlength' => (($field->field_size) ? $field->field_size : 255),
                                'class' => 'form-control'
                            ));
                        }
                        ?>
                    </div>
                    <?php echo $form->error($profile, $field->varname); ?>
                </div>	
                    <?php
                }
            }
            ?>
    <?php if (UserModule::doCaptcha('registration')): ?>
            <div>
            <?php echo $form->labelEx($model, 'verifyCode'); ?>

        <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model, 'verifyCode'); ?>
                <?php echo $form->error($model, 'verifyCode'); ?>

                <p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
                    <br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
            </div>
    <?php endif; ?>

        <div>
    <?php echo CHtml::submitButton(UserModule::t("Đăng ký"), array('class' => 'btn')); ?>
        </div>

    <?php $this->endWidget(); ?>
    </div><!-- form -->
<?php endif; ?>