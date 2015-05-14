<section><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <?php echo CHtml::beginForm(); ?>                     
                        <?php echo CHtml::activeTextField($model,'username', array('placeholder' => 'Username')) ?>
                        <?php echo CHtml::activePasswordField($model,'password', array('placeholder' => 'Password')) ?>
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    <?php echo CHtml::endForm(); ?>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="#">
                        <?php echo CHtml::activeTextField($model,'username', array('placeholder' => 'Username')) ?>
                        <?php echo CHtml::activeTextField($model,'email', array('placeholder' => 'Email')) ?>
                        <?php echo CHtml::activePasswordField($model,'password', array('placeholder' => 'Password')) ?>                        
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->