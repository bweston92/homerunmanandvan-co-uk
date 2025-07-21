<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */


class Html_Div extends Html {
    
    
    function __construct ($Class = NULL, $ID = NULL, $Attr = array()){
        $this->Tag = 'div';
        $this->singleTag = false;
        $this->setClass($Class);
        $this->setID($ID);
        parent::__construct($Attr);
    }
    
    
}


