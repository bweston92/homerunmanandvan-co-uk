<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Parser {
    
    function ParseAll ($Content, $Extra = array()){
        foreach($Extra as $Needle => $Replace){
            $Content = str_replace("{{$Needle}}", $Replace, $Content);
        }
        $Content = $this->parse_Config($Content);
        $Content = $this->parse_Globals($Content);
        $Content = $this->parse_Page($Content);
        $Content = $this->parse_Define($Content);
        $Content = $this->URLSorter($Content);
        return $Content;
    }
    
    function URLSorter ($Content){
        return str_replace(
            array(
                'href="/',
                'src="/',
                'href=\'/',
                'src=\'/',
                'action=\'/',
                'action="/'
            ),
            array(
                sprintf('href="%s', SITEURL),
                sprintf('src="%s', SITEURL),
                sprintf('href=\'%s', SITEURL),
                sprintf('src=\'%s', SITEURL),
                sprintf('action=\'%s', SITEURL),
                sprintf('action="%s', SITEURL)
            ),
            $Content
        );
    }
    
    function parse_Globals ( $Contents ){
        $Pattern = "#{Globals.[a-zA-Z0-9\.\-\_]*}#";
        if((int) preg_match_all($Pattern, $Contents, $M) > 0){
            foreach($M[0] as $Value){
                $t = str_replace(array('{Globals.', '}'), array('', ''), $Value);
                $Replace = $Value;
                $With = isset($GLOBALS[$t]) ? $GLOBALS[$t] : sprintf('Not set {%s}', $t);
                $Contents = str_replace($Replace, $With, $Contents);
            }
        }
        return $Contents;
    }
    
    function parse_Config ( $Contents ){
        global $Sys;
        $Pattern = "#{Config.[a-zA-Z0-9\.\-\_]*}#";
        if((int) preg_match_all($Pattern, $Contents, $M) > 0){
            foreach($M[0] as $Value){
                $t = str_replace(array('{Config.', '}'), array('', ''), $Value);
                $Replace = $Value;
                $With = $Sys->Config->get($t);
                $Contents = str_replace($Replace, $With, $Contents);
            }
        }
        return $Contents;
    }
    
    function parse_Page ( $Contents ){
        global $Sys;
        $Pattern = "#{Page.[a-zA-Z0-9\.\-\_]*\(\)}#";
        if((int) preg_match_all($Pattern, $Contents, $M) > 0){
            foreach($M[0] as $Value){
                $t = str_replace(array('{Page.', '()}'), array('', ''), $Value);
                $Replace = $Value;
                $With = is_callable(array($Sys->Page, $t)) ? $Sys->Page->$t() : '';
                $Contents = str_replace($Replace, $With, $Contents);
            }
        }
        $Pattern = "#{Page.[a-zA-Z0-9\.\-\_\(\)\[\]\|\_]*}#";
        if((int) preg_match_all($Pattern, $Contents, $M) > 0){
            foreach($M[0] as $Value){
                $t = str_replace(array('{Page.', '}'), array('', ''), $Value);
                $Replace = $Value;
                $With = $Sys->Page->parserCall($t);
                $Contents = str_replace($Replace, $With, $Contents);
            }
        }
        return $Contents;
    }
    
    function parse_Define ( $Contents ){
        global $Sys;
        $Pattern = "#{Define.[a-zA-Z0-9\.\-\_]*}#";
        if((int) preg_match_all($Pattern, $Contents, $M) > 0){
            foreach($M[0] as $Value){
                $t = str_replace(array('{Define.', '}'), array('', ''), $Value);
                $Replace = $Value;
                $With = defined($t) ? constant($t) : '';
                $Contents = str_replace($Replace, $With, $Contents);
            }
        }
        return $Contents;
    }
    
}
