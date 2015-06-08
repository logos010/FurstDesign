<?php
$this->breadcrumbs = array(
    'Hoạt động - Fashion Show'
);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 news-title">
            <?php echo $detail->title; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 new-detail-info"><?php echo $detail->create_time ?></div>
        <div class="col-lg-7 text-right news-detail-social">
            <i class="fa fa-facebook space"></i>
            <i class="fa fa-linkedin space"></i>
            <i class="fa fa-instagram space"></i>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 new-detail-teaser">
            <strong><?php echo $detail->teaser; ?></strong>
        </div>
    </div>
    <div class="spacer2"></div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <img src="<?php echo BASE_URL . "/" . $detail->thumb; ?>" alt="<?php echo $detail->title; ?>" title="<?php echo $detail->title; ?>" />
        </div>
    </div>
    <div class="spacer2"></div>
    <div class="row">
        <div class="col-lg-12 new-detail-content">
            <?php echo $detail->content; ?>
        </div>
    </div>    
</div>