<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class System {
    
    public $Config, $DB, $Parser, $Page;
    
    function __construct (AppConfig $Config){
        $this->Config = $Config;
        define('SITEURL', $this->Config->get('site_url'));
        $this->DB = new mysqli(
            $this->Config->get('db_host'),
            $this->Config->get('db_user'),
            $this->Config->get('db_pass'),
            $this->Config->get('db_name'),
            $this->Config->get('db_port')
        );
        $this->Parser = new Parser;
    }
    
    function eString ($String){
        return sha1($this->Config->get('esalt') . $String);
    }
    
}