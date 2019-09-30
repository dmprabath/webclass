<?php 
require_once("dbconnection.php");

if(isset($_GET["type"])){ 
	$type = $_GET["type"];
	$type();
}

function getNewINVNo(){
	$dbobj = DB::connect();
	$cdate = date("Y-m-d",time());
	//get current date using date function
	
	$sql = "SELECT count(inv_id) FROM tbl_invoice WHERE inv_date = '$cdate';";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}
	$row = $result->fetch_array();
	$count =$row[0];
	$count++;
	$newid = "INV".str_replace("-","",$cdate)."_".str_pad($count,4,"0",STR_PAD_LEFT);
	echo ($newid);
	$dbobj->close();
} 
function getProductDetails(){
	$prodid= $_POST["prodid"];
	$dbobj =DB::connect();
	$sql = "SELECT * FROM tbl_product WHERE prod_id ='$prodid'";
	$result = $dbobj ->query($sql);
	
	$nor = $result->num_rows;
	if($nor==0){
		echo("0,Invalied product id");
		
		exit;
	}else{
		$rec = $result->fetch_assoc();
		$pname = $rec["prod_name"];
		$qty = $rec["prod_qty"];
		echo("1,$pname,$qty");
	}
	$dbobj->close();
}

?>