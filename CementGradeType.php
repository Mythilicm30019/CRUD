<?php
@ob_start();
require_once 'library/config.php';

if(isset($_POST['btn_save']) == " Save "){
	$CementGradeID          = $_POST['cement_grade_id'];
    $CementGradeDesc        = $_POST['descrip_cement_grade'];
    $CementGradeCode        = $_POST['code_cement_grade'];
    $CementGradeCoefficient = $_POST['coefficient_cement_grade'];
	if($CementGradeID != NULL){
		$update_query = "UPDATE cement_grade_type SET cement_type_desc='$CementGradeDesc',cement_type_code='$CementGradeCode',coefficient='$CementGradeCoefficient',updated_at=NOW() WHERE cemtypeid='$CementGradeID'";
		$update_sql1 = pg_query($update_query);
		if($update_sql1 == true){
			$msg = "Cement Grade Type Updated Successfully..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}
	else{
		$insert_query = "INSERT INTO cement_grade_type (cement_type_desc, cement_type_code, coefficient, active, created_at) VALUES ('$CementGradeDesc', '$CementGradeCode', '$CementGradeCoefficient', 1, NOW())";
		$insert_sql1  = pg_query($insert_query);
		if($insert_sql1 == true){
			$msg = "Cement Grade Type Successfully Saved..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}

}
if(isset($_GET['id'])){
	$CemantGradeID = $_GET['id'];
	$SelectQuery = "SELECT * FROM cement_grade_type WHERE cemtypeid='$CemantGradeID'";
	$CemantGradeQuery = pg_query($SelectQuery);
	if($CemantGradeQuery != NULL){
		if(pg_num_rows($CemantGradeQuery)>0){
			$List = pg_fetch_assoc($CemantGradeQuery);
			$CemantGradeDescByID    = $List['cement_type_desc'];
    		$CemantGradeCodeByID    = $List['cement_type_code'];
    		$CemantGradeCoefficient = $List['coefficient'];
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
		url = "CementGradeTypeView.php";
		window.location.replace(url);
	}
	
</script>
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form" id="form1">
            <?php include "Menu.php"; ?>
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title">Cement Grade Create</div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1 stable" style="overflow:auto">
							<div class="row">
								<div class="box-container box-container-lg" align="center">
								<div class="div1">&nbsp;</div>
									<div class="div10">
										<div class="card cabox">
											<div class="face-static">
												<div class="card-header inkblue-card" align="center">Cement Grade Type</div>
									            <div class="card-body padding-1 ChartCard" id="CourseChart">
									            	<div class="divrowbox  pt-2">
									            		<div class="row smclearrow"></div>                                                                             											
									            		<div class="div3 lboxlabel">Description </div>	
                                                        <div class="div9"><input type="text" name="descrip_cement_grade" id="descrip_cement_grade" maxlength="150" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $CemantGradeDescByID; } ?>" style="width:500px"></div>
									            		<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Code  </div>											
									            		<div class="div9"><input type="text" name="code_cement_grade" id="code_cement_grade" maxlength="10" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $CemantGradeCodeByID; } ?>" style="width:500px"></div>
									            		<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Coefficient </div>											
									            		<div class="div9"><input type="text" name="coefficient_cement_grade" id="coefficient_cement_grade" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $CemantGradeCoefficient; } ?>" style="width:500px" ></div>																																																					
									            		<div class="row smclearrow"></div>
														<input type="hidden" name="cement_grade_id" id="cement_grade_id" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $CemantGradeID; } ?>" style="width:500px" >
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
		$("#txt_mat_type").chosen();
	});
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
	$("body").on("click","#btn_save", function(event){
			var Description = $('#descrip_cement_grade').val();
			var Code = $('#code_cement_grade').val();
			var Coefficient = $('#coefficient_cement_grade').val();

			if(Description == ""){
				BootstrapDialog.alert("Please select the Description!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Code == ""){
				BootstrapDialog.alert("Please Enter the Code!");
				event.preventDefault();
				event.returnValue = false;
			}else if(Coefficient == ""){
				BootstrapDialog.alert("Please Enter the Coefficient!");
				event.preventDefault();
				event.returnValue = false;
			}
	});

</script>

