<?php

$this->widget(
        'ext.yii-feed-widget.YiiFeedWidget', array(
    'url' => $url, 'limit' => isset($_COOKIE['page']) ? $_COOKIE['page'] : 20)
);
?>