<?php
$this->breadcrumbs = array(
    'Products',
);

$this->menu = array(
    array('label' => 'Create Product', 'url' => array('create')),
    array('label' => 'Manage Product', 'url' => array('admin')),
);

?>

<section>
    <!--Products grid -->
    <div class="catalogue-container">
        <div class="catalogue-banner">
            <a href="Promotions.html#2">
                <img src="<?php echo App()->theme->baseUrl; ?>/images/banner/ck-product-catalogue-standard-delivery-intl-7-apr.png" border="0"/>
            </a>
        </div>
        <div class="spacer2"></div>

        <!-- FILTER PRODUCT-->
        <div class="filter-container">
            <div class="filter-dropdown" style="visibility: visible;">
                <form id="productFilterForm" name="productFilterForm" action="http://www.charleskeith.com/INTLStore/CK/ASM/New-Arrivals/Shoes" method="POST">
                    <!-- Multiselect here-->
                </form>
            </div>

            <div class="total-products right" style="text-transform:none; float:right;">
                <span id="total" style="display: none">15</span><span id="new-total"><?php echo $totalProducts; ?></span> Item(s)
            </div>
            <div class="clear"></div>
        </div>
        <!-- END OF FILTER PRODUCT -->
        <div class="spacer"></div>        

        <div class="equalize" id="equalize" data-equal="div" style="overflow:visible; width:98%; padding:0 1%; margin:auto;">
            <?php foreach ($products as $k => $v): ?>
            <div class="catalogue-itembox" style="width: 27.3%; padding: 3%; height:310px; margin-top: 3.5em">
                <div class="item-product-img">
                    <a href="<?php echo App()->controller->createUrl('product/detail', array('pid' => $v->id)); ?>">                        
                        <img src="<?php echo BASE_URL . "/" . $v->image; ?>" border="0" class="product-img">
                    </a>                    
                    <br>
                </div>
                <div class="item-desc">
                    <a href="<?php echo App()->controller->createUrl('product/detail', array('pid' => $v->id)); ?>">
                        <!--<div class="product-name"><?php echo $v->name; ?></div>-->
                        <span><strong><?php echo $v->name; ?></strong></span>
                        <div class="clear2"></div><span> CK1-70380433</span> 
                    </a>
                    <div class="clear2"></div>
                    <?php echo ($v->discount != 0) ? $v->isProductDiscounted($v) : "<span class='product-price'>".number_format($v->price, 0, "", ",") . "</span><sup> đ</sup>"; ?>
                    <div class="clear2"></div>
                    <div class="item-label">NEW </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--End of product grid-->
</section>