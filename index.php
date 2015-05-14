<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../yii/framework/yii.php';
$env = dirname(__FILE__) . '/protected/config/ENV.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

require_once($env);
require_once($yii);
Yii::createWebApplication($config)->run();
