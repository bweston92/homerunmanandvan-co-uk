<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */


class Html_Input extends Html {
    
    function __construct ($Name, $Type = 'text', $Class = NULL, $ID = NULL, $Attr = array()){
        $this->Tag = 'input';
        $this->singleTag = true;
        $this->setType($Type);
        $this->addAttr('name', $Name);
        $this->setClass($Class);
        $this->setID($ID);
        parent::__construct($Attr);
    }
    
    
    
    
    
}


