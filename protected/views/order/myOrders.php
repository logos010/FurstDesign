<?php if (count($myOrders) != 0 ): ?>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày mua hàng</th>
                    <th>Tổng (VND)</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>                
                <?php $i=1; foreach($myOrders as $k => $v): ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $v->purchase_id; ?></td>
                        <td><?php echo $v->create_time; ?></td>
                        <td><?php echo number_format($v->grand_total, 0, '', ','); ?></td>
                        <td><?php echo $v->is_paid; ?></td>
                        <td>
                            <!--<a href="javascript:void(0)" class="viewOrderDetail" id="order-<?php echo $v->order_id ?>">View Detail</a>-->
                            <span class="viewOrderDetail glyphicon glyphicon-plus" aria-hidden="true" id="order-<?php echo $v->order_id ?>" ></span>    
                        </td>
                    </tr>
                    <?php OrderService::loadOrderDetail($v->order_id); ?>                    
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>

<div>
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Thông tin</strong> mua hàng của bạn đang trống.
    </div>                                                
</div>

<?php endif; ?>

<style>
#msg{display:  none}
table.order_detail {margin: 15px}
table.order_detail tr td {padding:10px; width: 150px}
.glyphicon-plus, .glyphicon-minus {font-size: 0.8em; cursor: pointer;}

</style>

<script type="text/javascript">
    $(".viewOrderDetail").click(function(){
        var orderID = $(this).attr("id").substring(6,7);
        var detailBlock = $(".orderDetail-"+orderID);
        
        if (detailBlock.is(":visible")){
            detailBlock.addClass('hidden');
            
            $('span.viewOrderDetail').removeClass('glyphicon-minus');            
            
            $("#order-"+orderID).removeClass('glyphicon-minus');
            $("#order-"+orderID).addClass('glyphicon-plus');
        }else{
            $('.OrderDetailGrid').addClass('hidden');
            
            $('span.viewOrderDetail').addClass('glyphicon-plus');
            $('span.viewOrderDetail').removeClass('glyphicon-minus');
            
            $("#order-"+orderID).removeClass('glyphicon-plus');            
            $("#order-"+orderID).addClass('glyphicon-minus');
            
            detailBlock.removeClass('hidden');            
        }
    });
    
    
</script>
