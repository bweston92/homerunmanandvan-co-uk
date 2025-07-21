<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Page {
    
    protected $PageRenderData = array();
    protected $Pagename = NULL;
    public $StyleDir = NULL;
    protected $GlobalStyleDir = NULL;
    protected $StyleUrl = NULL;
    protected $GlobalStyleUrl = NULL;
    protected $TitlePrefix = NULL;
    
    const LINKTYPE_SYLE = 1;
    const LINKTYPE_GLOBAL = 2;
    const LINKTYPE_ABSOLUTE = 3;
    
    function __construct ($Stylename){
        global $Sys;
        $this->PageRenderData['js'] = array();
        $this->PageRenderData['link'] = array();
        $this->PageRenderData['meta'] = array();
        $this->StyleDir = ROOT_DIR . 'shared' . DS . $Stylename . DS;
        $this->GlobalStyleDir = ROOT_DIR . 'shared' . DS . 'global' . DS;
        $this->StyleUrl = $Sys->Config->get('site_url') . sprintf('shared/%s/', $Stylename);
        $this->GlobalStyleUrl = $Sys->Config->get('site_url') . 'shared/global/';
        $this->setTitlePrefix($Sys->Config->get('page_title'));
        $FString = $this->StyleDir . 'settings.php';
        if(file_exists($FString))
            include $FString;
    }
    
    function setPagename ($newPagename){
        $this->Pagename = $newPagename;
        return;
    }
    
    function setTitlePrefix ($newTitlePrefix){
        $this->TitlePrefix = $newTitlePrefix;
        return;
    }
    
    function getTpl ($Filename){
        $FString = $this->StyleDir . 'tpl' . DS . $Filename;
        if(file_exists($FString)){
            return file_get_contents($FString);
        }else return false;
    }
    
    function getTplFrom ($Filename, $Stylename){
        $FString = dirname($this->StyleDir) . DS . $Stylename . DS . 'tpl' . DS . $Filename;
        if(file_exists($FString)){
            return file_get_contents($FString);
        }else return false;
    }
    
    function createUrl ($Filename, $DefaultFolder = '', $Flag = 3){
        if(empty($DefaultFolder) && $Flag != self::LINKTYPE_ABSOLUTE && substr($Filename, 0, 1) != '/')
            $DefaultFolder = '/';
        switch($Flag){
            case self::LINKTYPE_ABSOLUTE:
                return $Filename;
            break;
            case self::LINKTYPE_GLOBAL:
                return $this->GlobalStyleUrl . $DefaultFolder . $Filename;
            break;
            case self::LINKTYPE_SYLE:
                return $this->StyleUrl . $DefaultFolder . $Filename;
            break;
        }
    }
    
    function addJS ($Filename, $Type = 'text/javascript', $Flag = 1){
        $this->PageRenderData['js'][] = array(
            'src' => self::createUrl($Filename, 'javascript/', $Flag),
            'type' => $Type
        );
    }
    
    function addLink ($Filename, $Type = 'text/css', $Rel = 'stylesheet', $Flag = 1, $Folder = 'css/'){
        $this->PageRenderData['link'][] = array(
            'href' => self::createUrl($Filename, $Folder, $Flag),
            'type' => $Type,
            'rel' => $Rel
        );
    }
    
    function addMeta ($Name, $Content, $useHttpEquiv = false){
        $this->PageRenderData['meta'][] = array(
            'name' => $Name,
            'content' => $Content,
            'useHttpEquiv' => $useHttpEquiv
        );
    }
    
    function genJS (){
        $Content = new Html;
        foreach($this->PageRenderData['js'] as $Data){
            $String = sprintf(
                '<script language="javascript" type="%s" src="%s"></script>', $Data['type'], $Data['src']);
            $Content->append("\t" . $String . "\n");
        }
        return $Content;
    }
    
    function genLink (){
        $Content = new Html;
        foreach($this->PageRenderData['link'] as $Data){
            $String = sprintf(
                '<link href="%s" type="%s" rel="%s" />', $Data['href'], $Data['type'], $Data['rel']);
            $Content->append("\t" . $String . "\n");
        }
        return $Content;
    }
    
    function genMeta (){
        $Content = new Html;
        foreach($this->PageRenderData['meta'] as $Data){
            if($Data['useHttpEquiv']){
                $String = sprintf('<meta http-equiv="%s" content="%s" />', $Data['name'], $Data['content']);
            }else{
                $String = sprintf('<meta name="%s" content="%s" />', $Data['name'], $Data['content']);
            }
            $Content->append("\t" . $String . "\n");
        }
        return $Content;
    }
    
    function genHead (){
        $Content = new Html;
        $Content->append($this->genMeta());
        $Content->append(sprintf("\n\t<title>%s :: %s</title>\n", $this->Pagename, $this->TitlePrefix));
        $Content->append($this->genLink());
        $Content->append($this->genJS());
        return $Content;
    }
    
    function parserCall ($String){
        global $Sys;
        switch($String){
            case 'getStyleUrl':
                return $this->StyleUrl;
            break;
            case 'getSiteUrl':
                return $Sys->Config->get('site_url');
            break;
        }
    }
    
    function Formalize (){
        $this->addJS('jquery.formalize.js', 'text/javascript', Page::LINKTYPE_GLOBAL);
        $this->addLink('formalize.css', 'text/css', 'stylesheet', Page::LINKTYPE_GLOBAL);
    }
    
}

