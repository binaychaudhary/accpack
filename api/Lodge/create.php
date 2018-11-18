<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['logdes'];

	// $data = json_decode($info);
	
	// $edate_bs = $data->edate_bs;
	// $edate_ad = $data->edate_ad;
	// $guest_id=$data->guest_id;
	// $no_of_guest = $data->no_of_guest;
	// $dept_date_bs=$data->dept_date_bs;
	// $dept_date_ad=$data->dept_date_ad;
	// $no_of_day=$data->no_of_day;

	$edate_bs=$_REQUEST['edate_bs'];
	$edate_ad=$_REQUEST['edate_ad'];
	$guest_id=$_REQUEST['guest_id'];
	$no_of_guest=$_REQUEST['no_of_guest'];
	$no_of_day=$_REQUEST['no_of_day'];
	$room_no=$_REQUEST['room_no'];
	$room_id=$_REQUEST['room_id'];
	$from_date_bs=$_REQUEST['from_date_bs'];
	$from_date_ad=$_REQUEST['from_date_ad'];
	$upto_date_bs=$_REQUEST['upto_date_bs'];
	$upto_date_ad=$_REQUEST['upto_date_ad'];


	//consulta sql
	$sql ="insert into lodge(edate_bs";
	$sql .= ",edate_ad";
	$sql .= ",guest_id";
	$sql .= ",no_of_guest";
	$sql .= ",room_id";
	$sql .= ",from_date_bs";
	$sql .= ",from_date_ad";
	$sql .= ",upto_date_bs";
	$sql .= ",upto_date_ad";
	$sql .= ",room_no";
	$sql .= ",no_of_day)";

	$sql .= " values(";
	$sql .= "'".$edate_bs."'";
	$sql .= ",'".$edate_ad."'";
	$sql .= ",'".$guest_id."'";
	$sql .= ",'".$no_of_guest."'";
	$sql .= ",'".$room_id."'";
	$sql .= ",'".$from_date_bs."'";
	$sql .= ",'".$from_date_ad."'";
	$sql .= ",'".$upto_date_bs."'";
	$sql .= ",'".$upto_date_ad."'";
	$sql .= ",'".$room_no."'";
	$sql .= ",'".$no_of_day."')";

	$rs=$conn->query($sql);
	$id=mysqli_insert_id($conn);

	$cats = explode(",", $room_id);
	foreach($cats as $val) {

	$query = "INSERT INTO room_book_log(book_id,room_id,from_date_bs,from_date_ad,upto_date_bs,upto_date_ad) VALUES('$id','$val','$from_date_bs','$from_date_ad','$upto_date_bs','$upto_date_ad')";  
	$r=$conn->query($query);
	//echo $val;

	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"logdes" => array(
			"id" => $id,
			"edate_bs" => $edate_bs,
			"edate_ad" => $edate_ad,
			"guest_id" => $guest_id,
			"no_of_guest" => $no_of_guest,
			"no_of_day"=>$no_of_day,
			"room_id" => $room_id,
			"room_no"=>$room_no,
			"from_date_bs" => $from_date_bs,
			"from_date_ad"=>$from_date_ad,
			"upto_date_bs" => $upto_date_bs,
			"upto_date_ad"=>$upto_date_ad
		)
	));
?>