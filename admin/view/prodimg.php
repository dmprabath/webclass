<?php

require("../lib/mod_grn.php");
?>
<script >
    
</script> 

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Product Management</a></li>            
  <li class="breadcrumb-item active">New Product Image	</li>
</ol>

          <!-- New employee form-->
<form enctype="multipart/form-data" id="frmproimg">
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
    </div>

    <div class="form-group row">
      <label for="imgprod" class="col-sm-2 col-form-label">Select Image</label>
      <div class="col-sm-3">
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
        <input type="file" name="imgprod" id="imgprod" class="form-control-file">
      </div>      
    </div>
    <div>
    	<button type="button" class="ml-3 col-sm-1  btn btn-primary" id="btnupload" name="btnupload" >Upload</button>
    </div>
</form>
         
<script type="text/javascript">
	$(document).ready(function(){
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

	    $("#btnupload").click(function(){
	    	var fdata = new FormData($('#frmproimg')[0]);
		    var url = "lib/mod_prod.php?type=addProdImage";

		    $.ajax({
		        type:"POST",
		        url:url,
		        data:fdata,
		        dataType:"text",
		        contentType:false,
		        cache:false,
		        processData:false,

		        success:function(result){
		         
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
	})
</script>
          
          