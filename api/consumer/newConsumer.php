<?php
	include("../../includes/conectar.php");
	$acGroup='28';
	$groupSql ="select * from ac_group where id='".$acGroup."'";
	$groupRs = $conn->query($groupSql);
	$r = mysqli_fetch_assoc($groupRs);
	$ac_group_name = $r['group_name'];
	$g1 = $r['g1'];
	$g2= $r['g2'];
	$g3= $r['g3'];
	$g4= $r['g4'];
	$g5 =$r['g5'];
	$ac_group_desc=$r['group_name'];
	$natureId=$r['ac_nature'];

	$ac_prefix = $r['ac_prefix'];
	$acpre = explode('-', $ac_prefix);
	//echo $acpre[1];
	$acLength = strlen($acpre[1]);
	//echo $acLength;
	$rsacnature=$conn->query("select * from acnature where id='".$natureId."'");
	$r=mysqli_fetch_assoc($rsacnature);
	$nature=$r['nature'];

	
	//finding last ac_code from acmaster
	$lastAcCodeSql = "select * from acmaster where ac_group='".$acGroup."' order by id desc limit 1";
	//echo $lastAcCodeSql;
	$rs = $conn->query($lastAcCodeSql);
	$ac_code=0;
	$newAccountNo="";
	if(mysqli_num_rows($rs)>0){
		$r = mysqli_fetch_assoc($rs);
		$lastAcCode = $r['ac_code'];
		$ac_code=$lastAcCode+1;
		echo $ac_code;
		$newAcCode = "00000000000000".$ac_code;
		$newAcCode = substr($newAcCode,-$acLength);
		$newAccountNo = $acpre[0].'-'.$newAcCode;		
	}
	echo $newAccountNo;
?>