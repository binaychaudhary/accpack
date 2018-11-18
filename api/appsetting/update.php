<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//mysql_query("SET NAMES utf8");  
	$info = $_POST['appsettings'];

	$data = json_decode($info);
	$id = $data->id;
	$setting_name=$data->setting_name;
	$value_txt=$data->value_txt;
	
	
	//consulta sql
	$query = sprintf("UPDATE app_setting SET setting_name = '%s', value_txt='%s' WHERE id=%d",
		$conn->real_escape_string($setting_name),
		$conn->real_escape_string($value_txt),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"appsettings" => array(
			"id" => $id,
			"setting_name" => $setting_name,
			"value_txt" => $value_txt
		)
	));
?>