<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['menutousers'];

	$data = json_decode($info);
	$id=$data->id;
	$userId = $data->userId;
	$mainMenuId = $data->mainMenuId;
	$menuId=$data->menuId;
	$status=$data->status;

	// $id=$_REQUEST['id'];
	// $userId = $_REQUEST['userId'];
	// $mainMenuId = $_REQUEST['mainMenuId'];
	// $menuId=$_REQUEST['menuId'];
	// $status=$_REQUEST['status'];
	
	$rs=$conn->query("select * from mainmenu where id='".$mainMenuId."'");
	$r=mysqli_fetch_assoc($rs);
	$mainMenuName=$r['menuName'];

	$rs=$conn->query("select * from submenu where id='".$menuId."'");
	$r=mysqli_fetch_assoc($rs);
	$menuName=$r['menuName'];


	//consulta sql
	$query = sprintf("UPDATE menutousers SET menuId = '%d', status = '%d' WHERE id=%d",
		$conn->real_escape_string($menuId),
		$conn->real_escape_string($status),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"menutousers" => array(
			"id" => $id,
			"userId" => $userId,
			"mainMenuId" => $mainMenuId,
			"menuId"=>$menuId,
			"status"=>$status,
			"mainMenuName"=>$mainMenuName,
			"menuName"=>$menuName
		)
	));
?>