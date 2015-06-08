<?php
$this->breadcrumbs = array(
    'Sản phẩm'
);
?>
<div class="product-details-container">
    <div class="product-details-column-left">
        <!-- START OF MAIN PRODUCT IMAGE -->
        <div class="main-product-img">
            <div class="clearfix">
                <?php
                $mediumImg = BASE_URL . '/' . $product->image;
                $largeImg = BASE_URL . '/' . str_replace('medium', 'original', $product->image);
                ?>
                <a href="<?php echo $largeImg; ?>" class="jqzoom" rel='gal1'  title="<?php echo $product->name; ?>" >
                    <img src="<?php echo $mediumImg; ?>"  title="<?php echo $product->name; ?>">
                </a>
            </div>

            <br>
            <div class="clearfix">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr align="center">
                            <td align="center">
                                <ul id="thumblist" class="clearfix">
                                    <?php foreach ($gallery as $k => $v): ?>
                                        <li>
                                            <?php
                                            $smallImg = BASE_URL . '/' . str_replace('original', 'small', $v->uri);
                                            $mediumImg = BASE_URL . '/' . str_replace('original', 'medium', $v->uri);
                                            $largeImg = BASE_URL . '/' . str_replace('original', 'original', $v->uri);
                                            ?>
                                            <a class="zoomThumbActive" href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?php echo $mediumImg; ?>',largeimage: '<?php echo $largeImg; ?>'}">
                                                <img src="<?php echo $smallImg; ?>" height="40" alt="ANKLE STRAP HEELS">
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                        <tr align="center">
                            <td align="center">
                                <div class="share-box">
                                    <span class="share-text">SHARE</span>
                                    <div class="share-icon" style="display: none;">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.charleskeith.com%2FINTLStore%2FCK%2FASM%2F%2520Shoes%2FHeels%2FAnkle-Strap-Heels%2FCream%2FCK1-60360771%2FProduct" class="facebook" target="_blank"></a>
                                        <a href="http://twitter.com/share?url=http%3A%2F%2Fwww.charleskeith.com%2FINTLStore%2FCK%2FASM%2F%2520Shoes%2FHeels%2FAnkle-Strap-Heels%2FCream%2FCK1-60360771%2FProduct" class="twitter" target="_blank"></a>
                                        <a href="https://plus.google.com/share?url=http%3A%2F%2Fwww.charleskeith.com%2FINTLStore%2FCK%2FASM%2F%2520Shoes%2FHeels%2FAnkle-Strap-Heels%2FCream%2FCK1-60360771%2FProduct" class="googleplus" target="_blank"></a>
                                        <a href="http://www.tumblr.com/share/link?url=http%3A%2F%2Fwww.charleskeith.com%2FINTLStore%2FCK%2FASM%2F%2520Shoes%2FHeels%2FAnkle-Strap-Heels%2FCream%2FCK1-60360771%2FProduct" class="tumblr" target="_blank"></a>
                                        <a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.charleskeith.com%2FINTLStore%2FCK%2FASM%2F%2520Shoes%2FHeels%2FAnkle-Strap-Heels%2FCream%2FCK1-60360771%2FProduct" class="pinterest" target="_blank"></a>
                                        <a href="http://statigr.am/charleskeithofficial" class="instagram" target="_blank"></a>
                                        <a href="mailto:?body=http%3A%2F%2Fwww.charleskeith.com%2FINTLStore%2FCK%2FASM%2F%2520Shoes%2FHeels%2FAnkle-Strap-Heels%2FCream%2FCK1-60360771%2FProduct" class="showoverlay email"></a>
                                        <a href="javascript:window.print()" class="print"></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END OF MAIN PRODUCT IMAGE -->
    </div> <!-- END OF COLUMN LEFT -->

    <div class="product-details-column-right">
        <div class="product-main-desc">
            <div class="product-name"><?php echo $product->name; ?></div>
            <div class="spacer"></div>
            <div class="product-code">CK1-60360771</div>
            <div class="spacer"></div>
            <div class="product-price">
                <?php echo ($product->discount != 0) ? $product->isProductDiscounted($product) : number_format($product->price, 0, '', ',') . "<sup> đ</sup>"; ?>
            </div>
            <div class="spacer"></div>
        </div>



        <!-- START OF BUTTON HOLDER -->
        <div class="product-navigator">                           
        </div>
        <!-- END OF BUTTON HOLDER --> 
        <div class="spacer"></div>

        <!-- START Main Info in Collapsible -->
        <div id="accordion-maininfo">
            <?php echo $product->detail; ?>
            <!-- Product detail block --> 
        </div>
        <div class="spacer"></div>
        <!-- END Main Info in Collapsible -->

        <div class="spacer2"></div>
        <div class="size-section" id="sizeDropDown">
            <select id="product_size" title="Size" multiple="multiple" name="Size" size="3">
                <option value="34">34</option>
                <option value="35">35</option>
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
            </select>
            <input type="hidden" name="product_size" id="prod_size" />
            <div class="clear"></div>
            <span id="sizeValidator" style="color: red"></span>
        </div>

        <div class="spacer"></div>
        <div class="qty-section" id="quantityDropDown">
            <select id="product_qty" title="Quantity" multiple="multiple" name="Quantity" size="3" disabled>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <input type="hidden" name="product_qty" id="prod_qty" />
        </div>

        <!-- START OF COLOR, SIZE, QTY SELECT SECTION -->

        <div class="qty-section" id="quantityDropDown">
        </div>
        <div class="clear"></div>
        <div class="spacer1-5"></div>
        <input id="addToBagButton" name="" type="image" value="ADD TO BAG" src="<?php echo App()->theme->baseUrl; ?>/images/buttons/new/btn-addtobag.gif" onclick="javascript:void(0)">
    </div>

    <div class="spacer2"></div>

    <!-- LAST PRODUCTS -->
    <div class="product-details-last-viewed">
        <div class="hr"></div>
        <div class="spacer2"></div>
        <h2>Last Viewed Products</h2>
        <script type="text/javascript">
            if (Cookies.get('lastViewedProucts').length != 0) {
                var lastViewed = $.parseJSON(Cookies.get('lastViewedProucts'));
                var baseUrl = '<?php echo BASE_URL . "/"; ?>';
                var count = lastViewed['items'].length;
                var productLink = "<?php echo App()->controller->createUrl('/product/detail/pid/'); ?>";

                for (i = 0; i < count; i++) {
                    document.write('<div class="catalogue-itembox">');
                    document.write('<div class="item-product-img">');
                    document.write('<a href="' + productLink + '/' + lastViewed['items'][i]['id'] + '">');
                    document.write('<img src="' + baseUrl + lastViewed['items'][i]['image'] + '" border="0" class="product-img" alt="' + lastViewed['items'][i]['name'] + '" title="' + lastViewed['items'][i]['name'] + '" />');
                    document.write('</a>');
                    document.write('</div>');
                    document.write('</div>');
                }
            }
