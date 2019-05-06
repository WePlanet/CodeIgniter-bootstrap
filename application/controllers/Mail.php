<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','phpmailer'));
    }

    public function index()
    {
        $name = "Tosin Amuda";
        $email = "tosinamuda@gmail.com";
        $phonenumber = "07031367590";
        $link = 'link';
        $Subject ="Welcome to Upriselive!!!";
        $alt_body ="You are about to experince a breakthrough in your career";
        $message= "You are about to experince a breakthrough in your career";
        $this->mail($email, "Upriselive", $name, $message, $Subject, $alt_body);
    }

  

    private function mail($email, $from_name, $to_name, $message, $Subject, $alt_body)
    {
        $mail = $this->phpmailer->load();

        //$mail = new PHPMailer\PHPMailer\PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = getenv('SMTP_HOST');  					  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = getenv('SMTP_USERNAME');                 // SMTP username
            $mail->Password = getenv('SMTP_PASSWORD');                    // SMTP password
            $mail->SMTPSecure = getenv('SMTP_SECURE_PROTOCOL');     // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

                //Recipients
            $mail->setFrom('hello@fungifting.com', $from_name);
            $mail->addAddress($email, $to_name);     // Add a recipient
            $mail->addReplyTo('hello@fungifting.com', $from_name);

         
            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $Subject;
            $mail->Body = $message;
            $mail->AltBody = $alt_body;
            $mail->send();
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }
}
