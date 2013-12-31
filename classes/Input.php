<?php

/**
 * Description of Input
 *
 * @author Tommy Vercety
 */
class Input {

    public static function exists($type = 'post') {
        switch ($type) {
            case 'post':
                return(!empty($_POST)) ? TRUE : FALSE;
                break;
            case 'get':
                return(!empty($_GET)) ? TRUE : FALSE;
                break;
            default :
                return FALSE;
                break;
        }
    }

    public static function get($item) {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        }
        else if (isset($_GET[$item])) {
            return $_GET[$item];
        }
        return '';
    }

}
