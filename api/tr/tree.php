<?php
	include("../../includes/conectar.php");

//$parent_id = $_GET['node'];

if ($_GET['node'] == 'root') {$parent_id = 0;} else {$parent_id = $_GET['node'];} // added by chiken
$query = "SELECT id, text, leaf FROM mytree WHERE parent_id='".$parent_id."' ORDER BY text ASC";

$rs = $conn->query($query);

$arr = array(); while($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
}

echo json_encode($arr);

?>