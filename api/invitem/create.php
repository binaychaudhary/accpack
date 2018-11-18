<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	 $info = $_POST['invitems'];

	 $data = json_decode($info);
	
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
	$perUnit=$data->perUnit;
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
	$query = sprintf("INSERT INTO inv_item(item_name, alias_name, group_id, unit_id, qty, rate, amount, PurchaseAccount, SalesAccount, salesUnitId, perUnit, category_id, department_id) values ('%s','%s','%d','%d','%s','%s','%s','%s','%s','%d','%s','%d','%d')",
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
		$conn->real_escape_string($department_id)
	);

	$rs = $conn->query($query);
	//echo $query;

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"invitems" => array(
			"id" => mysqli_insert_id($conn),
			"item_name" => $item_name,
			"alias_name" => $alias_name,
			"group_id"=>$group_id,
			"unit_id"=>$unit_id,
			"qty"=>$qty,
			"rate"=>$rate,
			"amount"=>$amount,
			"group_name"=>$group_name,
			"group_code"=>$group_code,
			"unit"=>$unit,
			"salesUnitId"=>$salesUnitId,
			"perUnit"=>$perUnit,
			"category_id" =>$category_id,
			"category" =>$category,
			"department_id" =>$department_id,
			"department" =>$department
		),
		"qry" => $query
	));
?>