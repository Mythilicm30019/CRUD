<?php
@ob_start();
require_once 'library/config.php';
$msg = "";
if(isset($_POST['btn_save']) == " Save "){
	$employeeID          = $_POST['employee_id'];
    $employeeFirstName   = $_POST['txt_employee_first_name'];
    $employeeSecondName  = $_POST['txt_employee_second_name'];
    $employeeAge         = $_POST['txt_employee_age'];
	$employeegender      = $_POST['txt_employee_gen'];
	$employeeEducation   = $_POST['txt_employee_edu'];
	$SaveEmployeeEducation = implode(',',$employeeEducation);
//	print_r ($employeeEducation);
	//echo($SaveEmployeeEducation);exit;

	

	if($employeeID != NULL){
		$update_query = "UPDATE employee_register SET employee_first_name='$employeeFirstName',employee_second_name='$employeeSecondName',employee_age='$employeeAge',employee_gender='$employeegender',employee_education='$SaveEmployeeEducation',updated_at=NOW() WHERE employee_id='$employeeID'";
		$update_sql1 = pg_query($update_query); 
		if($update_sql1 == true){
			$msg = "employee Details Updated Successfully..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}
	else{
		$insert_query = "INSERT INTO employee_register (employee_first_name, employee_second_name, employee_age,employee_gender,employee_education, active, created_at) VALUES ('$employeeFirstName', '$employeeSecondName', '$employeeAge','$employeegender','$SaveEmployeeEducation', 1, NOW())";
       // echo($insert_query); 
		$insert_sql1  = pg_query($insert_query);  //INSERT QUERY //
		if($insert_sql1 == true){
			$msg = "employeeDetails Successfully Saved..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}

}
$GetEmployeeEducationArray ='';
if(isset($_GET['id'])){
	$employeeID  = $_GET['id'];
	$SelectQuery = "SELECT * FROM employee_register WHERE employee_id='$employeeID'";
	$employeeDetailsQuery = pg_query($SelectQuery);
	if($employeeDetailsQuery != NULL){
		if(pg_num_rows($employeeDetailsQuery)>0){
			$List = pg_fetch_assoc($employeeDetailsQuery);
			$employeeFirstNameByID    = $List['employee_first_name'];
    		$employeeSecondNameByID   = $List['employee_second_name'];
    		$employeeAgeByID          = $List['employee_age'];
			$employeeGenderByID       = $List['employee_gender'];
			$employeeEducationByID    = $List['employee_education'];
			$GetEmployeeEducationArray  = explode(',',$employeeEducationByID);
		}

	}
}
// echo($employeeGenderByID);
?>
<link rel="stylesheet" href="dashboard/MyView/bootstrap.min.css">
<?php include "Header.html"; ?>
<script src="dashboard/MyView/bootstrap.min.js"></script>
<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
	function BtnView(){
		url = "EmployeeRegisterView.php";
		window.location.replace(url);
	}
	
</script>
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form" id="form1">
            <?php include "Menu.php"; ?>
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title">Employee Register Create</div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1 stable" style="overflow:auto">
							<div class="row">
								<div class="box-container box-container-lg" align="center">
								<div class="div1">&nbsp;</div>
									<div class="div10">
										<div class="card cabox">
											<div class="face-static">
												<div class="card-header inkblue-card" align="center">Employee Register</div>
									            <div class="card-body padding-1 ChartCard" id="CourseChart">
									            	<div class="divrowbox  pt-2">
									            		<div class="row smclearrow"></div>                                                                             											
									            		<div class="div3 lboxlabel">First Name </div>	
                                                        <div class="div9"><input type="text" name="txt_employee_first_name" id="txt_employee_first_name" maxlength="150" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $employeeFirstNameByID; } ?>" style="width:500px"></div>
									            		<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Second Name   </div>											
									            		<div class="div9"><input type="text" name="txt_employee_second_name" id="txt_employee_second_name" maxlength="10" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $employeeSecondNameByID; } ?>" style="width:500px"></div>
									            		<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Age </div>											
									            		<div class="div9"><input type="text" name="txt_employee_age" id="txtemployee_age" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $employeeAgeByID; } ?>" style="width:500px" ></div>																																																					
									            		<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Gender </div>	
														<div class="div9">
															Male<input type="radio"name="txt_employee_gen" id="gender_male"value="MALE"<?php if (isset($_GET['id']) && $employeeGenderByID == "MALE") echo "checked"; ?>>
   															Female<input type="radio" name="txt_employee_gen"  id="gender_female"value="FEMALE"<?php if (isset($_GET['id']) && $employeeGenderByID == "FEMALE") echo "checked"; ?>>
														</div>	
														<div class="div3 lboxlabel">Education</div>	
														<div class="div9">
															10th<input type="checkbox"name="txt_employee_edu[]" id="edu_10"value="10th"<?php if (isset($_GET['id']) && in_array('10th', $GetEmployeeEducationArray)) echo "checked"; ?>  >
   															12th<input type="checkbox" name="txt_employee_edu[]"id="edu_12"value="12th"<?php if (isset($_GET['id']) && in_array('12th', $GetEmployeeEducationArray)) echo "checked"; ?>>
															UG<input type="checkbox" name="txt_employee_edu[]"  id="edu_UG"value="UG"<?php if (isset($_GET['id']) && in_array('UG', $GetEmployeeEducationArray)) echo "checked"; ?>>
															PG<input type="checkbox" name="txt_employee_edu[]"  id="edu_PG"value="PG"<?php if (isset($_GET['id']) && in_array('PG', $GetEmployeeEducationArray)) echo "checked"; ?>>
														</div>									
									            		<!-- <div class="div9">Male<input type="radio" name="txt_employee_gen" id="gender_male"  value="MALE"<?php if (isset($_GET['id']) && $employeeGenderByID == "MALE") echo "checked"; ?>>Female<input type="radio" name="txt_employee_gen" id="gender_female" maxlength="25" class="tboxclass alphanumeric" value="FEMALE" <?php if (isset($_GET['id']) && $employeeGenderByID == "FEMALE") echo "checked"; ?> style="width:500px"></div>											 -->
														<div class="row smclearrow"></div>
														<input type="hidden" name="employee_id" id="employee_id" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $employeeID; } ?>" style="width:500px" >
									            		<div class="row smclearrow"></div>
															<div class="div12" align="center">
																<input type="button" class="btn btn-info" name="back" id="back" value="Back" />
																<input type="submit" class="btn btn-info" name="btn_save" id="btn_save" value="  Save " />
																<input type="button" class="btn btn-info" name="view" id="view" value="View" onClick="BtnView();"/>
															</div>
									            		</div>
									            	</div>
									            </div>										
											</div>
										</div>
									</div>
									<div class="div1">&nbsp;</div>
								</div>
							</div>
						</blockquote>
					</div>
				</div>
			</div>
            <!--==============================footer=================================-->
           <?php   include "footer/footer.html"; ?>
            <script src="js/jquery.hoverdir.js"></script>
        </form>
    </body>
</html>

<script>
    $(document).ready(function() {
		var msg = "<?php echo $msg; ?>";
		document.querySelector('#top').onload = function(){
		if(msg != ""){
				BootstrapDialog.show({
					message: msg,
					buttons: [{
						label: ' OK ',
						action: function(dialog) {
							dialog.close();
							window.location.replace('EmployeeRegister.php');
						}
					}]
				});
			}
		};
	});

	
</script>

