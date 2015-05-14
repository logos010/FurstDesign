<?php
$model = new Term();
// in view
// in view
$this->widget('ext.tinymce.TinyMce', array(
    'model' => $model,
    'attribute' => 'name',
    // Optional config
    'compressorRoute' => '/admin/tinyMce/compressor',
//    'spellcheckerUrl' => array('/admin/tinyMce/spellchecker'),
//     or use yandex spell: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
//    'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
    'fileManager' => array(
        'class' => 'ext.elFinder.TinyMceElFinder',
        'connectorRoute'=>'/admin/elfinder/connector',
    ),
    'htmlOptions' => array(
        'rows' => 6,
        'cols' => 60,
    ),
));
?>