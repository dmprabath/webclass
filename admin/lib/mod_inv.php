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
function getBatchDetails(){
	$prodid= $_POST["prodid"];
	$rqty= $_POST["rqty"];
	$dbobj =DB::connect();

	$sql = "SELECT * FROM tbl_batch JOIN tbl_product ON tbl_batch.prod_id = tbl_product.prod_id WHERE tbl_batch.prod_id='$prodid' and tbl_batch.bat_status=1 ORDER BY tbl_batch.bat_id ASC;";

	$result = $dbobj ->query($sql);
	
	if($dbobj->errno){
		echo("0,SQL Error : ".$dbobj->erro);
		exit;
	}
	$output = array(); // output array multiple columns
	while($rec = $result->fetch_assoc()){  // output row by row
		$line =array();

		if($rec["bat_qty_rem"]>=$rqty){
			$line[0] = $rec['prod_id'];
			$line[1] = $rec['bat_id'];
			$line[2] = $rec['prod_name'];
			$line[3] = $rec['bat_sprice'];
			$line[4] = $rqty;
			$output[] = $line;
			break;
			
		}else{
			$line[0] = $rec['prod_id'];
			$line[1] = $rec['bat_id'];
			$line[2] = $rec['prod_name'];
			$line[3] = $rec['bat_sprice'];
			$line[4] = $rec['bat_qty_rem'];
			$rqty = $rqty - $rec["bat_qty_rem"];
			$output[] = $line;
		}
	}
	echo (json_encode($output));
	$dbobj->close();




}

?>