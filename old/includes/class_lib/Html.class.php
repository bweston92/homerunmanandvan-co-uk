<?php
/**
 * @author Bradley Weston <admin@webod.co.uk>
 * @author Darren Seare <support@webod.co.uk>
 * @package WebOD Framework
 * @version 0.2.6
 * @copyright Copyright 2011 - You are not allowed to edit source code.
 */

class Html {
    
    public $singleTag = false;
    protected $Attr = array();
    protected $Class = NULL;
    protected $ID = NULL;
    protected $Content = NULL;
    public $Tag = NULL;
    protected $AttrString = NULL;
    protected $ExtraClass = NULL;
    
    function __construct ($Attr = array()){
        foreach($Attr as $Name => $Value){$this->addAttr($Name, $Value);}
    }
    
    function isEmpty (){
        if(isset($this->Attr['value']) && !empty($this->Attr['value']))
            return false;
        return (empty($this->Content));
    }
    
    function setID ($Value){
        $this->ID = $Value;
    }
    
    function setClass ($Value){
        $this->Class = $Value;
    }
    
    function addAttr ($Name, $Value){
        $this->Attr[$Name] = $Value;
    }
    
    function setContent ($Content){
        $this->Content = $Content;
    }
    
    function setValue ($Value){
        $this->Attr['value'] = $Value;
    }
    
    function setType ($Value){
        $this->Attr['type'] = $Value;
    }
    
    function append ($Content, $Data = array()){
        if(is_object($Content)){
            $Content = $Content->__toString();
        }
        if(count($Data)){
            if(isset($Data['tag'])){
                switch($Data['tag']){
                    case 'a':
                        if(!isset($Data['href'])){
                            Error('Cannot create link, all arguments are needed.', __LINE__, __FILE__);
                        }
                        $Container = new Html_A($Data['href']);
                    break;
                    case 'strong':
                        $Container = new Html;
                        $Container->Tag = 'strong';
                        $Container->singleTag = false;
                    break;
                    case 'span':
                        $Container = new Html_Span;
                    break;
                    case 'p':
                        $Container = new Html_P;
                    break;
                    case 'form':
                        if(!isset($Data['action'])){
                            Error('Cannot create form, all arguments are needed.', __LINE__, __FILE__);
                        }
                        $Container = new Html_Form($Data['action'], (isset($Data['method']) ? $Data['medoth'] : 'POST'));
                    break;
                    default;
                    case 'div':
                        $Container = new Html_Div;
                    break;
                }
            }else $Container = new Html_Div;
            if(isset($Data['id'])){
                $Container->setID($Data['id']);
            }
            if(isset($Data['class'])){
                $Container->setClass($Data['class']);
            }
            $Container->setContent($Content);
        } 
        if(isset($Container)){
            $Content = $Container;
        }
        $this->Content .= $Content;
    }
    
    function prepend (){
        if(is_object($Content)){
            $this->Content = $Content->__toString() . $Content;
        }else $this->Content = $Content . $Content;
    }
    
    function __toString (){
        return $this->generate() . NULL;
    }
    
    function generate (){
        if($this->Tag == NULL) return $this->Content;
        if($this->singleTag){
            return sprintf(
                "<%s %s/>",
                $this->Tag,
                $this->__generate__attr__string()
            );
        }else{
            return sprintf(
                "<%s %s>%s</%s>",
                $this->Tag,
                $this->__generate__attr__string(),
                $this->Content,
                $this->Tag
            );
        }
    }
    
    function __generate__attr__string (){
        if(!empty($this->ID)) $this->__generate__attr__string__helper('id', $this->ID);
        if(!empty($this->Class) || !empty($this->ExtraClass)){
            $Class = $this->Class . ' ' . $this->ExtraClass;
            $this->__generate__attr__string__helper('class', $Class);
        }
        foreach($this->Attr as $Name => $Value){
            if(strtolower($Name) != 'id' && strtolower($Name) != 'class')
                $this->__generate__attr__string__helper($Name, $Value);
        }
        return $this->AttrString;
    }
    
    function __generate__attr__string__helper ($Name, $Value){
        if(empty($this->AttrString)){
            $this->AttrString .= sprintf('%s="%s"', $Name, $Value);
        }else{
            $this->AttrString .= sprintf(' %s="%s"', $Name, $Value);
        }
    }
    
    function clear (){
        $this->Content = '';
    }
    
}


