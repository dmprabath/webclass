<?php
require("../lib/mod_grn.php");
?>
<style type="text/css">
  .currency{
    text-align: right;
  }
</style> 
    
 

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">GRN Management</a></li>            
  <li class="breadcrumb-item active">New GRN</li>
</ol>

          <!-- New grn form-->

<form>
  <div class="form-group row">
      <label for="cmbcat" class="col-sm-2 col-form-label">GRN No</label>
      <div class="col-sm-3">
          <input type="text" name="txtgrnno" id="txtgrnno" readonly="readonly" class="form-control" value="<?php getNewGRNNo(); ?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="cmbsup" class="col-sm-2 col-form-label">Supplier</label>
      <div class="col-sm-3">
        <select class="form-control " id="cmbsup" name="cmbsup">
        	<option value="">--Select Supllier--</option>
        	<?php getSuppliers(); ?>
        
        </select>
      </div>

      <label for="txtrdate" class="col-sm-2 col-form-label">Recived Date</label>
      <div class="col-sm-2">
        <input type="text" class="form-control " id="txtrdate" name="txtrdate">
         
          
      </div>
    </div>

    <div class="form-group row">
      <label for="cmbcat" class="col-sm-2 col-form-label">Categories</label>
      <div class="col-sm-3">
        <select class="form-control " id="cmbcat" name="cmbcat">
          <option value="">--Select Category--</option>
          <?php getCategories(); ?>
        
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="cmbpro" class="col-sm-2 col-form-label">Products</label>
      <div class="col-sm-3">
        <select class="form-control " id="cmbpro" name="cmbpro">
          <option value="">--Select Products--</option>    
        
        </select>
      </div>
      <label for="txtedate" class="col-sm-2 col-form-label">Expired Date(Rs)</label>
      <div class="col-sm-2">
        <input type="text" class="form-control " id="txtedate" name="txtedate">
         </div>
    </div>
   
    <div class="form-group row">
      <label for="txtcprice" class="col-sm-2 col-form-label">Cost Price(Rs)</label>
      <div class="col-sm-2">
        <input type="text" class="form-control " id="txtcprice" name="txtcprice">
         
          
      </div>
    
      <label for="txtsprice" class="col-sm- col-form-label">Selling Price(Rs)</label>
      <div class="col-sm-2">
        <input type="text" class="form-control currency " id="txtsprice" name="txtsprice">
         
          
      </div>
      <label for="txtqty" class="col-sm-2 col-form-label">Quantity</label>
      <div class="col-sm-2">
        <input type="text" class=" form-control  " id="txtqty" name="txtqty">        
          
      </div>
    </div>
    <div class="form-group row">
      <button type="button" class="ml-3 col-sm-1 btn btn-success" id="btnadd" name="btnadd" >ADD </button>
      
    </div>

<div id="dvdetails">
<table class="table ">
  <thread>
    <tr>
      <th></th>
      <th>Product</th>
      <th>Expired Date</th>
      <th>Cost Price(Rs)</th>
      <th>Selling Price(Rs)</th>
      <th>Qty</th>
      <th>Total</th>
    </tr>
  <thread>
    <tbody id="grndetails">
      
    </tbody>
    <tfoot>
      <tr align="right">
        <th colspan="6" >Gross Total(Rs)</th>
        <td><input type="text" name="txtgtot" id="txtgtot" class="form-control-plaintext currency" readonly="readonly" size="2" value="0.00" ></td>
      </tr>
      <tr align="right">
        <th colspan="6" >Discount (%)</th>
        <td> <input type="text" size="1" class="currency form-control-plaintext" id="txtdiscount" name="txtdiscount"> </td>
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
</form>
<script type="text/javascript">
  $(document).ready(function(){
    var cdate = new Date();
    var year = cdate.getFullYear();
    var month = cdate.getMonth();
    month = parseInt(month)+1;
    if(month<10){
      month ="0"+month;
      }       

    var date = cdate.getDate();
    if(date<10){
      date = "0"+date;
    }
    $("#txtrdate").val(year+"-"+month+"-"+date);

    $("#cmbcat").change(function(){
      var cid = $(this).val();
      if(cid==""){
        $("#cmbpro").html('<option value="">--Select Products--</option>');
      }else{
        var url = "lib/mod_grn.php?type=getProducts";

      $.ajax({

          method:"POST",
          url:url,
          data:{catid:cid},
          dataType:"text",
          success:function(result){
            /*alert(result);*/
            
            if(result=="0"){
              swal("Error","There is an issue in backend module,please contect support ","error")
            }else{
              $("#cmbpro").html(result)
            }
          
        },
          error:function(eobj,etxt,err){
          console.log(etxt);
        }

      });
      }
    });

    $("#txtrdate").datepicker({
      changeMonth:true,
      changeYear:true,
      dateFormat:"yy-mm-dd",
      maxDate:"0"
    });
    $("#txtedate").datepicker({
      changeMonth:true,
      changeYear:true,
      dateFormat:"yy-mm-dd",
      minDate:"0"
    });

    $("#btnadd").click(function(){
        var prod_id = $("#cmbpro").val();
        var prod_name = $("#cmbpro option:selected").text();
        var edate = $("#txtedate").val();
        var cprice = $("#txtcprice").val();
        var sprice = $("#txtsprice").val();
        var qty = $("#txtqty").val();
        var gtot = parseFloat($("#txtgtot").val());
        var ntot = parseFloat($("#txtntot").val());

        var row ="<tr>";
         row +="<td><a href='javascript:void(0)'><i class='fa fa-times text-danger remove' aria-hidden='true'><i/></a></td>";
         
         row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+prod_name+"' name='txtpname' /><input type='hidden' value='"+prod_id+"' name='txtproid[]'/></td>";

        row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+edate+"' name='txtexpdate[]' /></td>";
        row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+cprice+"' name='txtcostprice[]' /></td>";
        row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+sprice+"' name='txtselprice[]' /></td>";
        row +="<td><input type='text' class='form-control-plaintext ' readonly='readonly' value='"+qty+"' name='txtproqty[]' /></td>";
        var total = parseFloat(cprice)*parseInt(qty);
        
        gtot = gtot+total;
        ntot = ntot+total;

        row +="<td><input type='text' class='form-control-plaintext total' readonly='readonly' value='"+total+"' name='txttot[]' /></td>";

        $("#txtgtot").val(gtot);
        $("#txtntot").val(ntot);
         row +="</tr>";

        $("#grndetails").append(row);
        resetctrl();

    });
    $("#grndetails").on("click",".remove",function(){ // after load page if click remove run function
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
    $("#btncancel").click(function(){
      $("#lnknewgrn").click();
    });
    $("#btnsave").click(function(){
      var fdata = $('form').serialize();
      var url = "lib/mod_grn.php?type=newGRN";

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
          $("#lnknewgrn").click();
        }
      },
        error:function(eobj,etxt,err){
          console.log(etxt);
      }

      });
    });
  });

function resetctrl(){
  $("#cmbcat").val("");
  $("#cmbpro").val("");
  $("#txtedate").val("");
  $("#txtcprice").val("");
  $("#txtsprice").val("");
  $("#txtqty").val("");
}


</script>
         
          
          