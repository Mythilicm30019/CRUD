<?php
@ob_start();
require_once 'library/config.php';

if(isset($_POST['btn_save']) == " Save "){
	$DistId         = $_POST['dist_id'];
    $DistName        = $_POST['txt_dist_name'];
    $DistCode       = $_POST['txt_dist_code'];
	$StateID          = $_POST['txt_cont_state'];
	echo($StateID);

   // $CementGradeCoefficient = $_POST['coefficient_cement_grade'];
	if($DistId!= NULL){
		$update_query = "UPDATE district_master SET par_id='$StateID',dist_name='$DistName',dist_code='$DistCode',updated_at=NOW() WHERE dist_id='$DistId'";
		$update_sql1 = pg_query($update_query);
		if($update_sql1 == true){
			$msg = "District_master Updated Successfully..!!";
		}else{
			$msg = "Kindly try again..!!";
		}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
	}
	else{
		$insert_query = "INSERT INTO district_master (par_id,dist_name,dist_code,active) VALUES ('$StateID','$DistName', '$DistCode', 1)";
		$insert_sql1  = pg_query($insert_query);
		if($insert_sql1 == true){
			$msg = "District_master Successfully Saved..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}

}
if(isset($_GET['id'])){
	$CemantGradeID = $_GET['id'];
	$SelectQuery = "SELECT * FROM district_master WHERE dist_id='$DistId'";
	$CemantGradeQuery = pg_query($SelectQuery);
	if($CemantGradeQuery != NULL){
		if(pg_num_rows($CemantGradeQuery)>0){
			$List = pg_fetch_assoc($CemantGradeQuery);
			$DistrictNameByID    = $List['dist_name'];
    		$DistrictCodeByID    = $List['dist_code'];
			$DistrictCodeByID    = $List['dist_code'];

    		
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
		url = "DistrictView.php";
		window.location.replace(url);
	}
	
</script>
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form" id="form1">
            <?php include "Menu.php"; ?>
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title">District Create</div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1 stable" style="overflow:auto">
							<div class="row">
								<div class="box-container box-container-lg" align="center">
								<div class="div1">&nbsp;</div>
									<div class="div10">
										<div class="card cabox">
											<div class="face-static">
												<div class="card-header inkblue-card" align="center">District</div>
									            <div class="card-body padding-1 ChartCard" id="CourseChart">
									            	<div class="divrowbox  pt-2">
									            		<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">State Name </div>											
									            		<div class="div9">
															<select name="txt_cont_state" id="txt_cont_state" maxlength="10" class="tboxclass alphanumeric"  style="width:500px">
																<option value="">----Select ----</option>
																<?php
																 $ContractorData="SELECT * from state_master where active='1'";
																 echo ($ContractorData);
                                                                 $ContractorDatasql = pg_query($ContractorData);
																 while($row=pg_fetch_assoc($ContractorDatasql))
																 {
																	$selected=($row['state_id']==$selected_state_id)? "selected":"";
																     echo "<option value='" . $row['state_id'] . "' $selected>" . $row['state_description'] . "</option>";
																 }
																?>
															</select>
														</div>
														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Dist Name </div>											
									            		<div class="div9"><input type="text" name="txt_dist_name" id="txt_dist_name" maxlength="10" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $StateCodeByID; } ?>" style="width:500px"></div>
														
														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Code </div>											
									            		<div class="div9"><input type="text" name="txt_dist_code" id="txt_dist_code" maxlength="10" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $StateCodeByID; } ?>" style="width:500px"></div>
									            		<div class="row smclearrow"></div>
									            		<!-- <div class="div3 lboxlabel">Coefficient </div>											
									            		<div class="div9"><input type="text" name="coefficient_cement_grade" id="coefficient_cement_grade" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $CemantGradeCoefficient; } ?>" style="width:500px" ></div>	 -->																																																				
									            		<div class="row smclearrow"></div>
														<input type="hidden" name="state_id" id="state_id" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $StateID; } ?>" style="width:500px" >
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
						window.location.replace('StateMaster.php');
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

