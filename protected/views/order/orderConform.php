<?php
scriptFile(themeUrl() . "/js/validator.min.js", CClientScript::POS_BEGIN);
?>

<section id="cart_items">
    <div class="container">
        <div class="register-req">
            <div class="alert alert-info" role="alert"><strong>Bạn vui lòng kiểm tra và xác nhận lại thông tin gia hàng.</strong></div>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <form data-toggle="validator" role="form" method="post">
                    <div class="col-sm-8 clearfix">
                        <div class="bill-to">
                            <p><strong>Thông tin giao hàng</strong></p>
                            <div class="form-customer">
                                <div class="form-group">
                                    <select class="form-control" name="order[gender]">
                                        <option value="mr">Anh.</option>
                                        <option value="ms">Chị.</option>
                                    </select>               
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Full Name *" class="form-control" name="order[fullname]"  data-error="Bạn tên là ....." value="<?php echo $profile->fullname; ?>" required>                                    
                                    <div class="help-block with-errors"></div>
                                </div>  
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Company Name" name="order[company]">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" class="form-control" placeholder="Email*" name="order[email]" value="<?php echo $user->email; ?>" data-error="Email đâu phai vậy !!!" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <input type="tel" placeholder="Mobile Phone *" class="form-control" name="order[phone]" value="<?php echo $profile->phone; ?>" required>
                                    <span class="help-block">Không cần khoản cách, dấu chấm. eg: 0983988032</span>
                                </div>    
                                <div class="form-group">
                                    <select id="district" class="form-control" name="order[district]">
                                        <option>-- Chọn Quận/Huyện --</option>
                                        <?php echo $district; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select id="ward" class="form-control" name="order[ward]">
                                        <option>-- Chọn Phường/Xã --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="order[address]" placeholder="Address 1 *" value="<?php echo $profile->address; ?>" data-error="Bạn đang ở đâu dzạ?" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address 2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="order-message" style="margin-left: 5px">
                            <p><strong>Ghi chú</strong></p>
                            <textarea name="message" name="order[note]"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                            <!--<label><input type="checkbox"> Shipping to bill address</label>-->
                        </div>
                        <div class="spacer1-5"></div>
                        <a class="btn btn-primary" href="javascript:void(0)" id="order-conform-submit">Xác Nhận Thông Tin Giao Hàng</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<script type="text/javascript">
    $("select#district").on('change', function () {
        var did = $(this).val();
        $.ajax({
            url: "<?php echo App()->controller->createUrl('loadWard'); ?>",
            type: "post",
            data: "did=" + did,
            success: function (data) {
                $("#ward").html(data);
            }
        });
    });

    $("a#order-conform-submit").on('click', function () {
        $("form").submit();
    });
</script>