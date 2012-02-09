#!/usr/bin/php -q
<?php
Class newMail {


    private $email = '';
    
    
    function __construct() {
        $sock = fopen("php://stdin", 'r'); //Listen to incoming e-mails
        
        //Read e-mail into buffer
        while (!feof($sock))
        {
            $this->email .= fread($sock, 1024);
        }
        fclose($sock);
    }

    
    //Parse "subject"
    public function debug() {
        file_put_contents('tempmail.txt', $this->email);
    }

    
    //Parse "subject"
    public function subject() {
        $subject1 = explode ("\nSubject: ", $this->email);
        $subject2 = explode ("\n", $subject1[1]);
        
        return $subject2[0];
    }
    
    
    //Parse "from"
    public function from() {
        $from1 = explode ("\nFrom: ", $this->email);
        $from2 = explode ("\n", $from1[1]);
        
        if (strpos($from2[0], '<') !== false) {
            $from3 = explode('<', $from2[0]);
            $from4 = explode('>', $from3[1]);
            $from = $from4[0];
        } else {
            $from = $from2[0];
        }
        
        return from;
    }
    
    
    //Parse "to"
    public function to() {
        $to1 = explode ("\nTo: ", $this->email);
        $to2 = explode ("\n", $to1[1]);
        $to = str_replace ('>', '', str_replace('<', '', $to2[0]));
        
        return $to;
    }
    
    
    //Parse "body"
    public function body() {
        $message1 = explode("\n\n", $this->email);
        $start = count($message1) - 3;
        
        if ($start < 1) {
            $start = 1;
        }
        
        $message2 = explode("\n\n", $message1[$start]);
        
        return $message2[0];
    }
    
    
    //Mailer method
    public function sendMail($from, $to, $subject, $body) {
	    $headers = '';
	    $headers .= "From: $from\n";
	    $headers .= "Reply-to: $from\n";
	    $headers .= "Return-Path: $from\n";
	    $headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
	    $headers .= "MIME-Version: 1.0\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        //$headers .= "X-Priority: 1(Highest)\r\n";
        //$headers .= "X-MSMail-Priority: High\r\n";
        $headers .= "Importance: High\r\n";
	    $headers .= "Date: " . date('r', time()) . "\n";

	    mail($to, $subject, $body, $headers);
    }
}

/*
    End of our class
     
    Now lets run the program! 
*/

$newEmail = new newMail();
$newEmail->debug();

$from = $newEmail->from();
$subject = $newEmail->subject(); 
$body = $newEmail->body(); 


if ($from && $subject && $body) {

    $url = 'http://demos.rflab.co.za/index.php?option=com_toarticle&view=toarticle&email='.$from.'&task=save';
    $ch = curl_init($url);
    $success = curl_exec ($ch);
    curl_close($ch);
    
    if ($success) {
    
        $newEmail->sendMail('support@rflab.co.za', $from, 'Article created', 'You have successifully created a new article for your website.');
        
    } else{
    
        $newEmail->sendMail('support@rflab.co.za', $from, 'Article not created', 'Creating a new article has failed, contact our support team if you need assistance.');
        
    }
    
} else {

    $newEmail->sendMail('support@rflab.co.za', $from, 'Your email contains errors', 'You Email format is not supported by our system please refer to the how to guide.');
 
}

?>