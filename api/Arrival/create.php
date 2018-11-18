<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['Arrivals'];

	// $data = json_decode($info);
	
	// $entry_date_bs = $data->entry_date_bs;
	// $entry_date_ad=$data->entry_date_ad;
	// $name=$data->name;
	// $address=$data->address;
	// $contact_no=$data->contact_no;
	// $email=$data->email;
	// $gender=$data->gender;
	// $country=$data->country;
	// $room_id=$data->room_id;
	// $room_no=$data->room_no;
	// $guest_id=$data->guest_id;
	// $no_of_visitor=$data->no_of_visitor;
 	// $book_id=$data->book_id;
 	// $room_id=$data->room_id;
   
	

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
	   //consulta sql
    
	$query = sprintf("INSERT INTO arrival (entry_date_bs,entry_date_ad,name,address,contact_no,email,gender,country,room_id,room_no,guest_id,no_of_visitor,no_of_day,book_id) values ('%s','%s','%s','%s','%s','%s','%d','%s','%s','%s','%d','%d','%d','%d')",
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
     	$conn->real_escape_string($book_id)
	);

	$rs = $conn->query($query);

	$cntSql="select count(*) as cnt from arrival where guest_id='$guest_id'";
	$rs = $conn->query($cntSql);
	$r=mysqli_fetch_assoc($rs);
	$cnt = $r['cnt'];
	if($cnt==1){
		$gstSql="select * from guest_register where id='".$guest_id."'";
		$rs=$conn->query($gstSql);
		$r=mysqli_fetch_assoc($rs);
		$actual_guest_id=$r['actual_guest_id'];
		$guestName=$r['name'];

		//inserting into segment data for debtor
		$insSql="insert into segmentdata(segment_id, segment_code, name_np) values('85','$actual_guest_id','$guestName')";
		$conn->query($insSql);
	}



	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"arrivals" => array(
			"id" => mysqli_insert_id($conn),
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
