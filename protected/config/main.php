<?php

require_once 'ENV.php';

$common = require 'common.php';
$env = require (YII_DEBUG ? 'development.php' : 'production.php');
$shortcuts = dirname(__FILE__).'/../includes/util/Shortcuts.php';

require_once($shortcuts);
return CMap::mergeArray($common, $env);