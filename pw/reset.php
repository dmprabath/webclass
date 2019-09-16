<script type="text/javascript" src="../scripts/sweetalert.min.js"></script>

<?php
if(isset($_GET["t"])){
	$ptime = $_GET["t"];

	$ctime =time(); // to get current time

	$diff = $ctime - $ptime; /// to get differnce of time durations

	if($diff>86400){
		echo ("invalied link , Please contact administrator");
	}else{
		//echo ("valied link");

?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Password reset</title>
	</head>
	<body>
		<h1>Password reset form</h1>
		<script type="text/javascript " src="../scripts/jquery-3.3.1.min.js">		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#btnsave").click(function(){
					var cpass = $("#txtcpass").val();
					var pass = $("#txtpass").val();
					var pass1 = $("#txtpass1").val();

					if(cpass=="" || pass =="" || pass1==""){
						alert("Please fill everything");
						return;
					}else if(pass!=pass1){
						alert("Password and Confirm passwords does not match, Please try again");
						return;
					}

					var url = location.href;
					var pos1 = url.indexOf("=");
					var pos2 = url.indexOf("&");
					var uname = url.substring(pos1+1,pos2);
					$.ajax({
						method:"POST",
						url:"mod_pw_reset.php",
						data:{uname:uname,cpass:cpass,pass:pass},
						dataType:"text",
						success:function(result){
							/*alert(result);*/
							var res = result.split(","); // split to break array or somthing using ,
							if(res[0] == "0"){
								alert(res[1]);
							}else if(res[0]=="1"){
								alert(res[1]);
								location.href="../admin/index.php";
							}
						},
						error:function(eobj,etxt,err){
							console.log(etxt);
						}

					});
				});

				$("#txtpass").blur(function(){
					var pass = $(this).val();
					var rule = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;  //reguler Expressions Miimum 6 maximum any
					//

					if(!pass.match(rule)){
						$(this).css("border","3px solid red");
						$(this).focus();
					}else{
						$(this).css("border","");
					}
				});
			});
		</script>



		<form method="post">
			<table>
				<tr>
					<td>Current Password</td>
					<td><input type="password" name="txtcpass" id="txtcpass"></td>
				</tr>
				<tr>
					<td>New Password</td>
					<td><input type="password" name="txtpass" id="txtpass" hint="enter password"></td>
				</tr>
				<tr>
					<td>Confirm New Password</td>
					<td><input type="password" name="txtpass1" id="txtpass1"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="button" id="btnsave"  name="" value="Save">
					</td>
				
				</tr>
			</table>
		</form>
	</body>
	</html>
<?php
	}
}
?>