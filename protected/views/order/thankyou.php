<?php
$this->breadcrumbs = array(
    'Đơn hàng - Hoàn tất mua hàng'
);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-10 alert alert-success" role="alert">
            Đơn hàng của bạn đã được lưu, Cám ơn bạn đã mua sắm tại <a href="<?php echo BASE_URL; ?>" alt="<?php echo SITE_NAME; ?>"><?php echo SITE_NAME; ?></a> - Mã đơn hàng: <strong><?php echo $order->purchase_id; ?></strong>
        </div>        
    </div>
    
    <div class="spacer2"></div>
    
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Sản Phẩm</th>
                        <th></th>
                        <th>Giá thành</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Tất cả</th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php foreach ($orderDetail as $k => $v): ?>
                    <tr>
                        <?php $prod = UtiService::loadProductById($v->product_id); ?>
                        <td><?php echo $prod->name ?></td>
                        <td><img src="<?php echo BASE_URL . '/' . $prod->image; ?>" width="80" alt="<?php echo $prod->name ?>" /></td>
                        <td><?php echo number_format($prod->price, 0, '', ',');  ?><sup>đ</sup></td>
                        <td><?php echo $v->quantity ?></td>
                        <td><?php echo $v->line_total; ?></td>
                        <td><?php echo $v->note; ?></td>
                        <td colspan="6"><?php echo $order->grand_total; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>