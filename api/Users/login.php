<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$email=$_REQUEST['email'];
	$pass=$_REQUEST['pass'];
	$cr="";
	
	if(is_null($email)||($email=="")){
	}else{
		if($cr==""){
			$cr=" where u.email = '".$email . "'";
		}else{
			$cr = $cr." and u.email = '".$email . "'";
		}
	}
	if(is_null($pass)||($pass=="")){
	}else{
		if($cr==""){
			$cr=" where u.pass = '".md5($pass) . "'";
		}else{
			$cr = $cr." and u.pass = '".md5($pass) . "'";
		}
	}
	
	$queryString = "SELECT * FROM user u".$cr;
	//echo $queryString;

	$query = $conn->query($queryString) or die(mysqli_connect_error());

	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($query)) {
	    $data[] = $dat;
	    $cnt=$cnt+1;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"users" => $data
	));
?>