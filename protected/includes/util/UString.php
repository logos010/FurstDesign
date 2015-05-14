<?php

/**
 * Description of Ustring
 *
 * @author HAO
 */
class UString {

    public static function toAlias($str) {
        $str = self::toAscii($str);
        $number_list = split(' ', $str);
        $str = '';
        foreach ($number_list as &$number) {
            if ($number != '')
                $str .= '-' . $number;
        }
        return trim(strtolower(substr($str, 1, strlen($str))));
    }

    public static function toAscii($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = ereg_replace("[-.,]", "", $str);
        $str = ereg_replace("[^ A-Za-z0-9]", " ", $str);
        return $str;
    }

    public static function toArray($string) {
        $attributes = array();
        if (strpos($string, ';') !== false) {
            foreach (explode(';', $string) as $key_value) {
                list($key, $value) = explode(':', $key_value);
                $attributes[trim($key)] = trim($value);
            }
        } else {
            list($key, $value) = explode(':', $string);
            $attributes[trim($key)] = trim($value);
        }
        return $attributes;
    }

    public static function subString($string, $number) {
        $arr = explode(' ', $string);
        $str = '';
        for ($i = 0; $i < $number; $i++) {
            $str .= $arr[$i] . ' ';
        }

        return count($arr) > $number ? $str . '...' : $str;
    }

    public static function compress($html) {
        $replace = array(
//            "#<!--.*?-->#s" => "", // strip comments
            "/\s\s+/" => "", // strip excess whitespace
            "/\n/" => "", // strip excess \n
        );
        $search = array_keys($replace);
        $html = preg_replace($search, $replace, $html);
        return str_replace("\r\n", "", $html);
    }

}
