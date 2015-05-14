

<h2>THIS IS DEMO PAGE</h2>

<?php
echo '<pre>';
foreach ($data as $node) {
    print_r($node->attributes);
//    echo $node->name . '<br/>';
}
echo '</pre>';
?>

PHÂN TRANG 
<?php
$this->widget('CLinkPager', array(
    'currentPage' => $page->getCurrentPage(),
    'itemCount' => $page->getItemCount(),
    'pageSize' => $page->getPageSize(),
    'header' => '',
    'cssFile' => false,
));
?>