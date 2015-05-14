<?php

/**
 * Description of UDate
 *
 * @author HEO
 */
class UDate {

    public static function getMonths() {
        $months = array();
        for ($i = 1; $i <= 12; $i++)
            $months[$i] = strftime('%B', mktime(0, 0, 0, $i, 1));
        return $months;
    }

    public static function getDays() {
        $days = array();
        for ($i = 1; $i <= 31; $i++)
            $days[$i] = strftime('%d', mktime(0, 0, 0, $month, $i));
        return $days;
    }

    public static function getYears($limit = 100) {
        $years = array();
        $current = date('Y');
        $stop = $current - $limit;
        for ($i = $current; $i >= $stop; $i--)
            $years[$i] = $i;
        return $years;
    }

    public static function getString() {
        $day = explode(" ", gmdate("w d n Y", time()));
        $dayname = ($day[0]);
        $dayno = ($day[1]);

        switch ($dayname) {
            case 0: $dayname = "Chủ nhật, ";
                break;
            case 1: $dayname = "Thứ hai, ";
                break;
            case 2: $dayname = "Thứ ba, ";
                break;
            case 3: $dayname = "Thứ t&#432;, ";
                break;
            case 4: $dayname = "Thứ n&#259;m, ";
                break;
            case 5: $dayname = "Thứ s&aacute;u, ";
                break;
            case 6: $dayname = "Thứ b&#7843;y, ";
                break;
            default : $dayname = "Hôm nay, ";
                break;
        }
        $str_search = array("am", "pm");
        $str_replace = array(" sáng", " chiều");
        $timenow = gmdate("g:i a.", time() + 7 * 3600);
        $timenow = str_replace($str_search, $str_replace, $timenow);

        $stringdate = $dayname . $dayno . " tháng " . $day[2] . " năm " . $day[3];

        return $stringdate;
    }

    public function getCurrentDate($type = 'simple') {
        if ($type == 'simple')
            return date('Y-m-d');
        elseif ($type == 'full')
                return date('Y-m-d H:i:s');
        else
            return date($type);         
    }

}
