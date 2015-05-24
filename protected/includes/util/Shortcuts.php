<?php

function App() {
    return Yii::app();   
}

function webroot() {
    return Yii::getPathOfAlias('webroot');
}

function cs() {
    return Yii::app()->clientScript;
}

function url($route, $params = array(), $ampersand = '&') {
    return Yii::app()->createUrl($route, $params, $ampersand);
}

/**
 * default position is POS_BEGIN
 **/
function cssFile($path, $position = CClientScript::POS_BEGIN){
    return cs()->registerCssFile($path);
}

/**
 * default position is POS_END
 **/
function scriptFile($path, $position = CClientScript::POS_END){
    return cs()->registerScriptFile($path, $position);    
}

function themeUrl(){
    return App()->theme->baseUrl;
}

function prefixGenerator($string){
    $pieces = explode(" ", $string);
    $str="";
    foreach($pieces as $piece){
        $str.=$piece[0];
    }    
    return $str;
}
