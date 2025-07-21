<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Page_Admin_Settings extends Controller_Backend {
    
    function __construct (){
        parent::__construct();
    }
    
    function process ($ToDo = NULL){
        
        if($ToDo == NULL){
            $ToDo = isset($_REQUEST['ToDo']) ? $_REQUEST['ToDo'] : 'Default';
        }
        $Func = 'ToDo_' . $ToDo;
        if(is_callable(array($this, $Func))){
            $this->$Func();
        }else{
            $this->append('Something has gone wrong.');
        }
        
        $this->display();
    }
    
    function ToDo_ContactEmail (){
        global $Sys;
        if(isset($_POST['data'])){
            iniSet('settings.ini', array('contact_email' => $_POST['data']['contact_email']));
            $this->append('Email address updated!');
            return;
        }
        $this->append(miniParse($Sys->Page->getTpl('settings/contactemail.tpl'), array(
            'contact_email' => $Sys->Config->get('contact_email')
        )));
    }
    
    function ToDo_ChangePassword (){
        global $Sys;
        if(isset($_POST['data'])){
            if($_POST['data']['cpass'] == $_POST['data']['newpass']){
                iniSet('settings.ini', array('password' => $Sys->eString($_POST['data']['newpass'])));
                $this->append('Password changed!');
                return;
            }else $this->append('Passwords do not match!');
        }
        $this->append($Sys->Page->getTpl('settings/changepassword.tpl'));
    }
    
    function ToDo_HomePage (){
        global $Sys;
        if(isset($_POST['data']['homepage-p1'], $_POST['data']['homepage-p2'], $_POST['data']['homepage-p3'])){
            $TPLDir = dirname($Sys->Page->StyleDir) . DS . 'home' . DS . 'tpl' . DS;
            foreach($_POST['data'] as $Filename => $Content){
                $FPointer = fopen($TPLDir . $Filename . '.tpl', 'w+');
                fwrite($FPointer, stripslashes($Content));
                fclose($FPointer);
            }
            $this->append('Success!');
            return;
        }
        $this->append(miniParse($Sys->Page->getTpl('homepageeditor/editor.tpl'), array(
            'homepage-p1' => $Sys->Page->getTplFrom('homepage-p1.tpl', 'home'),
            'homepage-p2' => $Sys->Page->getTplFrom('homepage-p2.tpl', 'home'),
            'homepage-p3' => $Sys->Page->getTplFrom('homepage-p3.tpl', 'home')
        )));
        
    }
    
}
