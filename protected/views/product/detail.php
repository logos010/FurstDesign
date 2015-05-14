<?php
cssFile(themeUrl() . "/css/star-rating.css");
scriptFile(themeUrl() . "/js/jquery.elevatezoom.js", CClientScript::POS_BEGIN);
scriptFile(themeUrl() . "/js/validator.min.js", CClientScript::POS_BEGIN);

?>
<style>
    #msg{display:  none}
</style>

<section><!--product category-->
    <div class="container">
        <div class="row">
            <div class="col-sm-3 hidden-xs">
                <?php $this->widget('application.components.ProductLeftHandSide'); ?>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <?php $productImage = str_replace('/small', '/original', $product->image); ?>
                            <img id="img_01" src="<?php echo BASE_URL . "/" . $product->image; ?>" data-zoom-image="<?php echo BASE_URL . "/" . $productImage; ?>" alt="<?php echo $product->name; ?>"/>
                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div id="gallery_01">
                                        <?php
                                        if (!is_null($gallery)):
                                            foreach ($gallery as $k => $v):
                                                $g = str_replace('/orginal', '/small', $v->uri);
                                                echo CHtml::openTag('a', array('href' => '#', 'data-image' => BASE_URL . "/" . $g, 'data-zoom-image' => BASE_URL . "/" . $v->uri));
                                                echo CHtml::image(BASE_URL . "/" . $g, $v->name, array('id' => 'img_01'));
                                                echo CHtml::closeTag('a');
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="<?php echo App()->theme->baseUrl; ?>/images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2><?php echo $product->name; ?></h2>
                            <p>Web ID: 1089772</p>                                                        
                            <!--<input id="prod-rating" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" data-stars="5">-->
                            <input id="prating" value="0" type="number" class="rating">
                            <span>
                                <span><?php echo number_format($product->price, 0, '.', ','); ?> <sup>đ</sup></span>
                                <label>Quantity:</label>
                                <input type="text" value="3" name="qanntity" id="prod_quantity"/>
                                <button type="button" class="btn btn-fefault cart" >
                                    <i class="fa fa-shopping-cart"></i>
