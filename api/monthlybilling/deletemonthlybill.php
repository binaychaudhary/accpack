<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$yr = $_REQUEST['yr'];
	$mn = $_REQUEST['mn'];
	$fiscalyear = $_REQUEST['fiscalyear'];
	$sourceCodeId = $_REQUEST['sourceCodeId'];
	$entryNo =  $_REQUEST['entryNo'];
	$accountNo = $_REQUEST['accountNo'];
	$cr="";
	
	
	if(is_null($fiscalyear)||($fiscalyear=="")){
	}else{
		if($cr==""){
			$cr=" where fiscalyear = '".$fiscalyear . "'";
		}else{
			$cr = $cr." and fiscalyear = '".$fiscalyear . "'";
		}
	}
	if(is_null($sourceCodeId)||($sourceCodeId=="")){
	}else{
		if($cr==""){
			$cr=" where sourceCodeId = '".$sourceCodeId . "'";
		}else{
			$cr = $cr." and sourceCodeId = '".$sourceCodeId . "'";
		}
	}
	if(is_null($entryNo)||($entryNo=="")){
	}else{
		if($cr==""){
			$cr=" where entryNo = '".$entryNo . "'";
		}else{
			$cr = $cr." and entryNo = '".$entryNo . "'";
		}
	}

	$sql = "delete from tmpentry ".$cr;
	$conn->query($sql);
	//echo "<br>".$sql;
	$sql = "delete from entry ".$cr;
	$conn->query($sql);
	//echo "<br>".$sql;
	$cr="";
	if(is_null($yr)||($yr=="")){
	}else{
		if($cr==""){
			$cr=" where yr = '".$yr . "'";
		}else{
			$cr = $cr." and yr = '".$yr . "'";
		}
	}

	if(is_null($mn)||($mn=="")){
	}else{
		if($cr==""){
			$cr=" where mn = '".$mn . "'";
		}else{
			$cr = $cr." and mn = '".$mn . "'";
		}
	}

	if(is_null($accountNo)||($accountNo=="")){
	}else{
		if($cr==""){
			$cr=" where accountNo = '".$accountNo . "'";
		}else{
			$cr = $cr." and accountNo = '".$accountNo . "'";
		}
	}
	$sql="delete from monthlybill  ".$cr;
	$conn->query($sql);
	//echo "<br>".$sql;
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
	
?>      