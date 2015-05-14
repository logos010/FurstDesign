<?php
$this->breadcrumbs = array(
    'Products',
);

$this->menu = array(
    array('label' => 'Create Product', 'url' => array('create')),
    array('label' => 'Manage Product', 'url' => array('admin')),
);
?>

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <?php $this->widget('application.components.Promotion'); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section><!--product category-->
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?php $this->widget('application.components.ProductLeftHandSide'); ?>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    <!--Products grid -->
                    <div id="loading" class="hidden">
                        <img src="<?php echo App()->theme->baseUrl ?>/images/loading.gif" alt="loading" />
                    </div>
                    <div id="product-grid">
                    <?php
                        echo $grid;
                    ?>
                    </div>
                    <!--End of product grid-->
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    //add to cart
    $("a.add-to-cart").on('click', function(){
        var quantity = 1;
        var productID = $(this).attr('id').substring(8, 9);
        console.log(productID);
        $.ajax({
            url: "<?php echo App()->controller->createUrl('/order/addToCart'); ?>",
            type: 'post',
            data: "pid="+productID+"&quantity="+quantity,
            success: function(items){                             
                $("a#shopping-item").find("span").html(items + " items(s) in");
            },
        });
    });
</script>
