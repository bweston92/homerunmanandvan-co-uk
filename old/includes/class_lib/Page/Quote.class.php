<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Page_Quote extends Controller_Frontend {
    
    function __construct (){
        parent::__construct();
    }
    
    protected $Labels = array(
        'name' => 'Name:',
        'tel' => 'Telephone:',
        'emailaddr' => 'Email:',
        'extradrivers' => 'Extra Men:',
        'pickuppcode' => 'Pickup Postcode:',
        'pickupfloor' => 'Pickup Floor:',
        'dropoffpcode' => 'Drop Off Postcode:',
        'dropofffloor' => 'Drop Off Floor:',
        'extrainfo' => 'Extra Information:',
        'passengers' => 'Passengers:'
    );
    
    function process (){
        global $Sys;
        $Sys->Page->setPagename('Get a quote today!');
        if(isset($_POST['data'], $_POST['items'])){
            
            $Table = new Html_Table(NULL, NULL, NULL, 0, 2, 3, array(
                'width' => '100%'
            ));
            foreach($_REQUEST['data'] as $ID => $Value){
                $Table->addRow();
                $Table->addCell($this->Labels[$ID], NULL, 'header', array(
                    'width' => '50%', 'align' => 'right'
                ));
                $Table->addCell($Value, NULL, 'data', array(
                    'width' => '50%'
                ));
            }
            foreach($_REQUEST['items'] as $ID => $Ammount){
                $ID = (int) $ID;
                $Ammount = (int) $Ammount;
                $Table->addRow();
                $SQL_getEmailLabel = $Sys->DB->query(sprintf(
                    "SELECT `email_label` FROM `%s` WHERE `id`=%d",
                    MYSQLTABLE::QUOTEITEMS,
                    $ID
                ));
                $SQL_getEmailLabel = $SQL_getEmailLabel->fetch_assoc();
                $ItemLabel = $SQL_getEmailLabel['email_label'];
                $Table->addCell($ItemLabel . ':', NULL, 'header', array(
                    'width' => '50%', 'align' => 'right'
                ));
                $Table->addCell($Ammount, NULL, 'data', array(
                    'width' => '50%'
                ));
            }
            
            $body = "<html><body><h1>New Enquiry</h1>" . $Table->generate() . "</body>";
            if(sendContactMail('Website Enquiry', $body)){
                $this->append('Your enquiry will be looked at and you will be contacted asap!');
            }else{
                $this->append('Hey, something went wrong. Please try again.');
            }
        }else{
            $Form = new Html_Form('/getaquote.php', 'POST', NULL, NULL, NULL, array(
                'autocomplete' => 'off'
            ));
            $Sys->Page->addLink('getaquote.css');
            $Form->append($Sys->Page->getTpl('quoteform_top.tpl'));
            $Form->append(Generate::quoteGuideline());
            $Form->append($Sys->Page->getTpl('quoteform_bottom.tpl'));
            $this->append($Form);
        }
        $this->display();
    }
    
    
}
