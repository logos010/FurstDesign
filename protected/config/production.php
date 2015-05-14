<?php

// Development configurations
return array(
    'components' => array(
        'routes' => array(
			/*
            array(
                'class' => 'CFileLogRoute',
                'levels' => 'error, warning',
            ),*/
            array(
                'class' => 'CEmailLogRoute',
                'levels' => 'error, warning',
                'emails' => array('haolangvn@gmail.com'),
                'sentFrom' => 'haolangvn@gmail.com',
                'subject' => 'Log'
            ),
        ),
    ),
);
