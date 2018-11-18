<?php
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =ut
	$g1=$_REQUEST['g1'];
	$upto_date_ad = $_REQUEST['upto_date_ad'];

	$sql ="select distinct g2, '' as group_name,   0 as debit, 0 as credit from ac_group where g1='$g1' and level=2";
	$rs = $conn->query($sql);
	
	$cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($rs)) {
		$g2=$dat['g2'];

		$s1="select * from ac_group where id='$g2'";
		$rs1= $conn->query($s1);
		$r1 = mysqli_fetch_assoc($rs1);
		$ac_nature=$r1['ac_nature'];
		$dat['group_name']=$r1['group_name'];

		if(($ac_nature=="1") || ($ac_nature=="4")){
			$sql ="select COALESCE(sum(t.debit)-sum(t.credit),0) as debit, 0 as credit   from tmpentry t  where t.g1 = '$g1' and t.g2 ='".$g2."' and t.entry_date_ad<= '$upto_date_ad'";
		}else{
			$sql ="select COALESCE(sum(t.credit)-sum(t.debit),0) as credit, 0 as debit   from tmpentry t  where t.g1 = '$g1' and t.g2 ='".$g2."' and t.entry_date_ad<= '$upto_date_ad'";
		}
		
		//echo $sql;
		$rsss=$conn->query($sql);
		$rrr=mysqli_fetch_assoc($rsss);
		$dat['debit']= $rrr['debit'];
		$dat['credit']= $rrr['credit'];
	    $data[] = $dat;
	    $cnt=$cnt+1;
	}

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"g2" => $data
	));
?>