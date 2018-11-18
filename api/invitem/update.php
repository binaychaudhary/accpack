<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");

	// $id=$_REQUEST['id'];
	// $group_id=$_REQUEST['group_id'];

	$info = $_POST['invitems'];

	$data = json_decode($info);
	$id=$data->id;
	$item_name = $data->item_name;
	$alias_name = $data->alias_name;
	$group_id=$data->group_id;
	$unit_id=$data->unit_id;
	$qty=$data->qty;
	$rate=$data->rate;
	$amount=$data->amount;
	$PurchaseAccount=$data->PurchaseAccount;
	$SalesAccount=$data->SalesAccount;
	$salesUnitId=$data->salesUnitId;
	$perUnit = $data->perUnit;
	$category_id = $data->category_id;
	$department_id = $data->department_id;



	if(($qty=='') || ($qty==null)){
		$qty=0;
	}
	if(($rate=='') || ($rate==null)){
		$rate=0;
	}
	if(($amount=='') || ($amount==null)){
		$amount=0;
	}

	$rs=$conn->query("select * from inv_group where id='".$group_id."'");
	$r=mysqli_fetch_assoc($rs);
	$group_name=$r['group_name'];
	$group_code=$r['group_code'];
	$lvl = $r['level']+1;
	$rs=$conn->query("select * from unit where id='".$unit_id."'");
	$r=mysqli_fetch_assoc($rs);
	$unit=$r['Unit'];
	
	//category id
	$rs=$conn->query("select * from item_category where id='".$category_id."'");
	$r=mysqli_fetch_assoc($rs);
	$category=$r['category'];

	//category id
	if(($department_id=="") || ($department_id==null)){
		$department_id=0;
	}
	$rs=$conn->query("select * from department where id='".$department_id."'");
	$department="";
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$department=$r['department'];
	}

	//consulta sql
	$query = sprintf("UPDATE inv_item SET item_name = '%s', alias_name = '%s', group_id='%d', unit_id='%d', qty='%s', rate='%s', amount='%s', PurchaseAccount='%s', SalesAccount='%s', salesUnitId='%d', perUnit='%s', category_id='%d',department_id='%d' WHERE id=%d",
		$conn->real_escape_string($item_name),
		$conn->real_escape_string($alias_name),
		$conn->real_escape_string($group_id),
		$conn->real_escape_string($unit_id),
		$conn->real_escape_string($qty),
		$conn->real_escape_string($rate),
		$conn->real_escape_string($amount),
		$conn->real_escape_string($PurchaseAccount),
		$conn->real_escape_string($SalesAccount),
		$conn->real_escape_string($salesUnitId),
		$conn->real_escape_string($perUnit),
		$conn->real_escape_string($category_id),
		$conn->real_escape_string($department_id),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	$sql ="update inv_item set group_".$lvl."_id = '".$group_id."' where id='$id'";
	$conn->query($sql);	

	$hasChild = 1;
	while($lvl>0){
		$sql = "select * from inv_group where id='$group_id'";
		$rs  = $conn->query($sql);
		$r= mysqli_fetch_assoc($rs);
		$hasChild = $r['hasChild'];
		$group_id= $r['parent_group_id'];	
		$lvl = $lvl-1;
		$sql ="update inv_item set group_".$lvl."_id = '".$group_id."' where id='$id'";
		$conn->query($sql);	
		
		
//		echo "<br>".$sql;
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"invitems" => array(
			"id" => $id,
			"item_name" => $item_name,
			"alias_name" => $alias_name,
			"group_id"=>$group_id,
			"unit_id"=>$unit_id,
			"tax_rate"=>$tax_rate,
			"other_tax_rate"=>$other_tax_rate,
			"qty"=>$qty,
			"rate"=>$rate,
			"amount"=>$amount,
			"group_name"=>$group_name,
			"group_code"=>$group_code,
			"unit"=>$unit,
			"salesUnitId"=>$salesUnitId,
			"perUnit"=>$perUnit,
			"category_id"=>$category_id,
			"category" =>$category,
			"department_id" =>$department_id,
			"department" =>$department
		)
	));
?>