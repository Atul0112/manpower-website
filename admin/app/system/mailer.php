<?php
namespace Ipai\Money;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer extends PHPMailer{
    private $_host = CONFIG[CONFIG['mail_setting']]['host'];
    private $_user = CONFIG[CONFIG['mail_setting']]['username'];
    private $_password = CONFIG[CONFIG['mail_setting']]['password'];
    private $_port = CONFIG[CONFIG['mail_setting']]['port'];
    private $_from = CONFIG[CONFIG['mail_setting']]['from'];
    private $_smtpSecure = CONFIG[CONFIG['mail_setting']]['SMTPSecure'];
    private $_siteName = CONFIG['site_name'];
    private $_toEmailDev = CONFIG[CONFIG['mail_setting']]['to_email_dev'];
    public $mail;
    public $noreplay_mail;
    public $event_mail;

    public function __construct($exceptions=true){
        $this->noreplay_mail = new PHPMailer;
        $this->noreplay_mail->isSMTP();
        $this->noreplay_mail->SMTPDebug = 0;
        $this->noreplay_mail->Host = $this->_host;
        $this->noreplay_mail->Port = $this->_port;
        $this->noreplay_mail->Username = "noreply@hoogmatic.in";
        $this->noreplay_mail->Password = "Reset@2050@";
        $this->noreplay_mail->SMTPAuth = true;
        $this->noreplay_mail->SMTPSecure = $this->_smtpSecure;

        $this->event_mail = new PHPMailer;
        $this->event_mail->isSMTP();
        $this->event_mail->SMTPDebug = 0;
        $this->event_mail->Host = $this->_host;
        $this->event_mail->Port = $this->_port;
        $this->event_mail->Username = "noreply@hoogmatic.in";
        $this->event_mail->Password = "Reset@2050@";
        $this->event_mail->SMTPAuth = true;
        $this->event_mail->SMTPSecure = $this->_smtpSecure;
        
        $this->mail = new PHPMailer;
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->Host = $this->_host;
        $this->mail->Port = $this->_port;
        $this->mail->Username = $this->_user;
        $this->mail->Password = $this->_password;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = $this->_smtpSecure;

        parent::__construct($exceptions);
    }

   
    public function sendEmail($to_email, $to_name, $subject, $email_body, $html_body = "", $from_email = ""){
        $mail_sent = false;
        try{
            if(!empty($from_email)){
                $send_from = $from_email;
            }else{
                $send_from = $this->_from;
            }
            if(!CONFIG['production']){
                $to_email = $this->_toEmailDev;
                $from_email = $this->_from;
            }
            $this->mail->AddReplyTo('noreply@hoogmatic.in', 'No Replay');
            $this->mail->setFrom($send_from, $this->_siteName);
            $this->mail->addAddress($to_email,$to_name);
           
            $this->mail->Subject = $subject;

            if(!empty($html_body)) {
                $this->mail->isHTML(true);
                $this->mail->AltBody = $email_body;
                $this->mail->Body    = $html_body;
            } else{
                $this->mail->Body    = $email_body;
            }
            
            if($this->mail->send()) $mail_sent = true;
        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }

        return $mail_sent;
    }

    public function sendEmailNoReplay($to_email, $to_name, $subject, $email_body, $html_body = "", $from_email = ""){
        $mail_sent = false;
        try{
            if(!empty($from_email)){
                $send_from = $from_email;
            }else{
                $send_from = "noreply@hoogmatic.in";
            }
            if(!CONFIG['production']){
                $to_email = $this->_toEmailDev;
                $from_email = "noreply@hoogmatic.in";
            }
            $this->noreplay_mail->AddReplyTo('noreply@hoogmatic.in', 'No Replay');
            $this->noreplay_mail->setFrom($send_from, $this->_siteName);
            $this->noreplay_mail->addAddress($to_email,$to_name);
           
            $this->noreplay_mail->Subject = $subject;

            if(!empty($html_body)) {
                $this->noreplay_mail->isHTML(true);
                $this->noreplay_mail->AltBody = $email_body;
                $this->noreplay_mail->Body    = $html_body;
            } else{
                $this->noreplay_mail->Body    = $email_body;
            }
            
            if($this->noreplay_mail->send()) $mail_sent = true;
        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->noreplay_mail->ErrorInfo}";
        }
        return $mail_sent;
    }


    public function sendEventMailer($to_email, $to_name, $subject, $email_body, $html_body = "",$replyy_to = "documents@loanlenders.in", $from_email = ""){
        $mail_sent = false;
        try{
            if(!empty($from_email)){
                $send_from = $from_email;
            }else{
                $send_from = "noreply@hoogmatic.in";
            }
            if(!CONFIG['production']){
                $to_email = $this->_toEmailDev;
                $from_email = "noreply@hoogmatic.in";
            }
            $this->event_mail->AddReplyTo($replyy_to, 'Notification');
            $this->event_mail->setFrom($send_from, $this->_siteName);
            $this->event_mail->addAddress($to_email,$to_name);
           
            $this->event_mail->Subject = $subject;

            if(!empty($html_body)) {
                $this->event_mail->isHTML(true);
                $this->event_mail->AltBody = $email_body;
                $this->event_mail->Body    = $html_body;
            } else{
                $this->event_mail->Body    = $email_body;
            }
            
            if($this->event_mail->send()) $mail_sent = true;
        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->event_mail->ErrorInfo}";
        }
        return $mail_sent;
    }
}