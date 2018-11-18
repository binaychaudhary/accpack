<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$accountNo=$_REQUEST['accountNo'];
	$accountDesc=$_REQUEST['accountDesc'];
	$fromDateAd=$_REQUEST['fromDateAd'];
	$uptoDateAd=$_REQUEST['uptoDateAd'];
	$cr="";
	if(is_null($accountNo)||($accountNo=="")){
	}else{
		if($cr==""){
			$cr=" where c.accountNo like '%".$accountNo . "%'";
		}else{
			$cr = $cr." and c.accountNo like '%".$accountNo . "%'";
		}
	}
	if(is_null($accountDesc)||($accountDesc=="")){
	}else{
		if($cr==""){
			$cr=" where a.accountDesc like '%".$accountDesc . "%'";
		}else{
			$cr = $cr." and a.accountDesc like '%".$accountDesc . "%'";
		}
	}
	if(is_null($fromDateAd)||($fromDateAd=="")){
	}else{
		if($cr==""){
			$cr=" where c.printedDateAd => '".$fromDateAd . "'";
		}else{
			$cr = $cr." and c.printedDateAd >= '".$fromDateAd . "'";
		}
	}
	if(is_null($uptoDateAd)||($uptoDateAd=="")){
	}else{
		if($cr==""){
			$cr=" where c.printedDateAd <= '".$uptoDateAd . "'";
		}else{
			$cr = $cr." and c.printedDateAd <= '".$uptoDateAd . "'";
		}
	}
	$queryString = "SELECT c.*, a.accountDesc, u.userName from chequeprint c left join acmaster a on c.accountNo = a.accountNo left join user u on c.printedBy = u.id ".$cr." order by printedDateAd desc LIMIT $start,  $limit";
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
		"chequeprints" => $data
	));
?>