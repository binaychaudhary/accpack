<?php

	include("../conn.php");

	$info = $_POST['designation'];
	$data = json_decode(stripslashes($info));

	$id=$data->id;
	$delSql="delete from design where id=$id";
	$conn->query($delSql);
?>