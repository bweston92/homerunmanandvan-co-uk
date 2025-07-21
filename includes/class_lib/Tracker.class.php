<?php
/**
 * @author bradwestonwigston@gmail.com
 */

class Tracker {
    
    static function trackUser (){
        if(self::hasTracker()){
            self::updateTracker();
        }else{
            self::createTracker();
        }
    }
    
    static function hasTracker (){
        return (bool)isset($_COOKIE['tracker'], $_COOKIE['trackertime']);
    }
    
    static function updateTracker (){
        if($_COOKIE['trackertime'] < NOW-(60*10)){
            global $Sys;
            $Sys->DB->query(sprintf(
                "UPDATE `%s` SET `returned`=1 WHERE `ip`='%s' AND `tracker`='%s'",
                MYSQLTABLE::TRACKING,
                $_SERVER['REMOTE_ADDR'],
                $_COOKIE['tracker']
            ));
        }
    }
    
    static function createTracker (){
        $TrackerID = sha1(NOW . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_HOST']);
        global $Sys;
        $Sys->DB->query(sprintf(
            "INSERT INTO `%s` (`tracker`, `ip`, `timestamp`, `returned`) VALUES ('%s', '%s', '%d', 0)",
            MYSQLTABLE::TRACKING,
            $TrackerID,
            $_SERVER['REMOTE_ADDR'],
            NOW
        ));
        setcookie('tracker', $TrackerID, NOW+(60*60*24*7), '/', '.homerunmanandvan.co.uk');
        setcookie('trackertime', NOW, NOW+(60*60*24*7), '/', '.homerunmanandvan.co.uk');
        return (bool)$Sys->DB->insert_id;
    }
    
    static function deleteTracker (){
        setcookie('tracker', false, NOW-(60*60*24*7), '/', '.homerunmanandvan.co.uk');
        setcookie('trackertime', false, NOW-(60*60*24*7), '/', '.homerunmanandvan.co.uk');
    }
    
}