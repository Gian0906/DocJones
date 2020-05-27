<?php
header("Access-Control-Allow-Origin: *");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
  require_once "../composer/vendor/autoload.php"; 
/* Exception class. */
 require 'PHPMailer\src\Exception.php';

/* The main PHPMailer class. */
 require 'PHPMailer\src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
 require 'PHPMailer\src\SMTP.php';


  		if(isset($_POST)){				
	  	try{
			$mail = new PHPMailer(TRUE);
  			$postdata = file_get_contents("php://input");
  			$request = json_decode($postdata);
  			$emailaddress = $request->email;
  			$cust_name = $request->name;
  			$verification = $request->code;

  			// $link = "localhost/new/class/verified/verified.php?custid=".$custid."";
  	
    			$message = "<h2 style='color:#000;'>Good Day, $cust_name !</h2> <br>"
	        . "<p style='color:#000000;font-size:11pt;text-indent:20px;text-align:justify;'>Please use the code below to verify your email.Thank you for creating an account with DocJones.</p>"
	     	."<br>"
	        ."<p style='color:#ff3300;font-size:14pt;text-align:center;'><b>$verification</b></p>";
	 	
	   
       $mail->isSMTP();        
       $mail->SMTPAuth = true;                                  
       $mail->Host = 'smtp.gmail.com';
       $mail->Username = 'gianrecel0906@gmail.com';     
       $mail->Password = 'P@ssword0930';
       $mail->SMTPSecure = 'ssl';                           
       $mail->Port = 465;
     
       // $mail->setFrom('1998ROSALIES@gmail.com');
 		$mail->setFrom('gianrecel0906@gmail.com');

      //Recipients
       $mail->addAddress($emailaddress,$cust_name);              
  
      //Content
       $mail->isHTML(true);                                  
       $mail->Subject = "Verify your email";
       $mail->Body    = $message;
  
   if(!$mail->send()) 
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
      } 
      else 
        {
    echo "Message has been sent successfully";
        }
    }
     catch (Exception $e) {
			$_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			// $_SESSION['status'] = 'error';
			echo $_SESSION['result'];
		}
			}
  ?>