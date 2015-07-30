<div class="container-fluid">
    <div class="row">
        <?php
        $this->pageTitle = 'Manage Order';
        $this->breadcrumbs = array(
            'Orders' => array('index'),
            'Order: ' . $order->purchase_id,
        );
        ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'order-detail-grid',
                'dataProvider' => $dataProvider,
                'cssFile' => App()->theme->baseUrl . '/css/yii.css',
                'pager' => array('cssFile' => false),
                'selectableRows' => 2,
                'afterAjaxUpdate' => 'js:function(id,data){$.bind_data()}',
                'columns' => array(
                    array(
                        'name' => 'product_id',
                        'header' => 'Product Name',
                        'value' => '$data->product->name',
                        'htmlOptions' => array(
                            'style' => 'width:200px'
                        )
                    ),
                    array(
                        'header' => 'Image',
                        'type' => 'html',
                        'value' => 'CHtml::image(BASE_URL . "/" . $data->product->image, "", array("style" => "width:50px; height:65px"))'
                    ),
                    array(
                        'name' => 'price',
                        'type' => 'raw',
                        'value' => 'number_format($data->price, 0, "", ",")'
                    ),
                    array(
                        'name' => 'quantity',
                    ),
                    array(
                        'name' => 'note',
                    ),
                    array(
                        'name' => 'line_total',
                        'type' => 'raw',
                        'value' => 'number_format($data->line_total, 0, "", ",")'
                    )
                )
            ));
            ?>
        </div>
    </div>
</div>
