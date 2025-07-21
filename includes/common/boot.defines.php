<?php
/**
 * @author bradwestonwigston@gmail.com
 */

$Config = new AppConfig;
$Config->load_via_Array(parse_ini_file(COMMON_DIR . 'settings.ini'));
$Config->load_via_Array(parse_ini_file(COMMON_DIR . 'layout.ini'));
$Config->set('esalt', '72e58816ec71a1d');
define('FBURL', 'http://www.facebook.com/pages/Homerun-man-and-van/244175708958550');
define('TWITTERURL', '');