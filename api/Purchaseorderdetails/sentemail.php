<?php
// the message
ini_set("SMTP","localhost");
   ini_set("smtp_port","25");
  // ini_set("sendmail_from","00000@gmail.com");

$to = "webpay2070@gmail.com";
$subject = "This is subject";
        

         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:binay@webpay.com.np \r\n";
         $header .= "Cc:logicplus2068@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }

?>
