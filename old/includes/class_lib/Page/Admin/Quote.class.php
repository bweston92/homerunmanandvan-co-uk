<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Page_Admin_Quote extends Controller_Backend {
    
    protected $Fields = array('email_label', 'label', 'order', 'body', 'id');
    
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
                    MYSQLTABLE::QUOTEITEMS,
                    $currentItem,
                    $ID
                ));
                $currentItem++;
            }
            exit;//Ajax Request
        }
        $UlList = new Html_Ul('quote_sort');
        $SQL_get = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` ORDER BY `order` ASC",
            MYSQLTABLE::QUOTEITEMS
        ));
        while($Item = $SQL_get->fetch_assoc()){
            $UlList->append($Item['label'], NULL, 'item_' . $Item['id']);
        }
        $this->append($UlList);
    }
    
    function ToDo_add (){
        global $Sys;
        if(isset($_POST['data'])){
            $SQL_getQuotes = $Sys->DB->query(sprintf(
                "SELECT * FROM `%s` ORDER BY `order` ASC",
                MYSQLTABLE::QUOTEITEMS
            ));
            $Sys->DB->query(sprintf(
                "INSERT INTO `%s` (`email_label`, `label`, `body`, `order`) VALUES ('%s', '%s', '%s', '%d')",
                MYSQLTABLE::QUOTEITEMS,
                $Sys->DB->escape_string($_POST['data']['email_label']),
                $Sys->DB->escape_string($_POST['data']['label']),
                $Sys->DB->escape_string($_POST['data']['body']),
                $SQL_getQuotes->num_rows + 1
            ));
            if($Sys->DB->insert_id > 0){
                $this->ToDo_view();
                return;
            }else $this->append('Something went wrong, please try again.<br/>');
        }
        $this->append($Sys->Page->getTpl('quote/add.tpl'));
    }
    
    function ToDo_view (){
        global $Sys;
        $SQL_getQuotes = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` ORDER BY `order` ASC",
            MYSQLTABLE::QUOTEITEMS
        ));
        if($SQL_getQuotes->num_rows == 0){
            $this->append('There is no quotes, please add one or more from the menu.');
            return;
        }
        $this->append('Alter Order', array(
            'tag' => 'a',
            'href' => '/acp/quote/order/',
            'class' => 'paddthislink ta-right'
        ));
        $Table = new Html_Table(NULL, NULL, 'listtable', 0, 0);
        $Table->addRow();
        $Table->addCell('Email Label', NULL, 'header', array('width' => '20%'));
        $Table->addCell('Description', NULL, 'header', array('width' => '60%'));
        $Table->addCell('', NULL, 'header', array('width' => '20%'));
        while($Quote = $SQL_getQuotes->fetch_assoc()){
            $Table->addRow();
            $Table->addCell($Quote['email_label']);
            $Table->addCell($Quote['body']);
            $Table->addCell(sprintf(
                "%s | %s",
                Html_Gen::a('/acp/quote/edit/?id=' . $Quote['id'], 'Edit'),
                Html_Gen::a('/acp/quote/delete/?id=' . $Quote['id'], 'Delete')
            ), NULL, 'data', array('align' => 'center'));
        }
        $this->append($Table);
    }
    
    function ToDo_edit (){
        global $Sys;
        if(!isset($_REQUEST['id'])){
            $this->append('No ID given to edit.');
            return;
        }
        $ID = $Sys->DB->escape_string($_REQUEST['id']);
        if(isset($_POST['data'])){
            foreach($_POST['data'] as $Field => $Value){
                $Value = $Sys->DB->escape_string($Value);
                if(in_array($Field, $this->Fields)){
                    $Sys->DB->query(sprintf(
                        "UPDATE `%s` SET `%s`='%s' WHERE `id`=%d",
                        MYSQLTABLE::QUOTEITEMS,
                        $Field,
                        $Value,
                        $ID
                    ));
                }
            }
            $this->ToDo_view();
            return;
        }
        $SQL_getQuote = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` WHERE `id` = %d",
            MYSQLTABLE::QUOTEITEMS,
            $ID
        ));
        if($SQL_getQuote->num_rows == 0){
            $this->append('Invalid quote ID.');
            return;
        }
        $this->append(miniParse($Sys->Page->getTpl('quote/edit.tpl'), $SQL_getQuote->fetch_assoc(), 'Q_'));
    }
    
    function ToDo_delete (){
        global $Sys;
        if(!isset($_REQUEST['id'])){
            $this->append('No ID given to delete.');
            return;
        }
        $ID = $Sys->DB->escape_string($_REQUEST['id']);
        if(isset($_POST['cmd']) && $_POST['cmd'] == 'del'){
            $Sys->DB->query(sprintf(
                "DELETE FROM `%s` WHERE `id`=%d",
                MYSQLTABLE::QUOTEITEMS,
                $Sys->DB->escape_string($_REQUEST['id'])
            ));
            $this->ToDo_view();
            return;
        }
        $SQL_getQuote = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` WHERE `id` = %d",
            MYSQLTABLE::QUOTEITEMS,
            $ID
        ));
        if($SQL_getQuote->num_rows == 0){
            $this->append('Invalid quote ID.');
            return;
        }
        $this->append(miniParse($Sys->Page->getTpl('quote/delete.tpl'), $SQL_getQuote->fetch_assoc(), 'Q_'));
    }
    
}
