<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Page_Prices extends Controller_Frontend {
    
    function __construct (){
        parent::__construct();
    }
    
    function process (){
        global $Sys;
        $Sys->Page->setPagename('Prices');
        // $this->append(Generate::priceStories());
        $this->append($Sys->Page->getTpl('pricing.tpl'));
        $this->display();
    }
}
