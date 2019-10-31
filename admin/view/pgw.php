<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src='../../scripts/jquery-3.3.1.min.js'></script>
</head>
<body>
	<h1>Payment Gateway</h1>
	<form>
		<table>
			<tr>
				<td>Card No</td>
				<td><input type="text" name="txtcno" id="txtcno" size="16" maxlength="16"></td>
			</tr>
			<tr>
				<td>Card Type</td>
				<td>
				<input type="radio" name="optctype" id="optmaster" value="1">
				<label for="optmaster"><img src="../../images/card_sm_masterc.gif"></label>

				<input type="radio" name="optctype" id="optvisa" value="2">
				<label for="optvisa"><img src="../../images/card_sm_visa.gif"></label>
				</td>
			</tr>

			<tr>
				<td>Expiery</td>
				<td><input type="text" name="txtmonth" id="txtmonth" size="2" maxlength="2"> / <input type="text" name="txtyear" id="txtyear" size="2" maxlength="2">
				<label>mm/yy</label>
				</td>
			</tr>
			<tr>
				<td>Security No</td>
				<td><input type="text" name="txtcvc" id="txtcvc" size="3" maxlength="3"> 
				</td>
			</tr>
			<tr>
				<td>Amount</td>
				<td>LKR. <span id="spamt"></span> 
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="button" name="btnpay" id="btnpay" value="PAY"></td>
				
			</tr>
		</table>
	</form>

</body>

<script type="text/javascript">
	$(document).ready(function(){
		var invid = sessionStorage.getItem("invid");
		var amount = sessionStorage.getItem("amt");

		$("#spamt").html(amount);

		$("#txtcno").keyup(function(){
			var cno = $(this).val();
			if(cno !==""){
				var fd = cno.substring(0,1);
				if(fd=="4"){
					$("#optvisa").prop("checked",true);
				}else if(fd=="5"){
					$("#optmaster").prop("checked",true);
				}else{
					$("#optvisa").prop("checked",false);
					$("#optmaster").prop("checked",false);
			
				}
			}else{
				$("#optvisa").prop("checked",false);
				$("#optmaster").prop("checked",false);
			}
		});

		$("#btnpay").click(function(){
			var cno = $("#txtcno").val();
			var month = $("#txtmonth").val();
			var year = $("#txtyear").val();
			var cvc = $("#txtcvc").val();

			var invid = sessionStorage.getItem("invid");
			var amount = sessionStorage.getItem("amt");

			var cpattern = /^[4-5]{1}[\d]{15}$/;

			if(!cno.match(cpattern)){
				alert("Invalied Card No");
				return;
			}

			var mopattern = /^[0-1]{1}[\d]{1}$/;
			if(!month.match(mopattern)){
				alert("Invalied Month");
				return;
			}
			month =parseInt(month);
			if((month<1)|| month>12){
				alert("Invalied Month");
			}

			var cdate = new Date();
			var cyear = cdate.getFullYear();
			var cmonth = cdate.getMonth()+1;
			year = parseInt("20"+year);
			if(year<cyear){
				alert("Invalied Year");
				return;
			}

			if((year==cyear) && (month<cmonth)){
				alert("Invalied Expiry date");
				return;
			}

			var cvcpattern = /^[\d]{3}$/;
			if(!cvc.match(cvcpattern)){
				alert("invid CVC No");
				return;
			}

		});
	});
</script>
</html>