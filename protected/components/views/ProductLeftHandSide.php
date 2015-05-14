<div class="left-sidebar">
    <h2>Category</h2>

    <div class="panel-group category-products" id="accordian"><!--category-productsr-->        
        <?php echo $terms; ?>
    </div>
    
    <div class="price-range"><!--price-range-->
        <h2>Price Range</h2>
        <div class="well">
            <input type="text" class="span2" value="" data-slider-min="50000" data-slider-max="500000" data-slider-step="10000" data-slider-value="[50000,300000]" id="sl2" ><br />
            <b>50000<sup>d</sup></b> <b class="pull-right">500000</b>           
        </div>
    </div><!--/price-range-->

    <div class="shipping text-center"><!--shipping-->
        <img src="<?php echo App()->theme->baseUrl; ?>/images/home/shipping.jpg" alt="" />
    </div><!--/shipping-->
</div>