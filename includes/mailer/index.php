<?php
/**
 * @author bradwestonwigston@gmail.com
 */

include dirname(__FILE__) . '/class.phpmailer.php';
include dirname(__FILE__) . '/class.smtp.php';

$phpmailer_Email = new PHPMailer;
$phpmailer_Email->WordWrap = 70;
$phpmailer_Email->IsSMTP();

//$phpmailer_Email->SMTPDebug = 2;
$phpmailer_Email->Mailer = "smtp";
$phpmailer_Email->Host = "smtp.mail.yahoo.com";
$phpmailer_Email->Port = 587;
$phpmailer_Email->SMTPAuth = true;
$phpmailer_Email->Username = "chatmac481@yahoo.co.uk";
$phpmailer_Email->Password = "rtmkebwokkzbcque";
$phpmailer_Email->SMTPSecure = 'tls';

$phpmailer_Email->From = 'chatmac481@yahoo.co.uk';
$phpmailer_Email->FromName = 'Sean';
$phpmailer_Email->AddAddress('chatmac481@yahoo.co.uk', 'Sean');

function sendContactMail ($Subject, $Body){
    global $phpmailer_Email;
    $phpmailer_Email->IsHTML(true);
    $phpmailer_Email->Subject = $Subject;
    $phpmailer_Email->Body = $Body;
    return (bool) $phpmailer_Email->Send();
}
