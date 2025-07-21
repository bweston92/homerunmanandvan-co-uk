<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */


class Html_Button extends Html {
    
    function __construct ($Text, $Type = 'button', $Class = NULL, $ID = NULL, $Attr = array()){
        $this->Tag = 'button';
        $this->singleTag = false;
        $this->setType($Type);
        $this->setContent($Text);
        $this->setClass($Class);
        $this->setID($ID);
        parent::__construct($Attr);
    }
    
    
}


