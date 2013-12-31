<?php

/**
 * Description of Token
 *
 * @author Tommy Vercety
 */
class Token {

    public static function generate() {
        return Session::put(Config::get('session/token_name'), md5(uniqid()));
    }

    public static function check($token) {
        $tokenName = Config::get('session/token_name');

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return TRUE;
        }
        return FALSE;
    }

}
