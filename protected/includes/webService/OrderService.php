<?php

class OrderService {
    
    public static function loadOrderDetail($id){
        $orderDetails = OrderDetail::model()->findAll(array(
            'condition' => 'order_id =:id',
            'params' => array(
                ':id' => $id,
            )
        ));
        
        $ordDetail = null;
        if (!is_null($orderDetails)){
            $ordDetail .= CHtml::openTag('tr');
            $ordDetail .= CHtml::openTag('td', array('colspan' => 6, 'class' => 'hidden OrderDetailGrid orderDetail-' . $id));
            $ordDetail .=  CHtml::openTag('table', array('width' => '100%', 'class' => 'order_detail'));
            $ordDetail .= "<tr><td>Sản Phẩm</td><td></td><td>Giá</td><td>Số lượng</td><td>Thành tiền</td></tr>";
            foreach ($orderDetails as $k => $v){                
                $ordDetail .= CHtml::openTag('tr');
                    $prod = $v->product;
                    $ordDetail .= CHtml::tag('td', array(), $prod->name, true);
                    $ordDetail .= CHtml::tag('td', array(), CHtml::image(BASE_URL . "/" . $prod->image, $prod->alias, array('class' => 'img-responsive')), true);
                    $ordDetail .= CHtml::tag('td', array(), $v->price, true);
                    $ordDetail .= CHtml::tag('td', array(), $v->quantity, true);
                    $ordDetail .= CHtml::tag('td', array(), number_format($v->line_total), true);
                $ordDetail .= CHtml::closeTag('tr');
            }
            $ordDetail .= CHtml::closeTag('table');
            $ordDetail .= CHtml::closeTag('td');
            $ordDetail .= CHtml::closeTag('tr');
        }
        echo $ordDetail;
    }
    
    public static function get_unique_id($length=32, $pool=""){ 
        // set pool of possible char 
        if($pool == ""){ 
          $pool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
          $pool .= "abcdefghijklmnopqrstuvwxyz"; 
          $pool .= "0123456789"; 
        }// end if 
        mt_srand ((double) microtime() * 1000000); 
        $unique_id = ""; 
        for ($index = 0; $index < $length; $index++) { 
          $unique_id .= substr($pool, (mt_rand()%(strlen($pool))), 1); 
        }// end for 
        return($unique_id); 
    }// end get_unique_id 
    
    public static function generate_numbers($start, $count, $digits) {
        $result = array();
        for ($n = $start; $n < $start + $count; $n++) { 
          $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT); 
        }
        return $result;
    }
}
?>
