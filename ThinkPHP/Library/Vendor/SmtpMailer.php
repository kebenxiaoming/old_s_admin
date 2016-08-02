<?php
/**
 * Created by sunny.
 * Tips:Have a nice day!
 * User: sunny
 * Date: 2016/7/29
 * Time: 16:51
 */
class SmtpMailer{
private $mail;
public function send($sendname,$receivename,$email,$title,$content)
{
    if(empty($email)){
        return $data=array(
            "info"=>"邮箱为空！",
            "status"=>0
        );
    }
    if(empty($content)||empty($title)){
        return $data=array(
            "info"=>"存在内容为空！",
            "status"=>0
        );
    }
    require_once('PHPMailer/PHPMailerAutoload.php');
    if(empty($this->mail)) {
        $this->mail = new PHPMailer;
    }
    $this->mail->isSMTP();
    $this->mail->SMTPDebug = 0;
    $this->mail->Host = C('MAIL_SMTP');
    $this->mail->Port = 25;
    $this->mail->SMTPAuth = C('MAIL_HTML');
    $this->mail->Username = C('MAIL_LOGINNAME');
    $this->mail->Password = C('MAIL_PASSWORD');
    $this->mail->setFrom(C('MAIL_LOGINNAME'),$sendname);
    $this->mail->addAddress($email, $receivename);
    $this->mail->Subject = $title;
    $this->mail->CharSet = C('MAIL_CHARSET');
    $this->mail->msgHTML($content);
    //Replace the plain text body with one created manually
    //$mail->AltBody = 'This is a plain-text message body';
    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');
    if (!$this->mail->send())
    {
        return $data=array(
            "info"=>$this->mail->ErrorInfo,
            "status"=>0
        );
        //echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else {
        return $data=array(
            "info"=>"发送成功！",
            "status"=>1
        );
    }
    }
}
