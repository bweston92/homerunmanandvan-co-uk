<?php
/**
 * @author bradwestonwigston@gmail.com
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
define('NOW', time());
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(dirname(__FILE__)) . DS);
define('INCLUDES_DIR', dirname(__FILE__) . DS);
define('CLASS_DIR', INCLUDES_DIR . 'class_lib' . DS);
define('COMMON_DIR', INCLUDES_DIR . 'common' . DS);
include COMMON_DIR . 'boot.functions.php';
include COMMON_DIR . 'boot.defines.php';
include COMMON_DIR . 'boot.mysqltable.php';
define('FORM_ENCTYPE_DEFAULT', 'application/x-www-form-urlencoded');
session_start();
$Sys = new System($Config);
Tracker::trackUser();
include dirname(__FILE__) . '/mailer/index.php';