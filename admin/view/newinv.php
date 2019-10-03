<?php
require("../lib/mod_inv.php");
require("../lib/mod_common.php")
?>
<script >
    
</script> 

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Invoice Management</a></li>            
  <li class="breadcrumb-item active">New Invoice</li>
</ol>


<div class="form-group row">
      <label for="cmbcat" class="col col-sm-2 col-form-label">Invoice ID</label>
      <div class="col-sm-3">
          <input type="text" name="txtinvno" id="txtinvno" readonly="readonly" class="form-control" value="<?php getNewINVNo(); ?>">
      </div>

      <label for="txtrdate" class="col-sm-1 col-form-label">Date</label>
      <div class="col-sm-2">
        <input type="text" class="form-control "  id="txtdate" name="txtdate" value="<?php echo(getCurrentDate())  ?>">    
      </div>

</div>
<div class="form-group row">
      <label for="txtproid" class="col-sm-2 col-form-label">Product ID</label>
      <div class="col-sm-3">
          <input type="text" name="txtproid" id="txtproid" class="form-control" >
      </div>

      <label for="txtproid" class="col-sm-1 col-form-label">Name</label>
      <div class="col-sm-3">
          <input type="text" name="txtproname" id="txtproname" class="form-control" readonly>
          
      </div>
      <label for="txtproid" class="col-sm-1 col-form-label">Availabilty</label>
      <div class="col-sm-1">
          <input type="text" name="txteqty" id="txteqty" class="form-control" readonly  >
      </div>
</div>

<div class="form-group row">
      <label for="cmbcat" class="col col-sm-2 col-form-label">Units</label>
      <div class="col-sm-2">
          <input type="number" name="txtqty" id="txtqty"  class="form-control" value="1" min="1" >
      </div>
 </div>
<div class="form-group row">
      <button type="button" class="ml-3 col-sm-1 btn btn-primary" id="btnadd" name="btnadd" >ADD </button>
      
</div>

<div id="dvdetails">
	<table class="table ">
	  <thread>
	    <tr>
	      <th></th>
	      <th>Product ID</th>
	      <th>Batcht ID</th>
	      <th>Product Name</th>	      
	      <th>Price(Rs)</th>
	      <th>Qty</th>
	      <th>Total</th>
	    </tr>
	  <thread>
	    <tbody id="invdetails">
	      
	    </tbody>
	    <tfoot>
	      <tr align="right">
	        <th colspan="6" >Gross Total(Rs)</th>
	        <td><input type="text" name="txtgtot" id="txtgtot" class="form-control-plaintext currency" readonly="readonly" size="2" value="0.00" ></td>
	      </tr>
	      <tr align="right">
	        <th colspan="6" >Discount (%)</th>
	        <td> <input type="text" size="1" class="currency form-control" id="txtdiscount" value="0" name="txtdiscount"> </td>
	      </tr>
	      <tr align="right">
	        <th colspan="6" >Net Total(Rs)</th>
	        <td><input type="text" name="txtntot" id="txtntot" class="form-control-plaintext currency" readonly="readonly" size="2" value="0.00 "></td>
	      </tr>
	      <tr>
	        <td colspan="7">
	          <button type="button" class=" col-sm-1 btn btn-success" id="btnsave" name="btnsave" >Save </button>
	          <button type="button" class=" col-sm-1 btn btn-danger" id="btncancel" name="btncancel" >Cancel </button>
	        </td>
	      </tr>
	    </tfoot>
	</table> 
  
