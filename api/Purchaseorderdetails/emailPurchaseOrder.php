<?php
	//chama o arquivo de conexão com o bd
	include("http://www.webpay.com.np/testemail.php");
	
	$order_no = $_REQUEST['order_no'];
	$email_address = $_REQUEST['email_address'];
	$supplier_name=$_REQUEST['supplier_name'];
	$order_date_bs=$_REQUEST['order_date_bs'];

	$sql ="select * from purchase_order_detail where order_no ='".$order_no."'";
	$conn->query($sql);

	$to = $email_address;
	$subject = 'Purchase Order';
	$headers = "From: binaychy@yahoo.com\r\n";
	$headers .= "Reply-To: binaychy@yahoo.com\r\n";
	$headers .= "CC: logicplus2068@gmail.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	

	$message = '<html><body>';
	$message .= '<img src="resources/images/webpay.jpg" alt="www.webpay.com.np" width="50%" /><br>';
	$message .='<strong>Dear '.$supplier_name.'</strong><br><br>';
	$message .='<br><br>Below is the details of your account:<br>';

	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Item Name:</strong> </td><td><strong>QTY</strong></td><td><strong>RATE</strong><td><strong>AMOUNT</strong></td></td></tr>";
	
	$message .= "</table>";
	$message .='<br>With Best Regards<br>--------------<br>
	Om Tridev Supplier<br>Lahan, Siraha';
	$message .= "</body></html>";

	sendemail($to,$subject,$message,$supplier_name);
      
?>