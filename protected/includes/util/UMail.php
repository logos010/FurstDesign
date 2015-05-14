<?php

/**
 * Description of UMail
 *
 * @author HAO
 */
class UMail {

    public static function send($from=array(), $to=array(), $subject='', $content='') {
        // Prepare to send Email to Manager
        Yii::import('ext.mail.YiiMailMessage');
        $mail = new YiiMailMessage;

        $mail->setSubject($subject);
        $mail->setBody($content, 'text/html', 'utf-8');
        $mail->setFrom($from);
        $mail->setReplyTo($from);
        $mail->setTo($to);

        // Bat dau send
        return Yii::app()->mail->send($mail);
    }

}

?>
