
<?php
@ob_start();
require_once 'library/config.php';
$msg = "";
if(isset($_POST['btn_save']) == " Save "){
	$StudentID          = $_POST['student_id'];
    $StudentFirstName   = $_POST['txt_stud_first_name'];
    $StudentSecondName  = $_POST['txt_stud_second_name'];
    $StudentAge         = $_POST['txt_stud_age'];
	if($StudentID != NULL){
		$update_query = "UPDATE student_register SET student_first_name='$StudentFirstName',student_second_name='$StudentSecondName',student_age='$StudentAge',updated_at=NOW() WHERE student_id='$StudentID'";
		$update_sql1 = pg_query($update_query); 
		if($update_sql1 == true){
			$msg = "Student Details Updated Successfully..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}
	else{
		$insert_query = "INSERT INTO student_register (student_first_name, student_second_name, student_age, active, created_at) VALUES ('$StudentFirstName', '$StudentSecondName', '$StudentAge', 1, NOW())";
		$insert_sql1  = pg_query($insert_query);  //INSERT QUERY //
		if($insert_sql1 == true){
			$msg = "Student Details Successfully Saved..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}

}
if(isset($_GET['id'])){
	$StudentID = $_GET['id'];
	$SelectQuery = "SELECT * FROM student_register WHERE student_id='$StudentID'";
	$StudentDetailsQuery = pg_query($SelectQuery);
	if($StudentDetailsQuery != NULL){
		if(pg_num_rows($StudentDetailsQuery)>0){
			$List = pg_fetch_assoc($StudentDetailsQuery);
			$StudentFirstNameByID    = $List['student_first_name'];
    		$StudentSecondNameByID   = $List['student_second_name'];
    		$StudentAgeByID          = $List['student_age'];
		}
	}
}

?>
<link rel="stylesheet" href="dashboard/MyView/bootstrap.min.css">
<?php include "Header.html"; ?>
<script src="dashboard/MyView/bootstrap.min.js"></script>
<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
	function BtnView(){
		url = "StudentRegisterView.php";
		window.location.replace(url);
	}
	
</script>
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form" id="form1">
            <?php include "Menu.php"; ?>
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title">Student Register Create</div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1 stable" style="overflow:auto">
							<div class="row">
								<div class="box-container box-container-lg" align="center">
								<div class="div1">&nbsp;</div>
									<div class="div10">
										<div class="card cabox">
											<div class="face-static">
												<div class="card-header inkblue-card" align="center">Student Register</div>
									            <div class="card-body padding-1 ChartCard" id="CourseChart">
									            	<div class="divrowbox  pt-2">
									            		<div class="row smclearrow"></div>                                                                             											
									            		<div class="div3 lboxlabel">First Name </div>	
                                                        <div class="div9"><input type="text" name="txt_stud_first_name" id="txt_stud_first_name" maxlength="150" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $StudentFirstNameByID; } ?>" style="width:500px"></div>
									            		<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Second Name   </div>											
									            		<div class="div9"><input type="text" name="txt_stud_second_name" id="txt_stud_second_name" maxlength="10" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $StudentSecondNameByID; } ?>" style="width:500px"></div>
									            		<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Age </div>											
									            		<div class="div9"><input type="text" name="txt_stud_age" id="txt_stud_age" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $StudentAgeByID; } ?>" style="width:500px" ></div>																																																					
									            		<div class="row smclearrow"></div>
														<input type="hidden" name="student_id" id="student_id" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $StudentID; } ?>" style="width:500px" >
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
							window.location.replace('CementGradeType.php');
						}
					}]
				});
			}
		};
		var KillEvent = 0;
		$("body").on("click","#btn_save", function(event){
			if(KillEvent == 0){
				var StudentFirstName  = $('#txt_stud_first_name').val();
				var StudentSecondName = $('#txt_stud_second_name').val();
				var StudentAge        = $('#txt_stud_age').val();
				if(StudentFirstName == ""){
					BootstrapDialog.alert("Error: Student First Name should not be in empty...!");
					event.preventDefault();
					event.returnValue = false;
				}else if(StudentSecondName == ""){
					BootstrapDialog.alert("Error: Student Second Name should not be in empty...!");
					event.preventDefault();
					event.returnValue = false;
				}else if(StudentAge == ""){
					BootstrapDialog.alert("Error: Student Age Name should not be in empty...!");
					event.preventDefault();
					event.returnValue = false;
				}else{
					event.preventDefault();
					BootstrapDialog.show({
						title: 'Confirmation Message',
						message: 'Are you sure want to save Student Register?',
						closable: false, 				// <-- Default value is false,
						draggable: false, 				// <-- Default value is false,
						buttons: [
							{
								label: 'Ok',
								cssClass: 'btn-primary',
								action: function(dialog) {
									dialog.close();
									KillEvent = 1;
									$("#btn_save").trigger( "click" );
								}
							},
							{
								label: 'Cancel',
								cssClass: 'btn-secondary',
								action: function(dialog) {
									dialog.close();
									KillEvent = 0;
								}
							}
						]
					});
				}
			}
		});
	});
</script>

