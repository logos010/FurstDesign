<?php

/**
 * Description of UService
 *
 * @author HEO
 */
class UService {

    public static function call($target, $param) {
        $tmp = explode('/', $target);
        if (count($tmp) != 3)
            throw new Exception("Invalid target {$target}. Please follow the pattern module.service.function");
        $module = $tmp[0];
        $class = $tmp[1];
        $function = $tmp[2];
        Yii::import("$module.services.$class", true);
        if (!class_exists($class))
            throw new Exception("{$class} service is not found while trying to call service {$target}");
        $service = new $class();
        if (!is_callable(array($service, $function)))
            throw new Exception("{$function} is not found in service {$class}");
        $service->init($module);
        $result = call_user_func(array($service, $function), $param);
        $result->target = $target;
        return $result;
    }

}
