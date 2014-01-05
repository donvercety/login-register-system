<?php

/*
 *  INITALIZATION FILE
 */
session_start();

/*
 *  GLOBAL CONFIGURATION ARRAY
 */
$GLOBALS['config'] = array(
    'mysql' => array(
        'host'      => 'localhost',
        'username'  => 'test',
        'password'  => 'qwerty',
        'db'        => 'lr'
    ),
    'remember' => array(
        'cookie_name'   => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name'  => 'user',
        'token_name'    => 'token'
    )
);

/*
 * AUTO INCLUDE ALL CLASSES + FUNCTIONS
 */
spl_autoload_register(function($class) {
            require_once 'classes/' . $class . '.php';
        });

require_once 'functions/sanitize.php';

/*
 * AUTO LOGIN USER IF REMEMBER ME WAS CHECKED
 */
if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if ($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}
