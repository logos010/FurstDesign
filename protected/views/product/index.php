<?php
$this->breadcrumbs = array(
    'Products',
);

$this->menu = array(
    array('label' => 'Create Product', 'url' => array('create')),
    array('label' => 'Manage Product', 'url' => array('admin')),
);

//Multiple Select Dropdown -->
scriptFile(themeUrl() . "/js/jquery-ui-1.8.23.custom.min.js", CClientScript::POS_BEGIN);
scriptFile(themeUrl() . "/js/mainnav-smoothScrolling.js", CClientScript::POS_BEGIN);
scriptFile(themeUrl() . "/js/jQuery.equalHeights.js", CClientScript::POS_BEGIN);
?>

<div>
    <?php foreach ($terms as $k => $v): ?>
    <a href="<?php echo App()->controller->createUrl('product/cate/', array('tid' => $v->id)); ?>"><?php echo $v->name; ?></a><br/>
    <?php endforeach; ?>
</div>