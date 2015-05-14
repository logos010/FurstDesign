<?php

/**
 * Description of AdminMenu
 *
 * @author HaoLV
 */
Yii::import('application.modules.admin.models.Menu');

class AdminMenu extends CWidget {

    public $items = array();

    public function run() {
        $this->items = App()->cache->get('AdminMenu_' . App()->user->id);
        if ($this->items === false) {
            $items = Menu::model()->findAll('type_id=:type_id && parent_id=0 && status=1', array(':type_id' => 2));
            foreach ($items as $item)
                $this->items[] = $item->getList();

            App()->cache->set('AdminMenu_' . App()->user->id, $this->items, UConfig::get('cache', 'time'));
        }

        $this->widget('bootstrap.widgets.TbNavbar', array(
            'type' => 'inverse', // null or 'inverse'
            'brand' => SITE_NAME,
            'brandUrl' => url('/admin/voc/index'),
            'collapse' => true, // requires bootstrap-responsive.css
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => $this->items
                ),
//        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'htmlOptions' => array('class' => 'pull-right'),
                    'items' => array(
                        array('label' => 'Home', 'url' => BASE_URL, 'linkOptions' => array('target' => '_blank')),
                        array('label' => 'You has login as ' . App()->user->name, 'url' => '#', 'items' => array(
                                array('label' => 'Profile', 'url' => App()->createUrl('user/profile'), 'icon' => 'icon-user'),
                                array('label' => 'Logout', 'url' => App()->createUrl('user/logout'), 'icon' => 'icon-off'),
                            )),
                    ),
                ),
            ),
        ));
    }

}