<!--                                    <a href="javascript:void(0)" id="add-to-cart">Add to cart</a>-->
                                    Add to cart
                                </button>
                            </span>
                            <p><b>Availability:</b> <?php echo ($product->quantity > 0) ? 'Còn Hàng' : 'Liên Hệ'; ?></p>
                            <p><b>Condition:</b> New</p>
                            <p><b>Brand:</b> E-SHOPPER</p>

                            <!-- Social share buttons -->
                            <div id="share-buttons"> 
                                <!-- Facebook -->
                                <a href="http://www.facebook.com/sharer.php?u=http://www.simplesharebuttons.com" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" /></a>
                                <!-- Twitter -->
                                <a href="http://twitter.com/share?url=http://www.simplesharebuttons.com&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" /></a>
                                <!-- Google+ -->
                                <a href="https://plus.google.com/share?url=http://www.simplesharebuttons.com" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/google.png" alt="Google" /></a>
                            </div>

                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Chi Tiết</a></li>
                            <li><a href="#tag" data-toggle="tab">Tag</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Reviews (<?php echo $numOfReview; ?>)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details" >
                            <?php echo $product->detail; ?>
                        </div>

                        <!-- Tag -->
                        <div class="tab-pane fade" id="tag" >   
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="images/home/gallery1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>

                        <!-- Reviews -->
                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                                <?php  
                                    if (!is_null($review)) :
                                        foreach ($review as $k => $v):                                            
                                ?>
                                    <ul>
                                        <li><a href="javascript:void(0)"><i class="fa fa-user"></i><?php echo $v->name; ?></a></li>
                                        <li><a href="javascript:void(0)"><i class="fa fa-clock-o"></i><?php echo $v->date; ?></a></li>
                                        <li><a href="javascript:void(0)"><i class="fa fa-calendar-o"></i><?php echo $v->time; ?></a></li>
                                    </ul>
                                    <p><?php echo $v->content; ?></p>
                                <?php
                                        endforeach;;
                                    endif; 
                                ?>                                
                                
                                <b>Write Your Review</b>
                                <form method="post" id="prod-review-form" role="form" data-toggle="validator">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-9" id="msg">
                                                <div class="alert alert-info">
                                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                    <strong>OnlineShop</strong> cám ơn bạn đã để lại lời nhắn.
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="row">                                            
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label" placeholder="Your Name" >Name</label>
                                                    <input type="text" class="form-control" id="inputName" placeholder="Your Name" name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputEmail" class="control-label">Email</label>
                                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" data-error="That email address is invalid" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea name="content" class="form-control" data-error="You neet to give your feedback" required ></textarea>
                                                    <div class="help-block with-errors"></div>
                                                    <button type="button" class="btn btn-primary" id="submit-prod-review" style="margin-top: 0px">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->
                
                <?php if (count($recommendProducts)): ?>
                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                                $totalRecmdProd = count($recommendProducts);
                                for ($i=1; $i<=$totalRecmdProd; $i++):
                                    $active = $i<=3 ? 'active' : '';
                            ?>
                            <div class="item <?php echo $active; ?>">
                                <?php foreach ($recommendProducts as $k => $v): ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="<?php echo App()->createUrl('/product/detail', array('pid' => $v->id)); ?>"><img src="<?php echo BASE_URL . "/" . $v->image; ?>" alt="<?php echo $v->name; ?>" /></a>
                                                <h2><?php echo number_format($v->price, 0, " ", ","); ?> <sup>d</sup></h2>
                                                <a href="<?php echo App()->createUrl('/product/detail', array('pid' => $v->id)); ?>"><p><?php echo $v->name; ?></p></a>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endfor; ?>
                            
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>			
                    </div>
                </div><!--/recommended_items-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
    /*set a border on the images to prevent shifting*/ 
    #gallery_01 img{border:1px solid white;} 
    /*Change the colour*/ 
    /*.active img{border:2px solid #333 !important;}*/
</style>

<script src="<?php echo themeUrl(); ?>/js/star-rating.js" type="text/javascript"></script>
<script type="text/javascript">
    //Gallery
    $("#img_01").elevateZoom({
        constrainType: "height",
        constrainSize: 274,
        zoomType: "lens",
        containLensZoom: true,
        gallery: 'gallery_01',
        cursor: 'pointer',
        galleryActiveClass: "active"
    });
    $("#img_01").bind("click", function (e) {
        var ez = $('#zoom_03').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
    });

    //Rating stars
    $("#prating").rating({
        min: 0,
        max: 5,
        step: 1,
        size: 'xs',
        stars: 5,
        clearButton: '<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-remove"></i> Clear</button>',
        clearElement: "#kv-clear",
        captionElement: "#kv-caption"
    });

    $("#prating").on('rating.change', function (event, value, caption) {
        console.log(value);
    })

    //submit review button
    $("#submit-prod-review").on('click', function () {
        var formElement = $("form#prod-review-form").serialize();
        $.ajax({
            url: "<?php echo App()->controller->createUrl('product/productReview', array('pid' => $product->id)); ?>",
            type: 'post',
            data: formElement,
            success: function (data) {
                console.log(data);
                $("#msg").fadeToggle("slow", "linear");
            },
            complete: function () {
                document.getElementById("prod-review-form").reset();
                $("#msg").delay(5000).fadeToggle("slow", "linear");
            }
        });
        return false;
    });
    
    //add to cart
    $("button.cart").on('click', function(){
        var quantity = $("#prod_quantity").val();
        $.ajax({
            url: "<?php echo App()->controller->createUrl('/order/addToCart'); ?>",
            type: 'post',
            data: "pid=<?php echo $product->id; ?>&quantity="+quantity,
            success: function(items){
                //alert('added ' + items);              
                $("a#shopping-item").find("span").html(items + " items(s) in");
            },
        });
    });
</script>