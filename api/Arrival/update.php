<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['arrivals'];

	$data = json_decode($info);
	$id=$data->id;
	$entry_date_bs = $_REQUEST['entry_date_bs'];
	$entry_date_ad = $_REQUEST['entry_date_ad'];
	$name = $_REQUEST['name'];
	$address = $_REQUEST['address'];
	$contact_no = $_REQUEST['contact_no'];
	$email = $_REQUEST['email'];
	$gender = $_REQUEST['gender'];
	$country = $_REQUEST['country'];
	$room_id = $_REQUEST['room_id'];
	$room_no = $_REQUEST['room_no'];
	$guest_id = $_REQUEST['guest_id'];
	$no_of_visitor = $_REQUEST['no_of_visitor'];
	$no_of_day = $_REQUEST['no_of_day'];
	$book_id = $_REQUEST['book_id'];
	$room_id = $_REQUEST['room_id'];

      
	 // $entry_date_bs = $_REQUEST['entry_date_bs'];
	 // $entry_date_ad = $_REQUEST['entry_date_ad'];
	 // $entered_by = $_REQUEST['entered_by'];
	 // $booked_for_bs = $_REQUEST['booked_for_bs'];
	 // $booked_for_ad = $_REQUEST['booked_for_ad'];
	 // $no_of_days = $_REQUEST['no_of_days'];
	 // $guest_id = $_REQUEST['guest_id'];
	 // $id = $_REQUEST['id'];
	

	//consulta sql
	$query = sprintf("UPDATE arrival_type SET entry_date_bs = '%s', entry_date_ad = '%s',guest_name = '%s',address = '%s',contact_no = '%s',email = '%s',gender = '%d',country='%s',room_id='%d',room_no='%s',guest_id='%d',no_of_visitor='%d',no_of_day='%d',book_id='%d' WHERE id=%d",
		$conn->real_escape_string($entry_date_bs),
		$conn->real_escape_string($entry_date_ad),
		$conn->real_escape_string($name),
		$conn->real_escape_string($address),
		$conn->real_escape_string($contact_no),
		$conn->real_escape_string($email),
		$conn->real_escape_string($gender),
		$conn->real_escape_string($country),
		$conn->real_escape_string($room_id),
		$conn->real_escape_string($room_no),
		$conn->real_escape_string($guest_id),
		$conn->real_escape_string($no_of_visitor),
		$conn->real_escape_string($no_of_day),
     	$conn->real_escape_string($book_id),
        $conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"arrivals" => array(
			"entry_date_bs" => $entry_date_bs,
			"entry_date_ad"=>$entry_date_ad,
			"name"=>$name,
			"address"=>$address,
			"contact_no"=>$contact_no,
			"email"=>$email,
			"gender"=>$gender,
			"country"=>$country,
			"room_id"=>$room_id,
			"room_no"=>$room_no,
			"guest_id"=>$guest_id,
			"no_of_visitor"=>$no_of_visitor,
			"no_of_day"=>$no_of_day,
			"book_id"=>$book_id,
			"q"=>$query

		)
	));
?>