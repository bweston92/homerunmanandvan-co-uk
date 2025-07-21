<?php
/**
 * @author bradwestonwigston@gmail.com
 */

include '../../includes/init.php';

session_destroy();
header('Location: ' . $Sys->Config->get('site_url'));
