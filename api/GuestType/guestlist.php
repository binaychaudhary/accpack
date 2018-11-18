<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	//mysql_query('SET character_set_results =utf8');
	$name=$_REQUEST['name'];
	$address=$_REQUEST['address'];
	$contact_no=$_REQUEST['contact_no'];
	$country=$_REQUEST['country'];
	$register_date_bs=$_REQUEST['register_date_bs'];
	$gender=$_REQUEST['gender'];
	$cr="";
	
	if(is_null($name)||($name=="")){
	}else{
		if($cr==""){
			$cr=" where g.name like '%".$name . "%'";
		}else{
			$cr = $cr." and g.name like '%".$name . "%'";
		}
	}
	
	if(is_null($address)||($address=="")){
	}else{
		if($cr==""){
			$cr=" where g.address like '%".$address . "%'";
		}else{
			$cr = $cr." and g.address like '%".$address . "%'";
		}
	}
	if(is_null($contact_no)||($contact_no=="")){
	}else{
		if($cr==""){
			$cr=" where g.contact_no like '%".$contact_no . "%'";
		}else{
			$cr = $cr." and g.contact_no like '%".$contact_no . "%'";
		}
	}
	if(is_null($country)||($country=="")){
	}else{
		if($cr==""){
			$cr=" where g.country like '%".$country . "%'";
		}else{
			$cr = $cr." and g.country like '%".$country . "%'";
		}
	}
	if(is_null($register_date_bs)||($register_date_bs=="")){
	}else{
		if($cr==""){
			$cr=" where g.register_date_bs like '%".$register_date_bs . "%'";
		}else{
			$cr = $cr." and g.register_date_bs like '%".$register_date_bs . "%'";
		}
	}
	if(is_null($gender)||($gender=="")){
	}else{
		if($cr==""){
			$cr=" where g.gender like '%".$gender . "%'";
		}else{
			$cr = $cr." and g.gender like '%".$gender . "%'";
		}
	}
	$queryString = "SELECT g.*, v.vdescription from guest_register g";
	$queryString.= " left join visit_type v on g.visit_type = v.id".$cr;
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
		"guesttypes" => $data,
		"q"=>$queryString
	));
?>