<?php
/**
 * @author bradwestonwigston@gmail.com
 */

define('ACP_LOGIN_PAGE', 1);
include '../../includes/init.php';

if(isset($_POST['data']['username'], $_POST['data']['password'])){
	list($Username, $Password) = array(
		$Sys->DB->escape_string($_POST['data']['username']),
		$Sys->eString($Sys->DB->escape_string($_POST['data']['password']))
	);
	if(
		($Username == $Sys->Config->get('username'))
		&&
		($Password == $Sys->Config->get('password'))
	){
		$_SESSION['loggedin'] = true;
		header('Location: ' . $Sys->Config->get('site_url') . 'acp/');
	}else{
		$ErrorMsg = '<div class="errormsg">Invalid Username/Password</div>';
	}
}

$Page = new Page('admin');
$LoginTemplate = $Page->getTpl('login.tpl');
$Sys->Page = &$Page;
echo $Sys->Parser->ParseAll(miniParse($LoginTemplate, array('error' => isset($ErrorMsg) ? $ErrorMsg : '')));