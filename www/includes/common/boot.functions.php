<?php
/**
 * @author bradwestonwigston@gmail.com
 */

function loadClass ($Classname){
    if(class_exists($Classname)) return true;
    $FName = str_replace('_', DS, $Classname);
    $FString = CLASS_DIR . $FName . '.class.php';
    if(file_exists($FString)){
        include $FString;
        return false;
    }else return false;
}
spl_autoload_register('loadClass');

function miniParse ($String, $Array, $Prefix = ''){
    foreach($Array as $Find => $Replace){
        $Find = '#{' . $Prefix . $Find . '}';
        $String = str_replace($Find, $Replace, $String);
   }
    return $String;
}

function iniSet($iniFile, $params){
    global $Sys;
    $FString = COMMON_DIR . $iniFile;
    $FArray = parse_ini_file($FString);
    $FPointer = fopen($FString, 'w+');
    $Sys->Config->load_via_Array($FArray);//Just incase some missing in params array and in config
    foreach($params as $key => $value){
        $Sys->Config->set($key, $value);
    }
    $buildIniFile = '';
    foreach(array_keys($FArray) as $key){
        $buildIniFile .= sprintf("%s = \"%s\";\n", $key, $Sys->Config->get($key));
    }
    fwrite($FPointer, $buildIniFile);
    fclose($FPointer);
}

function a_append ($URLString, $Params){
    foreach($Params as $Name => $Value){
        $URLString = sprintf('%s%s%s=%s', $URLString, strpos($URLString, '?') !== false ? '&' : '?', $Name, $Value);
    }
    return $URLString;
}
