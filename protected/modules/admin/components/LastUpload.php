<?php

/**
 * Description of History
 *
 * @author HAO
 */
class LastUpload {

    public static function getFile() {
        return PATH_UPLOAD . DIRECTORY_SEPARATOR . 'last_upload.php';
    }

    public static function save($key) {
        $history = self::get();
        if (!in_array($key, $history)) {
            $history[] = $key;
        }

        $handle = fopen(LastUpload::getFile(), "wb");
        fwrite($handle, "<?php \n return array(\n\t'" . implode("',\n\t'", $history) . "'\n);\n?>");
        fclose($handle);
    }

    public static function get() {
        if (!is_file(self::getFile())) {
            $handle = fopen(self::getFile(), "wb");
            fwrite($handle, "<?php\n return array();\n?>");
            fclose($handle);
        }

        $history = include(self::getFile());

        if (!is_array($history)) {
            $history = array();
        }
        return array_slice($history, -30, 30);
    }

    public static function out() {
        $arr = self::get();
        krsort($arr);
        foreach ($arr as $value) {
            $str .= CHtml::image(App()->homeUrl . $value, '', array());
        }
        return $str;
    }

}
