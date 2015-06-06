<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <?php App()->bootstrap->register(); ?>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" rel="stylesheet" />

    </head>

    <body>
        <?php $this->widget('application.modules.admin.components.AdminMenu'); ?>
        <div class="container-fluid" style="margin-top: 60px">

            <div class="container-fluid" id="<?php echo App()->controller->getId(); ?>">
                <?php
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'homeLink' => CHtml::link('Home', array('//admin/menu/index/Menu[vid]/1')),
                    'links' => App()->controller->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
                <?php App()->controller->renderFlash(); ?>
                <div class="box">
                    <?php echo $content; ?>
                </div>
            </div>

            <div class="row-fluid text-center">
                Copyright &copy; 2011, designed by <?php echo CHtml::link('ES-Websoft', 'http://eswebsoft.com', array('target' => 'blank')); ?>
            </div>
        </div>

    </body>
</html>