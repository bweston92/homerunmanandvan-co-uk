<?php
/**
 * @author bradwestonwigston@gmail.com
 */

if(!defined('ACP_LOGIN_PAGE')){
	$this->addLink('jquery.ui.css', 'text/css', 'stylesheet', Page::LINKTYPE_GLOBAL);
	$this->addLink('style.css');
}
	$this->addJS('jquery.js', 'text/javascript', Page::LINKTYPE_GLOBAL);
	$this->addJS('jquery.ui.js', 'text/javascript', Page::LINKTYPE_GLOBAL);
	$this->addJS('jquery.plugins.js', 'text/javascript', Page::LINKTYPE_GLOBAL);
	$this->Formalize();
if(!defined('ACP_LOGIN_PAGE')){
	$this->addJS('common.js');
}