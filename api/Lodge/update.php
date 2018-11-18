<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	// $info = $_POST['lodges'];

	// $data = json_decode($info);
	// $id=$data->id;
	// $edate_bs = $data->edate_bs;
	// $edate_ad = $data->edate_ad;
	// $guest_id=$data->guest_id;
	// $no_of_guest = $data->no_of_guest;
	// $dept_date_bs=$data->dept_date_bs;
	// $dept_date_ad=$data->dept_date_ad;
	// $no_of_day=$data->no_of_day;

	$id=$_REQUEST['id'];
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
	$query = "UPDATE lodge SET edate_bs = '".$edate_bs."',edate_ad = '".$edate_ad."', guest_id = '".$guest_id."', no_of_guest = '".$no_of_guest."', room_id = '".$room_id."',from_date_bs='".$from_date_bs."',from_date_ad='".$from_date_ad."',upto_date_bs='".$upto_date_bs."',upto_date_ad='".$upto_date_ad."',room_no = '".$room_no."', no_of_day= '".$no_of_day."' WHERE id='".$id."'";
	
	$rs = $conn->query($query);
	$deleteQuery="DELETE FROM room_book_log where book_id='$id'";
	$rd=$conn->query($deleteQuery);
	
	$cats = explode(",", $room_id);
	foreach($cats as $val) {

	$query = "INSERT INTO room_book_log(book_id,room_id,from_date_bs,from_date_ad,upto_date_bs,upto_date_ad) VALUES('$id','$val','$from_date_bs','$from_date_ad','$upto_date_bs','$upto_date_ad')";  
	$r=$conn->query($query);
	//echo $val;

	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"lodges" => array(
			"id" => $id,
			"edate_bs" => $edate_bs,
			"edate_ad" => $edate_ad,
			"guest_id" => $guest_id,
			"no_of_guest" => $no_of_guest,
			"room_id" => $room_id,
			"room_no" => $room_no,
			"no_of_day"=>$no_of_day,
			"q"=>$query
		)
	));
?>