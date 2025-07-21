<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Page_Admin_Pricing extends Controller_Backend {
    
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
        $this->append($Sys->Page->getTpl('homepage/text.tpl'));
    }
    
    function ToDo_order (){
        global $Sys;
        if(isset($_REQUEST['cmd']) && $_REQUEST['cmd'] == 'Order'){
            $currentItem = 0;
            foreach($_POST['item'] as $ID){
                $Sys->DB->query(sprintf(
                    "UPDATE `%s` SET `order`=%d WHERE `id`=%d",
                    MYSQLTABLE::PRICESTORIES,
                    $currentItem,
                    $ID
                ));
                $currentItem++;
            }
            exit;//Ajax Request
        }
        $UlList = new Html_Ul('pricing_sort');
        $SQL_get = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` ORDER BY `order` ASC",
            MYSQLTABLE::PRICESTORIES
        ));
        while($Item = $SQL_get->fetch_assoc()){
            $UlList->append($Item['body'], NULL, 'item_' . $Item['id']);
        }
        $this->append($UlList);
    }
    
    function ToDo_view (){
        global $Sys;
        $SQL_getPricing = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` ORDER BY `order` ASC",
            MYSQLTABLE::PRICESTORIES
        ));
        if($SQL_getPricing->num_rows == 0){
            $this->append('There are no example pricing posts, add one using the menu in the side.');
            return;
        }
        $this->append('Alter Order', array(
            'tag' => 'a',
            'href' => '/acp/pricing/order/',
            'class' => 'paddthislink ta-right'
        ));
        $Table = new Html_Table(NULL, NULL, 'listtable', 0, 0);
        $Table->addRow();
        $Table->addCell('Example Pricing Posts', NULL, 'header', array('width' => '80%'));
        $Table->addCell('', NULL, 'header', array('width' => '20%'));
        while($Pricing = $SQL_getPricing->fetch_assoc()){
            $Table->addRow();
            $Table->addCell($Pricing['body']);
            $Table->addCell(sprintf(
                "%s | %s",
                Html_Gen::a('/acp/pricing/edit/?id=' . $Pricing['id'], 'Edit'),
                Html_Gen::a('/acp/pricing/delete/?id=' . $Pricing['id'], 'Delete')
            ), NULL, 'data', array('align' => 'center'));
        }
        $this->append($Table);
    }
    
    function ToDo_add (){
        global $Sys;
        if(isset($_POST['data'])){
            $SQL_getPricing = $Sys->DB->query(sprintf(
                "SELECT * FROM `%s` ORDER BY `order` ASC",
                MYSQLTABLE::PRICESTORIES
            ));
            $Sys->DB->query(sprintf(
                "INSERT INTO `%s` (`body`, `order`) VALUES ('%s', '%d')",
                MYSQLTABLE::PRICESTORIES,
                htmlentities($Sys->DB->escape_string($_POST['data']['body']), NULL, 'UTF-8'),
                $SQL_getPricing->num_rows
            ));
            $this->ToDo_view();
            return;
        }
        $this->append($Sys->Page->getTpl('pricing/add.tpl'));
    }
    
    function ToDo_edit (){
        global $Sys;
        if(!isset($_REQUEST['id'])){
            $this->append('There is no telling what you want to edit there was no ID supplied.');
            return;
        }
        $ID = $Sys->DB->escape_string($_REQUEST['id']);
        if(isset($_POST['data'])){
            $Sys->DB->query(sprintf(
                "UPDATE `%s` SET `body`='%s' WHERE `id`=%d",
                MYSQLTABLE::PRICESTORIES,
                htmlentities($Sys->DB->escape_string($_POST['data']['body']), NULL, 'UTF-8'),
                $ID
            ));
            if($Sys->DB->affected_rows > 0){
                $this->ToDo_view();
                return;
            }else $this->append('Something went wrong, please try again.');
        }
        $SQL_getPricing = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` WHERE `id`=%d",
            MYSQLTABLE::PRICESTORIES,
            $ID
        ));
        if($SQL_getPricing->num_rows == 0){
            $this->append('Example Pricing post doesn\'t exist.');
            return;
        }
        $this->append(miniParse($Sys->Page->getTpl('pricing/edit.tpl'), $SQL_getPricing->fetch_assoc(), 'P_'));
    }
    
    function ToDo_delete (){
        global $Sys;
        if(!isset($_REQUEST['id'])){
            $this->append('There is no telling what you want to edit there was no ID supplied.');
            return;
        }
        $ID = $Sys->DB->escape_string($_REQUEST['id']);
        if(isset($_POST['cmd']) && $_POST['cmd'] == 'del'){
            $Sys->DB->query(sprintf(
                "DELETE FROM `%s` WHERE `id`=%d",
                MYSQLTABLE::PRICESTORIES,
                $ID
            ));
            if($Sys->DB->affected_rows > 0){
                $this->ToDo_view();
                return;
            }else $this->append('Something went wrong, please try again.');
        }
        $SQL_getPricing = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` WHERE `id`=%d",
            MYSQLTABLE::PRICESTORIES,
            $ID
        ));
        if($SQL_getPricing->num_rows == 0){
            $this->append('Example Pricing post doesn\'t exist.');
            return;
        }
        $this->append(miniParse($Sys->Page->getTpl('pricing/delete.tpl'), $SQL_getPricing->fetch_assoc(), 'P_'));
    }
    
    
}
