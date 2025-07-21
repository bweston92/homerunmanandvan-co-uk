<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */


class Html_A extends Html {
    
    
    function __construct ($Href, $Text = NULL, $Class = NULL, $ID = NULL, $Attr = array(), $Tooltip = false){
        $this->Tag = 'a';
        $this->singleTag = false;
        $this->addAttr('href', $Href);
        $this->setContent($Text);
        $this->setClass($Class);
        $this->setID($ID);
        parent::__construct($Attr);
    }
    
    
}


