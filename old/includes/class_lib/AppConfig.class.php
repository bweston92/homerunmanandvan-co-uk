<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class AppConfig {
    
    protected $Data;
    
    function __construct (){
        $this->Data = array();
    }
    
    function load_via_Array ($Array){
        foreach($Array as $Name => $Value){
            $this->Data[$Name] = $Value;
        }
    }
    
    function set ($Name, $Value){
        $this->Data[$Name] = $Value;
    }
    
    function get ($Name){
        return isset($this->Data[$Name]) ? $this->Data[$Name] : false;
    }
    
    function show_For_Debug (){
        print_r($this->Data);
    }
    
    
}


