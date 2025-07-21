<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */


class Html_Ul extends Html {
    
    
    function __construct ($Class = NULL, $ID = NULL, $Attr = array()){
        $this->Tag = 'ul';
        $this->singleTag = false;
        $this->setClass($Class);
        $this->setID($ID);
        $this->Content = array();
        parent::__construct($Attr);
    }
    
    function append ($Content, $Class = NULL, $ID = NULL, $Attr = array()){
        $this->Content[] = new Html_Li($Content, $Class, $ID, $Attr);
    }
    
    function generate (){
        $Content = "\n";
        foreach($this->Content as $Li)
            $Content .= "\t" . $Li . "\n";
        return sprintf(
                "<%s %s>%s</%s>",
                $this->Tag,
                $this->__generate__attr__string(),
                $Content,
                $this->Tag
            );
    }
    
}


