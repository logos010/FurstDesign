<?php

/**
 * Description of UFile
 *
 * @author HEO
 */
class UFile {

    public static function getFileExtension($filename) {
        return strtolower(substr($filename, strpos($filename, '.') + 1));
    }

    public static function getFileName($filename) {
        return strtolower(substr($filename, 0, strpos($filename, '.')));
    }

    public static function getFile($filename) {
        return strtolower(substr($filename, 30));
    }

}
