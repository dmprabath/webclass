<?php 
require_once("dbconnection.php");

if(isset($_GET["type"])){ 
	$type = $_GET["type"];
	$type();
}


function addProdImage(){
	$cat_id = $_POST['cmbcat'];
	$pro_id = $_POST['cmbpro'];

	$img_name = $_FILES['imgprod']['name'];
	$img_size = $_FILES['imgprod']['size'];
	$img_type = $_FILES['imgprod']['type'];
	$img_tmp_name = $_FILES['imgprod']['tmp_name'];
	#substr display part after specific point
	#strrpos - finds the position numbers of the last occurrence
	$ext = substr($img_name, strrpos($img_name, "."));
	# $ext is file extenstion
	# convert to lower case
	$txt = strtolower($ext);

	if($img_name== ""){
		echo (",Please Select the image");
		exit;
	}
	if($img_size>2097152 || $img_size==0){
		echo("0,Image size must be less than 2MB");
		exit;
	}
	if($ext!=".jpg" && $ext!=".png" && $ext!=".gif"){
		echo("0,Image file size should be either jpg png or gif");
		exit;
	}
	$cat_path = "../../images/$cat_id";
	$pro_path = "../../images/$cat_id/$pro_id";
	if(!file_exists($cat_path)){
		mkdir($cat_path);
	}
	if(!file_exists($pro_path)){
		mkdir($pro_path);
	}
	 
	 $fname = $cat_id."_".$pro_id."_".time().$ext;
	 $fpath = $pro_path."/".$fname;

	 if(move_uploaded_file($img_tmp_name, $fpath)){
	 	$dbobj = DB::connect();
	 	$sql = "INSERT INTO tbl_pro_images(cat_id,pro_id,img_name,img_status) VALUES(?,?,?,?);";
	 	$status = "1";
	 	$stmt = $dbobj->prepare($sql);
	 	$stmt->bind_param("sssi",$cat_id,$pro_id,$fname,$status);
	 	if(!$stmt->execute()){
	 		unlink($fpath);
	 		echo("0,SQL Error, Please try again:".$stmt->error);
	 	}else{
	 		echo ("1,Succesfully Saved!");
	 	}
	 	$stmt->close();
	 	$dbobj->close();
	 }else{
	 	echo("0,Image Uploarding Error");
	 }
}

?>