<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['itemgroups'];

	// $data = json_decode($info);
	
	// $group_name=$data->group_name;
	// $parent_id=$data->parent_id;

	$group_name=$_REQUEST['group_name'];
	$parent_id=$_REQUEST['parent_id'];
	//echo $group_name;
	//echo "<br>".is_null($parent_id);
	if($parent_id==""){
		$insQry ="insert into item_group(group_name,g1_name, level) values('$group_name','$group_name',1)";
		$conn->query($insQry);
	}else{
		$lvlQry="select level from item_group where id='$parent_id'";
		$lvlRs = $conn->query($lvlQry);
		$r= mysqli_fetch_assoc($lvlRs);
		$parentLevel = $r['level'];
		
		$f="";
		$v="";
		if($parentLevel==6){
			$gSql="select * from item_group where id='$parent_id'";
			$gRs = $conn->query($gSql);
			$gr =mysqli_fetch_assoc($gRs);
			$child_parent_id = $gr['parent_id'];
			$parentLvl=$parentLevel+1;
			if($f==""){				
				$f="g1,g1_name,g2,g2_name,g3,g3_name,g4,g4_name,g5,g5_name,g6,g6_name,g7_name,group_name, level";
				$v=$gr['g1']."','".$gr['g1_name']."','".$gr['g2']."','".$gr['g2_name']."','".$gr['g3']."','".$gr['g3_name']."','".$gr['g4']."','".$gr['g4_name']."','".$gr['g5']."','".$gr['g5_name']."','".$gr['g6']."','".$gr['g6_name']."','".$group_name."','".$group_name."','".$parentLvl;
				
			}else{
	
				$f=$f.",g1,g1_name,g2,g2_name,g3,g3_name,g4,g4_name,g5,g5_name,g6,g6_name,g7_name,group_name, level";
				$v=$v."','".$gr['g1']."','".$gr['g1_name']."','".$gr['g2']."','".$gr['g2_name']."','".$gr['g3']."','".$gr['g3_name']."','".$gr['g4']."','".$gr['g4_name']."','".$gr['g5']."','".$gr['g5_name']."','".$gr['g6']."','".$gr['g6_name']."','".$group_name."','".$group_name."','".$parentLvl;
			}
			$parent_id = $child_parent_id;
			$parentLevel=$parentLevel-1;

		} else if($parentLevel==5){

			$gSql="select * from item_group where id='$parent_id'";
			$gRs = $conn->query($gSql);
			$gr =mysqli_fetch_assoc($gRs);
			$child_parent_id = $gr['parent_id'];
			$parentLvl=$parentLevel+1;
			if($f==""){
				
				$f="g1,g1_name,g2,g2_name,g3,g3_name,g4,g4_name,g5,g5_name,g6_name,group_name, level";
				$v=$gr['g1']."','".$gr['g1_name']."','".$gr['g2']."','".$gr['g2_name']."','".$gr['g3']."','".$gr['g3_name']."','".$gr['g4']."','".$gr['g4_name']."','".$gr['g5']."','".$gr['g5_name']."','".$group_name."','".$group_name."','".$parentLvl;
				
			}else{
	
				$f=$f.",g1,g1_name,g2,g2_name,g3,g3_name,g4,g4_name,g5,g5_name,g6_name,group_name, level";
				$v=$v."','".$gr['g1']."','".$gr['g1_name']."','".$gr['g2']."','".$gr['g2_name']."','".$gr['g3']."','".$gr['g3_name']."','".$gr['g4']."','".$gr['g4_name']."','".$gr['g5']."','".$gr['g5_name']."','".$group_name."','".$group_name."','".$parentLvl;
			}
			$parent_id = $child_parent_id;
			$parentLevel=$parentLevel-1;

		} else if($parentLevel==4){

			$gSql="select * from item_group where id='$parent_id'";
			$gRs = $conn->query($gSql);
			$gr =mysqli_fetch_assoc($gRs);
			$child_parent_id = $gr['parent_id'];
			$parentLvl=$parentLevel+1;

			if($f==""){
				
				$f="g1,g1_name,g2,g2_name,g3,g3_name,g4,g4_name,g5_name,group_name, level";
				$v=$gr['g1']."','".$gr['g1_name']."','".$gr['g2']."','".$gr['g2_name']."','".$gr['g3']."','".$gr['g3_name']."','".$gr['g4']."','".$gr['g4_name']."','".$group_name."','".$group_name."','".$parentLvl;
				
			}else{
	
				$f=$f.",g1,g1_name,g2,g2_name,g3,g3_name,g4,g4_name,g5_name,group_name, level";
				$v=$v."','".$gr['g1']."','".$gr['g1_name']."','".$gr['g2']."','".$gr['g2_name']."','".$gr['g3']."','".$gr['g3_name']."','".$gr['g4']."','".$gr['g4_name']."','".$group_name."','".$group_name."','".$parentLvl;
			}
			$parent_id = $child_parent_id;
			$parentLevel=$parentLevel-1;

		}else if($parentLevel==3){
			$gSql="select * from item_group where id='$parent_id'";
			$gRs = $conn->query($gSql);
			$gr =mysqli_fetch_assoc($gRs);
			$child_parent_id = $gr['parent_id'];
			$parentLvl=$parentLevel+1;

			if($f==""){
				
				$f="g1,g1_name,g2,g2_name,g3,g3_name,g4_name,group_name, level";
				$v=$gr['g1']."','".$gr['g1_name']."','".$gr['g2']."','".$gr['g2_name']."','".$gr['g3']."','".$gr['g3_name']."','".$group_name."','".$group_name."','".$parentLvl;
				
			}else{
	
				$f=$f.",g1,g1_name,g2,g2_name,g3,g3_name,g4_name,group_name, level";
				$v=$v."','".$gr['g1']."','".$gr['g1_name']."','".$gr['g2']."','".$gr['g2_name']."','".$gr['g3']."','".$gr['g3_name']."','".$group_name."','".$group_name."','".$parentLvl;
			}
			$parent_id = $child_parent_id;
			$parentLevel=$parentLevel-1;
		} else if($parentLevel==2){
			$gSql="select * from item_group where id='$parent_id'";
			$gRs = $conn->query($gSql);
			$gr =mysqli_fetch_assoc($gRs);
			$child_parent_id = $gr['parent_id'];
			$parentLvl=$parentLevel+1;
			//echo $gr['g2'];
			if($f==""){
				
				$f="g1,g1_name,g2,g2_name,g3_name,group_name, level";
				$v=$gr['g1']."','".$gr['g1_name']."','".$gr['id']."','".$gr['g2_name']."','".$group_name."','".$group_name."','".$parentLvl;
				
			}else{
	
				$f=$f.",g1,g1_name,g2,g2_name,g3_name,group_name, level";
				$v=$v."','".$gr['g1']."','".$gr['g1_name']."','".$gr['id']."','".$gr['g2_name']."','".$group_name."','".$group_name."','".$parentLvl;
			}
			$parent_id = $child_parent_id;
			$parentLevel=$parentLevel-1;
			//finding parent id
		} else if($parentLevel==1){
			
			
			$gSql="select * from item_group where id='$parent_id'";
			$gRs = $conn->query($gSql);
			$gr =mysqli_fetch_assoc($gRs);
			$child_parent_id = $gr['parent_id'];

			$parentLvl=$parentLevel+1;
			if($f==""){
				
				$f="group_name,g1,g1_name,g2_name, level";
				$v=$group_name."','".$parent_id."','".$gr['g1_name']."','".$group_name."','".$parentLvl;
				
			}else{
	
				$f=$f.",group_name,g1,g1_name,g2_name, level";
				$v=$v."','".$group_name."','".$parent_id."','".$gr['g1_name']."','".$group_name."','".$parentLvl;
			}
			$parent_id = $child_parent_id;
			$parentLevel=$parentLevel-1;
			//finding parent id
			
		}
		if($parentLevel==0){
			//echo $f.' '.$v;
			if($f==""){
				$f="g1_name";
				$v=$group_name;
			}
		}

		if($f==""){
			$f=$f.",parent_id";
			$v=$v.','.$parent_id;
		}
		
		$sql ="insert into item_group(".$f.") values('"
.$v."')";
//echo "<br>".$sql;
		$conn->query($sql);
	}
	

?>