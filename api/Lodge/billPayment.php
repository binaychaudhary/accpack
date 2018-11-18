<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	//$guest_id=$_REQUEST['guest_id'];
	$gid=$_REQUEST['gid'];
	
	$q="select distinct entryNo as en from tmpentry where sourceCodeId=5 and accountNo='$gid'";
	$rs= $conn->query($q);
	$blNo="";
	if(mysqli_num_rows($rs)){
		while($r=mysqli_fetch_assoc($rs)){
			//print "<br>".$r['en'];
			if(is_null($blNo)){
				$blNo=$r['en'];
			}else{
				$blNo=$blNo."','".$r['en'];
			}
		}
	}
	//echo "<br>length: ".strlen($blNo);
	$queryString = "SELECT sum(te.debit) as debit,sum(te.credit) as credit,te.accountNo,am.accountDesc from entry e left join tmpentry te on e.fiscalyear=te.fiscalyear and e.sourceCodeId=te.sourceCodeId and e.entryNo=te.entryNo left join acmaster am on te.accountNo=am.accountNo Where te.accountNo!='$gid' and e.entryNo  in('".$blNo."') group by te.accountNo";

	$query = $conn->query($queryString) or die(mysqli_Connect_error());

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
		"billpayments" => $data,
		//"q"=>$queryString
	));
?>