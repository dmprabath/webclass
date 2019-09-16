<?php 
require_once("dbconnection.php");

if(isset($_GET["type"])){ 
	$type = $_GET["type"];
	$type();
}




function getSuppliers(){

	$dbobj = DB::connect();
	$sql = "SELECT sup_id,sup_name FROM tbl_supplier;";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}

	$output ="";
	while($rec = $result->fetch_assoc()){
		$output .="<option value='".$rec["sup_id"]."'>".$rec["sup_name"]."</option>";
	}
	
	echo($output);
	$dbobj->close();
}

function getCategories(){
	$dbobj = DB::connect();
	$sql = "SELECT cat_id,cat_name FROM  tbl_category;";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}

	$output ="";
	while($rec = $result->fetch_assoc()){
		$output .="<option value='".$rec["cat_id"]."'>".$rec["cat_name"]."</option>";
	}
	
	echo($output);
	$dbobj->close();
}
function getProducts(){
	$catid = $_POST['catid'];
	$dbobj = DB::connect();
	$sql = "SELECT prod_id,prod_name FROM  tbl_product WHERE cat_id='$catid';";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("0");
		exit;
	}

	$output ="<option value=''>--Select Products--</option>";
	while($rec = $result->fetch_assoc()){
		$output .="<option value='".$rec["prod_id"]."'>".$rec["prod_name"]."</option>";
	}
	
	echo($output);
	$dbobj->close();
}

function getNewGRNNo(){
	$dbobj = DB::connect();
	$sql = "SELECT grn_id FROM  tbl_grn ORDER BY grn_id DESC LIMIT 1;";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("0");
		exit;
	}

	$nor = $result->num_rows;
	$newid = "";
	if($nor=="0")
		$newid = "1";
	else{
		$rec = $result->fetch_array();
		$id =$rec[0];
		$newid = $id+1;

		}
	echo($newid);
	$dbobj->close();

}

function newGRN(){
	$dbobj = DB::connect();

	$grn_id =$_POST["txtgrnno"];
	$sup_id =$_POST["cmbsup"];
	$grn_rdate =$_POST["txtrdate"];
	$grn_gtot =$_POST["txtgtot"];
	$grn_disc =$_POST["txtdiscount"];
	$grn_ntot =$_POST["txtntot"];

	$sql_grn = "INSERT INTO tbl_grn(grn_id,sup_id,grn_rdate,grn_gtotal,grn_discount,grn_ntotal) VALUES(?,?,?,?,?,?);";
	//echo($sql_grn);
	$stmt = $dbobj->prepare($sql_grn);
	
	$stmt->bind_param("issddd",$grn_id,$sup_id,$grn_rdate,$grn_gtot,$grn_disc,$grn_ntot);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		
		$pro_id= $_POST["txtproid"];
		$exp_date= $_POST["txtexpdate"];
		$cost_price= $_POST["txtcostprice"];
		$sel_price= $_POST["txtselprice"];
		$pro_qty= $_POST["txtproqty"];

		$rows =count($_POST["txtproid"]);

		for($i=0; $i<$rows;$i++){
			$bat_id = getNewBatchId();
			$stat="1";

			$sql_batch = "INSERT INTO tbl_batch(bat_id,grn_id,prod_id,bat_sprice,bat_cprice,bat_qty,bat_rdate,bat_edate,bat_status) VALUES(?,?,?,?,?,?,?,?,?);";

			$stmt_batch = $dbobj->prepare($sql_batch);
	
			$stmt_batch->bind_param("sisddissi",$bat_id,$grn_id,$pro_id[$i],$sel_price[$i],$cost_price[$i],$pro_qty[$i],$grn_rdate,$exp_date[$i],$stat);
			if(!$stmt_batch->execute())
				echo("0,SQL Error : ".$stmt_batch->error);
			else{
				$sql_prod_upd = "UPDATE tbl_product SET prod_qty=prod_qty+? WHERE prod_id=?;";
				$stmt_prod_upd = $dbobj->prepare($sql_prod_upd);
				$stmt_prod_upd->bind_param('is',$pro_qty[$i],$pro_id[$i]);
				if(!$stmt_prod_upd->execute()){
					echo("0,SQL Error : ".$stmt_prod_upd->error);
				}
				$stmt_prod_upd->close();
			}
			$stmt_batch->close();
		}
		echo ("1,New GRN has successfully added!");
	}
	$stmt->close();
	$dbobj->close();

}
function getNewBatchId(){

	$dbobj = DB::connect();
	$sql = "SELECT bat_id FROM tbl_batch ORDER BY bat_id DESC LIMIT 1;";
	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}

	$nor = $result->num_rows;

	if($nor == 0){
		$newid = "BAT00001";
	}
	else{
		$rec = $result->fetch_assoc();
		$lastid = $rec["bat_id"];
		$num = substr($lastid, 3);
		$num++;
		$newid = "BAT".str_pad($num,5,"0",STR_PAD_LEFT);
	}

	$dbobj->close();
	return $newid;

}

?>
