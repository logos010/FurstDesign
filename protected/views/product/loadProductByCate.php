<?php
$this->breadcrumbs = array(
    'Products',
);

$this->menu = array(
    array('label' => 'Create Product', 'url' => array('create')),
    array('label' => 'Manage Product', 'url' => array('admin')),
);
?>

<section><!--product category-->
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?php $this->widget('application.components.ProductLeftHandSide'); ?>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    <!--Products grid -->
                    <?php
                        echo $grid;
                    ?>                    
                    <!--End of product grid-->
                </div>
            </div>
        </div>
    </div>
</section>