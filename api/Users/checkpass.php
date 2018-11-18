<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$uid = $_REQUEST['uid'];
	$currentpass = $_REQUEST['currentpass'];
	
	$cr="";
	if(is_null($uid)||($uid=="")){
	}else{
		$cr=" where u.id = '".$uid . "'";
	}
	
	
	$queryString = "SELECT u.*  FROM user u ".$cr."";
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	$cnt=0;
	$data = array();
	$dat = mysqli_fetch_assoc($query);
	if(md5($currentpass)==$dat['pass']){
  	$resp=true;
	}else{
		$resp=false;
	} 


	//encoda para formato JSON
	echo json_encode(array(
		"response" =>$resp

	));
?>