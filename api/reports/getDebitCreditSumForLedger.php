<?php
	
	include("../../includes/conectar.php");
	$accountNo=$_REQUEST['accountNo'];
	$fromDtAd = $_REQUEST['fromDtAd'];
	$uptoDtAd = $_REQUEST['uptoDtAd'];

	$qry=$conn->query("select * from acmaster where accountNo='".$accountNo."'");
	$rs = mysqli_fetch_assoc($qry);
	$natureId = $rs['natureId'];


	$qry=$conn->query("select e.*, s.* from tmpentry e left join sourcecode s on e.sourceCodeId=s.id where e.entry_date_ad>='".$fromDtAd."' and e.entry_date_ad<='".$uptoDtAd."' and e.accountNo='".$accountNo."' order by e.entry_date_ad");

	$data = array();
	$cnt=0;
	while($dat = mysqli_fetch_assoc($qry)) {
	    $data[] = $dat;
	    $cnt=$cnt+1;
	}

	

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total"=>$cnt,
		"natureId"=>$natureId,
		"data"=>$data,
		//"qry" => $qry
	));
?>