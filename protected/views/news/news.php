<section>
    <div class="container">
        <?php foreach ($news as $k => $v):?> 
        <div class="row">
            <div class="row" >
                <div class="col-lg-7 news-title"><a href="<?php echo App()->controller->createUrl('news/detail', array('nid' => $v->id)); ?>"><?php echo $v->title; ?></a></div>
                <div class="col-lg-2 news-info"><?php echo $v->create_time; ?></div>
            </div>
            <div class="col-lg-2"><a href="<?php echo App()->controller->createUrl('news/detail', array('nid' => $v->id)); ?>"><img src="<?php echo BASE_URL . "/" . str_replace('orginal', 'small', $v->thumb); ?>" width="180" alt="<?php echo $v->alias; ?>" title="<?php echo $v->title; ?>"/></a></div>
            <div class="col-lg-7"><?php echo $v->teaser; ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</section>