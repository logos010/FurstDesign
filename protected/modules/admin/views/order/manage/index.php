<div class="container">
    <div class="row">
        condition
    </div>
    <br/>
    <div class="row">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'product-grid',
            'dataProvider' => $dataProvider,
            'cssFile' => App()->theme->baseUrl . '/css/yii.css',
            'pager' => array('cssFile' => false),
            'selectableRows' => 2,
            'afterAjaxUpdate' => 'js:function(id,data){$.bind_data()}',
            'columns' => array(
                array(
                    'name' => 'purchase_id',
                    'filter' => false,
                    'htmlOptions' => array('width' => 40)
                ),
                array(
                    'name' => 'customer_id',
                    'header' => 'Customer',
                    'htmlOptions' => array('width' => 80)
                ),
                array(
                    'name' => 'status',
                    'htmlOptions' => array('align' => 'center', 'width' => 30)
                ),
                array(
                    'name' => 'command',
                    'htmlOptions' => array('width' => 120)
                ),
                array(
                    'name' => 'grand_total',
                    'htmlOptions' => array('align' => 'center', 'width' => 120)
                ),                
            )
        ));  
        ?>
<!--        <div class="col-lg-12">
            <table class="table table-striped table-hovertable-responsive">
                <thead>
                    <tr>
                        <td>Order ID</td>
                        <td>Customer Name</td>
                        <td>Status</td>
                        <td>Command</td>
                        <td>Created</td>
                        <td>Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>-->
    </div>
</div>