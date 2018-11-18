<?php 
	include("../../includes/conectar.php");
    $parent = $_REQUEST['parent'];
    $level  = $_REQUEST['level'];
function display_children($parent, $level) { 
    $sql ="SELECT * FROM  inv_group";
    $result = $conn->query($sql); 
    //echo "<br>".$sql;

    $list_items=array();
    while ($row = mysqli_fetch_array($result)) { 
     //   echo "<br>".$level." ".str_repeat('  ',$level).$row['group_name'];
     //   echo "<br>".str_repeat('  ',$level);
        $items=array(
            'parent'=>$row['parent_group_id'],
            'group_code'=>$row['group_code'],
            'group_name'=>str_repeat('     ',$level).$row['group_name']
        );
        $list_items[]=$items;
        //$list_items[]=$row;
        //0display_children($row['id'], $level+1); 
    } 
    return $list_items;
} 
$data=display_children($parent,$level);
     echo '{results: ' . json_encode($data) . '}';
?>