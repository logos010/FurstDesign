<?php

/**
 * Description of Menu
 *
 * @author LangVan
 */
class MenuWidget extends CWidget {

    public function run() {
        $this->widget('bootstrap.widgets.TbNavbar', array(
//            'type' => 'inverse', // null or 'inverse'
            'brand' => 'SKELETON',
            'brandUrl' => BASE_URL,
            'collapse' => true, // requires bootstrap-responsive.css
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Home', 'url' => array('//site/index')),
                        array('label' => 'About', 'url' => array('//site/about')),
                        array('label' => 'Contact', 'url' => array('//contact')),
                        array('label' => 'Login', 'url' => array('//user/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('//user/logout'), 'visible' => !Yii::app()->user->isGuest)
                    )
                ),
        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
//                array(
//                    'class' => 'bootstrap.widgets.TbMenu',
//                    'htmlOptions' => array('class' => 'pull-right'),
//                    'items' => array(
//                        array('label' => 'Front End', 'url' => BASE_URL),
//                        array('label' => 'Account', 'url' => '#', 'items' => array(
//                                array('label' => 'Profile', 'url' => '#'),
//                                array('label' => 'Logout', 'url' => '#'),
//                            )),
//                    ),
//                ),
            ),
        ));
    }

    //put your code here
}

?>