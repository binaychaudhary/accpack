<?php

$id = $_POST['id'];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["image-upload"]["name"]);
$extension = end($temp);
$error=null;
$resp=true;
$fileName=null;
if ((($_FILES["image-upload"]["type"] == "image/gif")
|| ($_FILES["image-upload"]["type"] == "image/jpeg")
|| ($_FILES["image-upload"]["type"] == "image/jpg")
|| ($_FILES["image-upload"]["type"] == "image/pjpeg")
|| ($_FILES["image-upload"]["type"] == "image/x-png")
|| ($_FILES["image-upload"]["type"] == "image/png"))
&& ($_FILES["image-upload"]["size"] < 5000000)
&& in_array($extension, $allowedExts))
{
if ($_FILES["image-upload"]["error"] > 0)
{
	$error="Return Code: " . $_FILES["image-upload"]["error"];
	$resp=false;
}
else
{
// echo "Upload: " . $_FILES["image-upload"]["name"];
// echo "Type: " . $_FILES["image-upload"]["type"];
// echo "Size: " . ($_FILES["image-upload"]["size"] / 1024) . " kB";
// echo "Temp file: " . $_FILES["image-upload"]["tmp_name"];


if (file_exists("upload/" . $_FILES["image-upload"]["name"]))
{
	$error= $_FILES["image-upload"]["name"] . " already exists. ";
	$resp=false;
}
else
{
move_uploaded_file($_FILES["image-upload"]["tmp_name"],"../upload/user/".$id.".".$extension);
	$fileName ="upload/user/".$id.".".$extension;

	include("conectar.php");
	$update_image_url="update user set image_url ='".$fileName."' where id='".$id."'";
	$conn->query($update_image_url);
}
}
}
else
{
	$error= "Invalid file";
	$resp=false;
}
echo json_encode(array(
	"success" => $resp,
	"error" => $error,
	"filename" => $fileName		
));
?>