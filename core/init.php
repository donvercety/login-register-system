<?php

/*
 *  INITALIZATION FILE
 */

session_start();

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
        'session_name' => 'user',
        'token_name'    => 'token'
    )
);

/*
 * AUTO INCLUDE ALL CLASSES
 */
spl_autoload_register(function($class) {
            require_once 'classes/' . $class . '.php';
        });

require_once 'functions/sanitize.php';