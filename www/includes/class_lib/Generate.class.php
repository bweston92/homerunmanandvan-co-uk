<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Generate {
    
    function priceStories (){
        global $Sys;
        $Sys->Page->addLink('pricestories.css');
        $SQL_getStories = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` ORDER BY `order` ASC",
            MYSQLTABLE::PRICESTORIES
        ));
        if($SQL_getStories->num_rows == 0){
            return "There are no stories available at this moment.";
        }
        $StoriesContainer = new Html_Ul;
        $StoriesContainer->setClass('pricestories ' . (
            ($Sys->Config->get('layout_pricestories_two_col') == 'true') ? 'ps_twocol' : 'ps_onecol'));
        while($Story = $SQL_getStories->fetch_assoc()){
            $StoriesContainer->append($Story['body']);
        }
        return $StoriesContainer;
    }
    
    static function quoteGuideline (){
        global $Sys;
        $SQL_getQuoteitems = $Sys->DB->query(sprintf(
            "SELECT * FROM `%s` ORDER BY `order` ASC",
            MYSQLTABLE::QUOTEITEMS
        ));
        if($SQL_getQuoteitems->num_rows == 0) return;
        $Content = array();
        while($Item = $SQL_getQuoteitems->fetch_assoc()){
            $Content[] = sprintf('
            <div class="row quote-option">
                <div class="col-md-11">
                    <header>%s</header>
                    <p>%s</p>
                </div>
                <div class="col-md-1">
                    <input type="number" value="0" class="form-control" name="items[%d]">
                </div>
            </div>', $Item['label'], $Item['body'], $Item['id']);
        }
        return implode("\n\n", $Content);
    }
}
