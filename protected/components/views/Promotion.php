<script type="text/javascript">
    $("input.add-to-cart").click(function(){
        item = $(this).attr('id').substring(10,11);
        $.ajax({
            url: "<?php echo App()->controller->createUrl('/product/addToCart'); ?>",
            type: 'post',
            data: "pid="+item+"&quantity=1",
            success: function(items){
                alert('added ' + items);              
                $("a#shopping-item").find("span").html(items + " items(s) in");
            },
        });
    });
</script>

<?php
    echo $promotion;    
?>