//            console.log("Remove cookie - " + $.removeCookie('lastViewedProucts')); 
        </script>
        <div class="clear"></div>
    </div>

    <div class="clear"></div>
</div>

<script type="text/javascript">
    //settings of product main info accordion 
    $("#accordion-maininfo").accordion({
        //0019596: Auto-expand DETAILS tab in product detail page
        //active: false,
        heightStyle: "content",
        collapsible: true
    });
    // product image zoom in setting
    $('.jqzoom').jqzoom({
        zoomType: 'innerzoom',
        preloadImages: false,
        alwaysOn: false,
        title: false,
        zoomWidth: 2,
        zoomHeight: 2
    });
    // if the browser is IE8, remove the float style.
    // this is workaround for tracking issue #0015019 (Big image not displayed properly when viewing in product details page using IE8)
    if ($.browser.msie && document.documentMode && document.documentMode == 8) {
        $(".jqzoom").css("float", "none");
        if ($(".zoomPad").length > 0) {
            $(".zoomPad").css("float", "none");
        }
    }

    // show & hide share icons
    $(".share-text").mouseenter(function () {
        clearTimeout(timeout);
        $('.share-icon').show();
    });
    $(".share-text").mouseleave(function () {
        clearTimeout(timeout);
        timeout = setTimeout(function ()
        {
            $('.share-icon').hide();
        }, 200);
    });
    $(".share-icon").mouseenter(function () {
        clearTimeout(timeout);
        $('.share-icon').show();
    });
    $(".share-icon").mouseleave(function () {
        clearTimeout(timeout);
        timeout = setTimeout(function ()
        {
            $('.share-icon').hide();
        }, 200);
    });
    //select box
    $('#product_size').ddslick({
        height: 100,
        width: 100,
        selectText: "Size",
    });
    $('#product_qty').ddslick({
        height: 100,
        width: 100,
        selectText: "Quantitly",
    });
    //http://designwithpc.com/plugins/ddslick
    function getSelectedValue(selectBox) {
        $('#' + selectBox).on('click', function () {
            var ddData = $('#' + selectBox).data('ddslick');
            if (!$.isEmptyObject(ddData['selectedData'])) {
                $("input[name='" + selectBox + "']").val(ddData['selectedData']['value']);
                return ddData['selectedData']['value'];
            }
        });
    }
    getSelectedValue('product_size');
    getSelectedValue('product_qty');

    //add to cart
    $("#addToBagButton").on('click', function () {
        var s = $("input[name='product_size']").val();
        var q = $("input[name='product_qty']").val();
        var productName = '<?php echo $product->name; ?>';

        if (s === '' || q === '') {
            bootbox.alert("Bạn chưa chọn kích cỡ HOẶC số lượng sản phẩm");
            return false;
        }


        $.ajax({
            url: "<?php echo App()->controller->createUrl('/order/addToCart'); ?>",
            type: 'post',
            data: "pid=<?php echo $product->id; ?>&quantity=" + q + "&size=" + s,
            success: function (items) {
                $("#shopping-item").html("(" + items + ")");
            },
            complete: function () {
                bootbox.alert("Sản phẩm '" + productName + "' của bạn đã được đưa vào giỏ hàng.");
            }
        });
    });

    //set lastest viwwed products    
    
    Cookies.set ('lastViewedProucts', '', { expires: 7 });

    if (Cookies.get('lastViewedProucts') === undefined || Cookies.get('lastViewedProucts') === '') {
        var productID = "<?php echo $product->id ?>";
        var productName = "<?php echo $product->name ?>";
        var productImg = "<?php echo $product->image ?>";
        var last = new Object();
        last = {"items": [{"id": productID, "name": productName, "image": productImg}]};
        Cookies.set('lastViewedProucts', last);
    }
    else {
        var currentProductID = "<?php echo $product->id; ?>";
        var cookie = Cookies.get('lastViewedProucts');
        var existed = 0;
        for (var i = 0; i < count; i++) {
//            console.log("last viewed: " + lastViewed['items'][i]['id'] + " Current: " + currentProductID);
//            console.log(lastViewed['items'][i]['id'] === currentProductID);
            if (lastViewed['items'][i]['id'] === currentProductID) {
                existed = 1;
                break;
            }
        }
    }

    //Add cookie when the product was viewed did not exist
    if (!existed) {
        if (cookie) {
            cookie.items.push({"id": currentProductID, "name": "<?php echo $product->name ?>", "image": "<?php echo $product->image ?>"});

            if (count >= 6) {
                cookie.items.shift();
                $.cookie('lastViewedProucts', cookie);
            }

            $.cookie('lastViewedProucts', cookie);
            console.log($.cookie('lastViewedProucts'));
        }
    }
//    Cookies.remove('lastViewedProucts', {path: '/'});

</script>