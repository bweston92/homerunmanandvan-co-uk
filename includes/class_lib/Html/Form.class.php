<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */


class Html_Form extends Html {
    
    function __construct ($Action, $Method = 'POST', $Class = NULL, $Name = NULL, $ID = NULL, $Attr = array(), $Enctype = false){
        $this->Tag = 'form';
        $this->singleTag = false;
        $this->addAttr('action', $Action);
        $this->addAttr('method', $Method);
        $this->addAttr('name', $Name);
        if($Enctype === false){
            $this->addAttr('enctype', FORM_ENCTYPE_DEFAULT);
        }else{
            $this->addAttr('enctype', $Enctype);
        }
        $this->setClass($Class);
        $this->setID($ID);
        parent::__construct($Attr);
    }
    
    
}


