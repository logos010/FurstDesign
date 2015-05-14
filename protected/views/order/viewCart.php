<style>
    #msg{display:  none}
</style>
<?php scriptFile(themeUrl() . "/js/jquery.number.js", CClientScript::POS_BEGIN); ?>

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr id="itemRow-<?php echo $item->id ?>">
                            <td class="cart_product">
                                <a href=""><img src="<?php echo BASE_URL . "/" . $item->image ?>" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href=""><?php echo $item->name ?></a></h4>
                                <p>Web ID: 1089772</p>
                            </td>
                            <td class="cart_price">
                                <p id="price-<?php echo $item->id ?>"><?php echo number_format($item->price, 0, '.', ','); ?></p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="javascript:void(0)" id="add-<?php echo $item->id ?>"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $item->getQuantity(); ?>" id="quantity-<?php echo $item->id ?>" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href="javascript:void(0)" id="sub-<?php echo $item->id ?>"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price" id="total-<?php echo $item->id ?>"><?php echo number_format($item->getSumPrice(), 0, '.', ','); ?></p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="javascript:void(0)" id="remove-<?php echo $item->id ?>"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>                        
                    <?php endforeach; ?>                                    
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td id="total-without-tax"><?php echo number_format($totalPrice, 0, '.', ','); ?> <sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$0</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td id="final-total"><span><?php echo number_format($totalPrice, 0, '.', ','); ?> <sup>đ</sup></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>                    
                </tbody>
            </table>
        </div>
        
        <input name="button" class="btn btn-primary pull-right" id="checkout" value="Check out" type="submit">
        
        
        <div id="msg">
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Gio hang</strong> cua ban dang trong.
            </div>                                                
        </div>
        
</section>

<script type="text/javascript">
    var itemInCart = <?php echo App()->shoppingCart->getCount(); ?>;    
    if (itemInCart === 0){
        $("#msg").show();
        $(".cart_info").hide();
    }    

    //add product
    $("a.cart_quantity_up").on('click', function () {
        var itemID = $(this).attr('id').substring(4, 5);
        var newQuantity = parseInt($("#quantity-" + itemID).val()) + 1;
        if (newQuantity > 20)
            newQuantity--;
        var newTotalPrice = parseFloat($("#price-" + itemID).text()) * newQuantity;

        //set new quanity and total price
        $("#quantity-" + itemID).val(newQuantity);
        $("#total-" + itemID).text($.number(newTotalPrice));
        reCalculateTotalPrice();
    });

    //reduce product
    $("a.cart_quantity_down").on('click', function () {
        var itemID = $(this).attr('id').substring(4, 5);
        var newQuantity = parseInt($("#quantity-" + itemID).val()) - 1;
        if (newQuantity == 0)
            newQuantity++;
        var newTotalPrice = parseFloat($("#price-" + itemID).text()) * newQuantity;
        $("#quantity-" + itemID).val(newQuantity);
        $("#total-" + itemID).text($.number(newTotalPrice));
        reCalculateTotalPrice();
    });

    $(".cart_quantity_input").keyup(function () {
        var itemID = $(this).attr('id').substring(9, 10);
        var newQuantity = parseInt($("#quantity-" + itemID).val());
        if (newQuantity > 20) {
            $("#quantity-" + itemID).val(20);
            newQuantity = 20;
        } else if (newQuantity < 0) {
            $("#quantity-" + itemID).val(1);
            newQuantity = 1;
        }
        var newTotalPrice = parseFloat($("#price-" + itemID).text()) * newQuantity;
        $("#total-" + itemID).text($.number(newTotalPrice));

        reCalculateTotalPrice();
    });

    //remove product
    $("a.cart_quantity_delete").on('click', function () {
        var itemID = $(this).attr('id').substring(7, 8);
        $("table tr#itemRow-" + itemID).remove();
        $.ajax({
            url: "<?php echo App()->controller->createUrl('/order/removeItem'); ?>",
            type: 'POST',
            data: "pid=" + itemID,
            success: function () {
                if ($("p.cart_total_price").length) {
                    reCalculateTotalPrice();
                } else {
                    $('div.cart_info').fadeToggle('slow');
                    $('div#msg').fadeToggle({duration: 2500})
                }

            }
        });
    });
    
    //check out
    $("#checkout").on('click', function(){
        $(location).attr('href', "<?php echo App()->controller->createUrl("/order/checkOut"); ?>"); 
    })

    function reCalculateTotalPrice() {
        var prices = $("p.cart_total_price");
        var total = 0;
        prices.each(function () {
            total += parseFloat($(this).text().replace(',', ''));
        });
//        console.log(total);

        $("#total-without-tax").html($.number(total) + "<sup>đ</sup>");
        $("#final-total span").html($.number(total) + "<sup>đ</sup>");

    }
</script>