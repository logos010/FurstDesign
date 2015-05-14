<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="Shortcut Icon" type="image/ico"
              href="<?php echo Yii::app()->theme->baseUrl; ?>/images/tgnh_icon.ico" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" rel="stylesheet" />
        
        <?php // cs()->registerCoreScript('jquery'); ?>  
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <style>
        body {padding: 5px}
    </style>

    <body>
        <div class="container-fluid" id="<?php echo App()->controller->getId(); ?>">
            <div class="box">
                <?php echo $content; ?>
            </div>  
        </div>
    </body>
</html>