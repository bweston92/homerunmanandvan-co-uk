<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Html_Gen {
    
    function span ($Text, $Class = ''){
        $Html = new Html_Span($Class);
        $Html->append($Text);
        return $Html;
    }
    
    function div ($Text, $Class = ''){
        $Html = new Html_Div($Class);
        $Html->append($Text);
        return $Html;
    }
    
    function a ($Href, $Text, $Class = ''){
        $Html = new Html_A($Href, $Text, $Class);
        return $Html;
    }
    
    
}