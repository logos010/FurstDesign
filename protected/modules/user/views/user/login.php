<section><!--form-->
    <div class="container">
        <div class="row"> <!-- login -->
            <div class="col-sm-12">
                <div class="login-form"><!--login form-->
                    <span class="page_ttl">SIGN IN</span>
                    <div class="clear"><br/><br/></div>
                    <?php echo CHtml::beginForm('', 'post', array('class' => 'form-horizontal')); ?> 
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Username: </label>
                        <input type="text" name="UserLogin[username]" placeholder="" size="60"/>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password: </label>
                        <input type="password" name="UserLogin[password]" placeholder="" size="60"/>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn pull-right" />
                        </div>
                    </div>                        
                    <?php echo CHtml::endForm(); ?>
                </div><!--/login form-->
            </div>
        </div> <!-- end of login -->
        <hr/>
        <div class="row">
            <div class="col-sm-12">
                <span class="page_ttl">Create an account</span>
                <ul>
                    <li>
                        You can create your own account in order to login and make purchase
                        <input type="button" value="Create my account"class="btn pull-right" />
                    </li>
                </ul>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-12">
                <span class="page_ttl">Forgot my password</span>
                <ul>
                    <li>
                        Click here to receive your new password
                        <input type="button" value="Forgot password" class="btn pull-right" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section><!--/form-->