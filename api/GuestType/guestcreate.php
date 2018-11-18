<?php
	//chama o arquivo de conex�o com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['guesttypes'];

	// $data = json_decode($info);
	
	// $name = $data->name;
	// $address=$data->address;
	// $contact_no=$data->contact_no;
	// $email=$data->email;
	// $gender=$data->gender;
	// $visit_type=$data->visit_type;
	// $no_of_visitor=$data->no_of_visitor;
	// $country=$data->country;
	// $register_date_bs=$data->register_date_bs;
	// $register_date_ad=$data->register_date_ad;

	$name = $_REQUEST['name'];
	$address = $_REQUEST['address'];
	$contact_no = $_REQUEST['contact_no'];
	$email = $_REQUEST['email'];
	$gender = $_REQUEST['gender'];
	$visit_type_id = $_REQUEST['visit_type_id'];
	$country = $_REQUEST['country'];
	$register_date_bs = $_REQUEST['register_date_bs'];
	$register_date_ad = $_REQUEST['register_date_ad'];
	$hotel_guest=$_REQUEST['hotel_guest'];
	$swimming_member=$_REQUEST['swimming_member'];
	$gym_member=$_REQUEST['gym_member'];
	$sauna_bath_member=$_REQUEST['sauna_bath_member'];
	$others=$_REQUEST['others'];
	//consulta sql
	$query = sprintf("INSERT INTO guest_register (name,address,contact_no,email,gender,visit_type,hotel_guest,swimming_member,gym_member,sauna_bath_member,others,country,register_date_bs,register_date_ad) values ('%s','%s','%s','%s','%d','%d','%d','%d','%d','%d','%d','%s','%s','%s')",
		$conn->real_escape_string($name),
		$conn->real_escape_string($address),
		$conn->real_escape_string($contact_no),
		$conn->real_escape_string($email),
		$conn->real_escape_string($gender),
		$conn->real_escape_string($visit_type_id),
		$conn->real_escape_string($hotel_guest),
		$conn->real_escape_string($swimming_member),
		$conn->real_escape_string($gym_member),
		$conn->real_escape_string($sauna_bath_member),
		$conn->real_escape_string($others),
		$conn->real_escape_string($country),
		$conn->real_escape_string($register_date_bs),
		$conn->real_escape_string($register_date_ad)
	);

	$rs = $conn->query($query);

	$guest_id=mysqli_insert_id($conn);
	$long_guest_id = "000000000".$guest_id;
	$actual_guest_id = substr($long_guest_id,-6);
	$update_guest_id ="update guest_register set actual_guest_id='$actual_guest_id' where id='$guest_id'";
	$conn->query($update_guest_id);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"guesttypes" => array(
			"id" => $guest_id,
			"name" => $name,
			"address"=>$address,
			"contact_no"=>$contact_no,
			"email"=>$email,
			"gender"=>$gender,
			"visit_type"=>$visit_type_id,
			"hotel_guest"=>$hotel_guest,
			"swimming_member"=>$swimming_member,
			"gym_member"=>$gym_member,
			"sauna_bath_member"=>$sauna_bath_member,
			"others"=>$others,
			"country"=>$country,
			"register_date_bs"=>$register_date_bs,
			"register_date_ad"=>$register_date_ad,
			"q"=>$query
			
		)
	));
?>