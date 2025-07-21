<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Page_Admin_Home extends Controller_Backend {
    
    function __construct (){
        parent::__construct();
    }
    
    function process ($ToDo = NULL){
        
        if($ToDo == NULL){
            $ToDo = isset($_REQUEST['ToDo']) ? $_REQUEST['ToDo'] : 'Default';
        }
        $Func = 'ToDo_' . $ToDo;
        if(is_callable(array($this, $Func))){
            $this->$Func();
        }else{
            $this->append('Something has gone wrong.');
        }
        
        $this->display();
    }
    
    function ToDo_Default (){
        global $Sys;
        $UTotal = $Sys->DB->query(sprintf(
                "SELECT DISTINCT * FROM `%s`",
                MYSQLTABLE::TRACKING
        ));
        $UToday = $Sys->DB->query(sprintf(
                "SELECT DISTINCT * FROM `%s` WHERE `timestamp` > %d",
                MYSQLTABLE::TRACKING,
                strtotime('today')
        ));
        $UYesterday = $Sys->DB->query(sprintf(
                "SELECT DISTINCT * FROM `%s` WHERE `timestamp` > %d AND `timestamp` < %d",
                MYSQLTABLE::TRACKING,
                strtotime('yesterday'),
                strtotime('today')
        ));
        $UMonth = $Sys->DB->query(sprintf(
                "SELECT DISTINCT * FROM `%s` WHERE `timestamp` > %d",
                MYSQLTABLE::TRACKING,
                (NOW - (60*60*24*31))
        ));
        $Returned = $Sys->DB->query(sprintf(
                "SELECT * FROM `%s` WHERE `returned`=1",
                MYSQLTABLE::TRACKING
        ));
        $Data = array(
            'UTOTAL' => $UTotal->num_rows,
            'UTODAY' => $UToday->num_rows,
            'UMONTH' => $UMonth->num_rows,
            'UYDAY' => $UYesterday->num_rows,
            'RETURNING' => $Returned->num_rows
        );
        $this->append(miniParse($Sys->Page->getTpl('homepage/text.tpl'), $Data, 'STATS_'));
    }
    
    
}
