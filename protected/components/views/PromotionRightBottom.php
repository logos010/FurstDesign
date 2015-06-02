<?php if (count($promotion) == 1): ?>
    <a href="<?php echo App()->controller->createUrl($promotion->url); ?>">
        <img src="<?php echo BASE_URL . "/" . $promotion->image; ?>" alt="<?php echo $promotion->name; ?>" style="border: 0px" border="0">
    </a>
<?php
    else: 
        foreach ($promotion as $k => $v): 
?>
    <div style="width:960px;float:left;margin-bottom:8px;" id="shipping-promo">
        <a href="<?php echo App()->controller->createUrl($v->url); ?>" >
            <img style="border: 0px" src="<?php echo BASE_URL . "/" . $v->image ?>" alt="<?php $v->name ?>">
        </a>
    </div>
<?php endforeach; endif; ?>

