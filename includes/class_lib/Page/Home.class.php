<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Page_Home extends Controller_Frontend {
    
    function __construct (){
        parent::__construct();
    }
    
    function process (){
        global $Sys;
        $Sys->Page->setPagename('Cheap Leicester, UK, Home Removal service!');
        $Sys->Page->addLink('home.css');
        $this->append(miniParse($Sys->Page->getTpl('homepage.tpl'), array(
            'homepage-p1' => $Sys->Page->getTpl('homepage-p1.tpl'),
            'homepage-p2' => $Sys->Page->getTpl('homepage-p2.tpl'),
            'homepage-p3' => $Sys->Page->getTpl('homepage-p3.tpl')
        )));
        $this->display();
    }
    
    
}
