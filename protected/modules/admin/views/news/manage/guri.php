<?php

//$page = isset($_GET['page']) ? 
$criteria = new CDbCriteria();

$criteria->offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$criteria->limit = 500;

$model = News::model()->findAll($criteria);

foreach ($model as $node) {
    $params = array('cate' => $node->term[0]->alias, 'id' => $node->id, 'alias' => $node->alias);
    $uri = url('/site/view', ($node->term[1]->alias != '') ? array_merge($params, array('sub' => $node->term[1]->alias)) : $params);

    echo "UPDATE tbl_news SET uri = '{$uri}' WHERE id = {$node->id};<br/>";
}
?>