<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['appsettings'];

	$data = json_decode($info);
	$org_id = $data->org_id;
	$setting_name=$data->setting_name;
	$value_txt = $data->value_txt;
	
	//consulta sql
	$query = sprintf("INSERT INTO app_setting (org_id,setting_name, value_txt) values ('%d','%s','%s')",
		$conn->real_escape_string($org_id),
		$conn->real_escape_string($setting_name),
		$conn->real_escape_string($value_txt)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"appsettings" => array(
			"id" => mysqli_insert_id($conn),
			"org_id" => $org_id,
			"setting_name" => $setting_name,
			"value_txt" => $value_txt
		)
	));
?>