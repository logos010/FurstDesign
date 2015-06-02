<?php
$this->breadcrumbs = array(
    'Products',
);

$this->menu = array(
    array('label' => 'Create Product', 'url' => array('create')),
    array('label' => 'Manage Product', 'url' => array('admin')),
);

//Multiple Select Dropdown -->
scriptFile(themeUrl() . "/js/jquery-ui-1.8.23.custom.min.js", CClientScript::POS_BEGIN);
scriptFile(themeUrl() . "/js/mainnav-smoothScrolling.js", CClientScript::POS_BEGIN);
scriptFile(themeUrl() . "/js/jQuery.equalHeights.js", CClientScript::POS_BEGIN);
?>

<div id="static-content">   
    <?php foreach ($terms as $k => $v): ?>
                    <!--<a href="<?php echo App()->controller->createUrl('product/cate/', array('tid' => $v->id)); ?>"><?php echo $v->name; ?></a><br/>-->
    <?php endforeach; ?>


    <!-- slide -->
    <div style="width:960px;float:left;margin-bottom:5px;margin-top:8px;">
        <div id="delivery-destination" style="width:466px;float:left;">
            <div id="sliderhome">
                <ul class="bxslider">
                    <?php foreach ($promote as $k => $v): ?>   
                        <li>
                            <a href="<?php echo App()->controller->createUrl('product/detail/', array('pid' => $v->id)) ?>">
                                <img src="<?php echo BASE_URL . "/" . $v->image; ?>" border="0" alt="<?php echo $v->name; ?>" width="476" height="608">
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!--Promotion 2-->
        <div id="home-shoes" style="width:476px;float:right;">
            <?php $this->widget('application.components.PromotionRightBottom'); ?>
        </div>

        <!--Promotion 3-->
        <div style="width:476px;float:right;margin-top:8px;">
            <?php $this->widget('application.components.PromotionRightBottom', array('position' => 2)); ?>
            <?php $this->widget('application.components.PromotionRightBottom', array('position' => 3)); ?>
            <img width="0" height="0" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
        </div>
    </div>

    
    <?php $this->widget('application.components.PromotionRightBottom', array('position' => 4)); ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.bxslider').bxSlider({
                mode: 'vertical',
                auto: true,
                pager: true,
                controls: false,
                adaptiveHeight: true,
                responsive: true,
                speed: 400,
                pause: 6000
            });
        });
    </script>
</div>