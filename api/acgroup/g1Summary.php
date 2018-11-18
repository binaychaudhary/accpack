<?php
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =ut
	$ac_nature=$_REQUEST['ac_nature'];
	$upto_date_ad = $_REQUEST['upto_date_ad'];
	$sql ="select  distinct g1, group_name, 0 as debit, 0 as credit from  ac_group   where ac_nature='$ac_nature' and level=1";
	
	
	//echo $sql;
	$rs = $conn->query($sql);
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($rs)) {
		//echo $dat['g1'];
		if(($ac_nature=='1') || ($ac_nature=='4')){
			$qr ="select COALESCE(sum(debit)-sum(credit),0) as debit, 0 as credit from tmpentry where g1='".$dat['g1']."' and entry_date_ad<='$upto_date_ad'";
		}else{
			$qr ="select COALESCE(sum(credit)-sum(debit),0) as credit, 0 as debit from tmpentry where g1='".$dat['g1']."' and entry_date_ad<='$upto_date_ad'";
		}
		
		//echo $qr;
		$rs1=$conn->query($qr);
		$r=mysqli_fetch_assoc($rs1);
		$dat['debit'] = $r['debit'];
		$dat['credit'] = $r['credit'];
	    $data[] = $dat;
	    $cnt=$cnt+1;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"g1" => $data,
		"qr" =>$qr
	));
?>