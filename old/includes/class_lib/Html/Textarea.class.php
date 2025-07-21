<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */


class Html_Textarea extends Html {
    
    function __construct ($Name, $Class = NULL, $ID = NULL, $Attr = array()){
        $this->Tag = 'textarea';
        $this->singleTag = false;
        $this->setClass($Class);
        $this->setID($ID);
        $this->addAttr('name', $Name);
        parent::__construct($Attr);
    }
    
    
}


