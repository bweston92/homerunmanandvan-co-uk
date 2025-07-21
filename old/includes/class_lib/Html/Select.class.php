<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */


class Html_Select extends Html {
    
   protected $Options;
    
    function __construct ($Name, $Class = NULL, $ID = NULL, $Attr = array()){
        $this->Tag = 'select';
        $this->addAttr('name', $Name);
        $this->setClass($Class);
        $this->setID($ID);
        $this->Options = array();
        parent::__construct($Attr);
    }
    
    function addOption ($Label, $Value, $Selected = false){
        $this->Options[] = array(
            'label' => $Label,
            'value' => $Value,
            'selected' => $Selected
        );
    }
    
    function generate (){
        $AttrString = $this->__generate__attr__string();
        $OptionsString = '';
        foreach($this->Options as $OptionData){
            $OptionsString .= sprintf(
                "<option value=\"%s\" %s>%s</option>",
                $OptionData['value'],
                (($OptionData['selected']) ? 'selected="selected"' : ''),
                $OptionData['label']
            );
        }
        return sprintf(
            "<select %s>%s</select>",
            $AttrString,
            $OptionsString
        );
    }
    
}