</div>
         


 <script type="text/javascript">

 	$(document).ready(function(){
 		$("#txtdate").datepicker({
      		changeMonth:true,
      		changeYear:true,
      		dateFormat:"yy-mm-dd",
      		maxDate:"0"
    	});

 		$("#txtproid").keypress(function(e){
      		if(e.which==13){
        		if($(this).val()==""){
          			swal("Error","Please enter a product id","error");
        		}else{
         		 var pid = $(this).val();
          		var url = "lib/mod_inv.php?type=getProductDetails";

	      		$.ajax({

		          method:"POST",
		          url:url,
		          data:{prodid:pid},
		          dataType:"text",
		          success:function(result){
		           
		            res = result.split(",");
		            
		            if(res[0]=="0"){
		              swal("Error",res[1],"error");
		            }else if(res[0]=="1"){
		            	$("#txtproname").val(res[1]);
		            	$("#txteqty").val(res[2]);
		              
		            }
		          
		        	},
		          error:function(eobj,etxt,err){
		          console.log(etxt);
	        		}
        		});
	      	}
	      }
       });

 		$("#btnadd").click(function(){
 			var pid = $("#txtproid").val();
 			var avail = parseInt($("#txteqty").val());
 			var rqty = parseInt($("#txtqty").val());

 			if(rqty>avail){
 				swal("Error","Availabilty less than required quantiy","error");
 				return;
 			}
 			var url = "lib/mod_inv.php?type=getBatchDetails";
 			$.ajax({

		        method:"POST",
		        url:url,
		        data:{prodid:pid,rqty:rqty},
		        dataType:"json",
		        success:function(result){
		           for(i=0; i<result.length; i++){
		           	 var pid = result[i][0];
		           	 var bid = result[i][1];
		           	 var pname = result[i][2];
		           	 var sprice = parseFloat(result[i][3]);
		           	 var qty = parseFloat(result[i][4]);
		           	 var total = sprice * qty;
		           	 var gtot = parseFloat($("#txtgtot").val());
		           	 var ntot = parseFloat($("#txtntot").val());

		           	 var row ="<tr>";
         				row +="<td><a href='javascript:void(0)'><i class='fa fa-times text-danger remove' aria-hidden='true'><i/></a></td>";

         				row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+pid+"' name='txtipid[]' /></td>";

         				row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+bid+"' name='txtibid[]' /></td>";

         				row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+pname+"' name='txtipname[]' /></td>";

         				row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+sprice+"' name='txtisprice[]' /></td>";

         				row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+qty+"' name='txtiqty[]' /></td>";

         				row +="<td><input type='text' class='form-control-plaintext text-right total ' readonly='readonly' value='"+total+"' name='txtitotal[]' /></td>";

         				row += "</tr>";

         				gtot = gtot + total;
         				ntot = ntot + total;
         				$("#txtgtot").val(gtot);
         				$("#txtntot").val(ntot);

         				$("#invdetails").append(row);
         				resetctrl();


		           }
		          
		      	},
			        error:function(eobj,etxt,err){
			        console.log(etxt);
	       		}
        	});
 		});

	 	$("#txtdiscount").keypress(function(e){
	      if(e.which==13){
	        if($(this).val()==""){
	          $("#txtntot").val($("#txtgtot").val());
	        }else{
	          var discount = parseFloat($(this).val());
	          var gtot = parseFloat($("#txtgtot").val());
	          var ntot = gtot - (gtot*discount/100);
	          $("#txtntot").val(ntot);
	        }
	        
	        $(this).prop("readonly","readonly");
	      		}
	    	});
		    $("#txtdiscount").dblclick(function(e){
		      $(this).prop("readonly","");
	    	});


	    	$("#invdetails").on("click",".remove",function(){ // after load page if click remove run function
       // $(this).parents("tr").remove();
		       var total =parseFloat($(this).parents("tr").find(".total").val());
		       var gtot = parseFloat($("#txtgtot").val());
		        var ntot = parseFloat($("#txtntot").val());

		        gtot = gtot-total;
		        $("#txtdiscount").prop("readonly","");
		        $("#txtdiscount").val("");
		        ntot = gtot;

		        $("#txtgtot").val(gtot);
		        $("#txtntot").val(ntot);

		        $(this).parents("tr").remove();
   			 });

	    	$("#btnsave").click(function(){
		      var fdata = $('form').serialize();
		      var url = "lib/mod_inv.php?type=newInvoice";

		      $.ajax({
		        method:"POST",
		        url:url,
		        data:fdata,
		        dataType:"text",
		        success:function(result){
		         // alert(result);
		        res = result.split(",");
		        if(res[0]=="0"){
		          swal("Error",res[1],"error")
		        }
		        else if(res[0]=="1"){
		          swal("Success",res[1],"success");
		          $("#lnknewinv").click();
		        }
		      },
		        error:function(eobj,etxt,err){
		          console.log(etxt);
      			}

     		 	});
    		});

    
 	});

 		
 	function resetctrl(){
	  $("#txtproid").val("");
	  $("#txtproname").val("");
	  $("#txteqty").val("");
	  $("#txtqty").val("1");
	  
}
 </script>        
          
          