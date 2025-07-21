<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Controller_Frontend {
    
    protected $Content;
    protected $Page;
    
    function __construct (){
        global $Sys;
        $Sys->Page = new Page('home');
        $this->Content = new Html;
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
        $this->Content->append($Content);
        
    }
    
    function process (){/*Should be replaced*/}
    
    function display (){
        global $Sys;
        $Layout = $Sys->Page->getTpl('layout.tpl');
        echo $Sys->Parser->ParseAll($Layout, array('PageContent' => $this->Content));
        exit;
    }
    
}
