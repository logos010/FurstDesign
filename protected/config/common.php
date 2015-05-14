<?php

return array(
    'basePath' => dirname(__file__) . DIRECTORY_SEPARATOR . '..',
    'name' => SITE_NAME,
    'language' => LOCALE,
    'theme' => THEME,
    //'preload' => array('log'),
    'aliases' => array('bootstrap' => 'ext.bootstrap'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.base.*',
        'application.includes.core.*',
        'application.includes.util.*',
        'application.includes.webService.*',
        'application.modules.user.models.User',
        'application.modules.srbac.controllers.SBaseController',
        'ext.cart.*',
        ),
    'modules' => array(
        'admin',
        'contact',
        'user' => array(
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => false,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
            ),
        'srbac' => array(
            'userclass' => 'User',
            'userid' => 'id',
            'username' => 'username',
            'delimeter' => '@',
            'debug' => YII_DEBUG ? true : false,
            'pageSize' => 15,
            'superUser' => 'Admin',
            'css' => false,
            'layout' => 'srbac.views.authitem.0',
            'notAuthorizedView' => 'srbac.views.authitem.unauthorized',
            'alwaysAllowed' => array(
                'SiteIndex',
                'SiteError',
                'user@LoginLogin',
                'user@LogoutLogout'),
            'listBoxNumberOfLines' => 15,
            'imagesPath' => 'srbac.images',
            'imagesPack' => 'tango',
            'iconText' => true,
            'header' => 'srbac.views.authitem.header',
            'footer' => 'srbac.views.authitem.header',
            'showHeader' => false,
            'showFooter' => false,
            'alwaysAllowedPath' => 'srbac.components'),
        ),
    // application components
    'components' => array(
        'user' => array(
            'class' => 'application.includes.core.WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('user/login')),
        'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => DB_CONNECTION,
            'emulatePrepare' => true,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'charset' => DB_CHARSET,
            'tablePrefix' => DB_TABLE_PREFIX,
            ),
        'mail' => array(
            'class' => 'ext.mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'smtp.gmail.com',
                'username' => 'no-reply@eswebsoft.com',
                'password' => 'eswebsoft.com',
                'port' => '465',
                'encryption' => 'ssl',
                ),
            //            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false),
        'errorHandler' => array( // use 'site/error' action to display errors
                'errorAction' => 'site/error', ),
        'authManager' => array(
            'class' => 'application.modules.srbac.components.SDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'tbl_auth_item',
            'assignmentTable' => 'tbl_auth_assignment',
            'itemChildTable' => 'tbl_auth_item_child',
            ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'urlSuffix' => '',
            'caseSensitive' => false,
            'showScriptName' => false,
            'rules' => array('/' => 'site/index', 'detail/<cate>/<alias:\w>-<id:\d>' =>
                    'product/view'),
            ),
        'bootstrap' => array('class' => 'bootstrap.components.Bootstrap', ),
        'shoppingCart' => array('class' => 'ext.cart.EShoppingCart', ),
        'cache' => array('class' => 'system.caching.CFileCache', ),
        'log' => array('class' => 'CLogRouter', ),
        ),
    'params' => array());
