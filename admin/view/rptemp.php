<?php
/*require("../lib/mod_emp.php");*/
?>
<script >
    
</script> 

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Reports Management</a></li>            
  <li class="breadcrumb-item active"> Employee Reports</li>
</ol>

          <!-- New employee form-->
<button type="button" class="btn btn-primary" id="btnallemp" >GET ALL EMPLOYEE</button>

<script type="text/javascript">
	$(document).ready(function(){
		$("#btnallemp").click(function(){
			window.open("reports/rep_all_employees.php");
		});
	});
</script>
         
          
          