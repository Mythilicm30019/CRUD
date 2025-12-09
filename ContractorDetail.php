<?php
@ob_start();
require_once 'library/config.php';
$msg = "";
if(isset($_POST['btn_save']) == "Save"){
	$ContractorID          = $_POST['cont_id'];
	$ContractorName  = $_POST['txt_cont_name'];
    $ContractorGender  = $_POST['txt_cont_gen'];
	$ContractorMobileNo = $_POST['txt_cont_mbno'];
	$ContractorMailId  = $_POST['txt_cont_mail'];
	$ContractorAddress  = $_POST['txt_cont_addr'];
	$ContractorGST  = $_POST['txt_cont_GST'];
	$ContractorPANNo = $_POST['txt_cont_panno'];
	$ContractorType = $_POST['txt_cont_type'];
    $SaveContractorType = implode(',',$ContractorType);
	$ContractorExperienceLevel = $_POST['txt_exp_level'];
	// echo($_POST['txt_exp_level']);exit;
	$ContractorworkType = $_POST['txt_work_type'];
	$ContractorState = $_POST['txt_cont_state'];
	$ContractorIDProof = $_POST['txt_id_proof'];
    $SaveContractorIDProof = implode(',',$ContractorIDProof);
	$StateID          = $_POST['txt_cont_state'];
	
	if($ContractorID != NULL){
        $update_query = "UPDATE contractor_detail SET cont_name='$ContractorName',cont_gender='$ContractorGender', cont_mobileno='$ContractorMobileNo', cont_mailid='$ContractorMailId', cont_address='$ContractorAddress', cont_gst='$ContractorGST', cont_panno='$ContractorPANNo', Cont_type='$SaveContractorType', experiance_level='$ContractorExperienceLevel', work_type='$ContractorworkType',cont_state='$ContractorState', id_proof='$SaveContractorIDProof',state_id='$StateID ', WHERE cont_id='$ContractorID'";
		$update_sql1 = pg_query($update_query); 
		if($update_sql1 == true){
			$msg = "Contactor Details Updated Successfully..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}
	else{
		$insert_query = "INSERT INTO contractor_detail (cont_name,	cont_gender, cont_mobileno, cont_mailid, cont_address, cont_gst, cont_panno, Cont_type, experiance_level, work_type,cont_state,id_proof,active,state_id) VALUES ('$ContractorName', '$ContractorGender', '$ContractorMobileNo','$ContractorMailId','$ContractorAddress', '$ContractorGST', '$ContractorPANNo','$SaveContractorType','$ContractorExperienceLevel','$ContractorworkType','$ContractorState','$SaveContractorIDProof','1','$StateID')";
        //echo($insert_query); 
		$insert_sql1  = pg_query($insert_query);  //INSERT QUERY //
		if($insert_sql1 == true){
			$msg = "Contractor Details Successfully Saved..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}
	

}
$GetEmployeeEducationArray ='';
if(isset($_GET['id'])){
	$ContractorID = $_GET['id'];
	$SelectQuery = "SELECT * FROM contractor_detail WHERE cont_id='$ContractorID'";
	$ContractorDetailsQuery = pg_query($SelectQuery);
	if($ContractorDetailsQuery != NULL){
		if(pg_num_rows($ContractorDetailsQuery)>0){
			$List = pg_fetch_assoc($ContractorDetailsQuery);
			$ContractorNameByID    = $List['cont_name'];
    		$ContractorGenderByID  = $List['cont_gender'];
    		$ContractorMobileByID  = $List['cont_mobileno'];
			$ContractorMailByID    = $List['cont_mailid'];
			$ContractorAddressByID = $List['cont_address'];
			$ContractorGSTByID    = $List['cont_gst'];
			$ContractorPANByID    = $List['cont_panno'];
			$ContractorTypeByID    = $List['cont_type'];
			$GetContractorTypeByID = explode(',',$ContractorTypeByID);
			$ContractorExperienceLevelTypeByID  = $List['experiance_level'];
			$ContractorWorkTypeByID    = $List['work_type'];
			//$ContractorStateTypeByID    = $List['cont_state'];
			$ContractorIDProofByID    = $List['id_proof'];
			$GetContractorIDProofByID = explode(',',$ContractorIDProofByID);
			
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
		url = "ContractorDetailView.php";
		window.location.replace(url);
	}
	
</script>
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form" id="form1">
            <?php include "Menu.php"; ?>
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title">Contractor Details Create</div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1 stable" style="overflow:auto">
							<div class="row">
								<div class="box-container box-container-lg" align="center">
								<div class="div1">&nbsp;</div>
									<div class="div10">
										<div class="card cabox">
											<div class="face-static">
												<div class="card-header inkblue-card" align="center">Contractor Details</div>
									            <div class="card-body padding-1 ChartCard" id="CourseChart">
									            	<div class="divrowbox  pt-2">

									            		<div class="row smclearrow"></div>                                                                            											
									            		<div class="div3 lboxlabel">Contractor Name</div>	
                                                        <div class="div9"><input type="text" name="txt_cont_name" id="txt_cont_name" maxlength="150" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ContractorNameByID; } ?>" style="width:500px"></div>
									            		
														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Contractor Gender </div>											
									            		<div class="div3 lboxlabel">Male<input type="radio"name="txt_cont_gen" id="gender_male"value="MALE"<?php if (isset($_GET['id']) && $ContractorGenderByID == "MALE") echo "checked"; ?>></div>
   														<div class="div3 lboxlabel">Female<input type="radio" name="txt_cont_gen"  id="gender_female"value="FEMALE"<?php if (isset($_GET['id']) && $ContractorGenderByID == "FEMALE") echo "checked"; ?>></div>
									            		
														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Mobile No </div>											
									            		<div class="div9"><input type="text" name="txt_cont_mbno" id="txt_cont_mbno" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ContractorMobileByID; } ?>" style="width:500px" ></div>																																																					
									            		
														<div class="row smclearrow"></div>
														<div class="div3 lboxlabel">Mail Id</div>											
									            		<div class="div9"><input type="text" name="txt_cont_mail" id="txt_cont_mail" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ContractorMailByID; } ?>" style="width:500px" ></div>																																																					
									            		
														<div class="row smclearrow"></div>
														<div class="div3 lboxlabel">Address</div>											
									            		<div class="div9"><textarea name="txt_cont_addr" id="txt_cont_addr" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id'])&& ($ContractorAddressByID="txt_cont_addr") ){ echo $ContractorAddressByID; } ?>" echo $ContractorAddressByID; style="width:500px" ></textarea></div>
														
														<div class="row smclearrow"></div>
														<div class="div3 lboxlabel">GST</div>											
									            		<div class="div9"><input type="text" name="txt_cont_GST" id="txt_cont_GST" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ContractorGSTByID; } ?>" style="width:500px" ></div>
									            		
														<div class="row smclearrow"></div>
														<div class="div3 lboxlabel">PAN No</div>											
									            		<div class="div9"><input type="text" name="txt_cont_panno" id="txt_cont_panno" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ContractorPANByID ; } ?>" style="width:500px" ></div>

														<div class="div3 lboxlabel">Contractor Type</div>	
														<div class="div9">
															<div class="div3 lboxlabel">Electrician<input type="checkbox"name="txt_cont_type[]" id="elect"value="Electrician"<?php if (isset($_GET['id']) && in_array('Electrician', $GetContractorTypeByID)) echo "checked"; ?> ></div>
   															<div class="div3 lboxlabel">Plumber<input type="checkbox" name="txt_cont_type[]"id="plum"value="Plumber"<?php if (isset($_GET['id']) && in_array('Plumber', $GetContractorTypeByID)) echo "checked"; ?>></div>
															<div class="div3 lboxlabel">Masor<input type="checkbox" name="txt_cont_type[]"  id="maso"value="Masor"<?php if (isset($_GET['id']) && in_array('Masor',$GetContractorTypeByID)) echo "checked"; ?>></div>
														</div>
														
														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Experiance level </div>											
									            		<div class="div9">
															<select  name="txt_exp_level" id="txt_exp_level" maxlength="10" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ContractorExperienceLevelTypeByID ; } ?>" style="width:500px">
																<option value="">----Select ----</option>
																<option value="0-1 Year" <?php if(isset($_GET['id']) && ($ContractorExperienceLevelTypeByID=="0-1 Year")) echo "selected"; ?>>0-1 Year</option>
																<option value="1-2 Years" <?php if(isset($_GET['id'])&& ($ContractorExperienceLevelTypeByID=="1-2 Years")) echo "selected"; ?>>1-2 Years</option>
																<option value="2-3 Years" <?php if(isset($_GET['id'])&& ($ContractorExperienceLevelTypeByID=="2-3 Years")) echo "selected"; ?>>2-3 Year</option>
															</select>
														</div>

														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Work Type </div>											
									            		<div class="div9">
															<select name="txt_work_type" id="txt_work_type" maxlength="10" class="tboxclass alphanumeric"  style="width:500px">
																<option value="">----Select ----</option>
																<?php
																 $WorkerData="SELECT * from work_detail where active='1'";
																 $WorkerDatasql = pg_query($WorkerData);
																 while($row=pg_fetch_assoc($WorkerDatasql))
																 {
																	$selected=($row['work_id']==$selected_work_id)? "selected":"";
																     echo "<option value='" . $row['work_id'] . "' $selected>" . $row['work_type'] . "</option>";
																 }
																
																?>
															</select>
														</div>

														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">State </div>											
									            		<div class="div9">
															<select name="txt_cont_state" id="txt_cont_state" maxlength="10" class="tboxclass alphanumeric"  style="width:500px">
																<option value="">----Select ----</option>
																<?php
																 $ContractorData="SELECT * from state_master where active='1'";
																// echo ($ContractorData);
                                                                 $ContractorDatasql = pg_query($ContractorData);
																 while($row=pg_fetch_assoc($ContractorDatasql))
																 {
																	$selected=($row['state_id'] == $selected_state_id)? "selected":"";
																    echo "<option value='" . $row['state_id'] . "' $selected>" . $row['state_description'] . "</option>";
																 }
																?>
															</select>
														</div>
														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">District </div>											
									            		<div class="div9">
															<select name="cmb_cont_dist" id="cmb_cont_dist" maxlength="10" class="tboxclass alphanumeric" value ="" style="width:500px">
																<option value="select State">----Select ----</option>
															</select>
														</div>
														<div class="div3 lboxlabel">ID Proof</div>	
														<div class="div9">
															<div class="div3 lboxlabel">Aadhar<input type="checkbox"name="txt_id_proof[]" id="Aadhar" value="Aadhar" <?php if (isset($_GET['id']) && in_array('Aadhar', $GetContractorIDProofByID)) echo "checked"; ?> ></div>
   															<div class="div3 lboxlabel">Pan<input type="checkbox" name="txt_id_proof[]" id="Pan" value="Pan"<?php if (isset($_GET['id']) && in_array('Pan', $GetContractorIDProofByID)) echo "checked"; ?>></div>
															<div class="div3 lboxlabel">Driving License<input type="checkbox" name="txt_id_proof[]"  id="Driving License"value="Driving License"<?php if (isset($_GET['id']) && in_array('Masor',$GetContractorIDProofByID)) echo "checked"; ?>></div>
														</div>
														
									            		
														<div class="row smclearrow"></div>
														<input type="hidden" name="cont_id" id="cont_id" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ContractorID; } ?>" style="width:500px" >
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
		// alert(1);
		var msg = "<?php echo $msg; ?>";
		document.querySelector('#top').onload = function(){
		if(msg != ""){
				BootstrapDialog.show({
					message: msg,
					buttons: [{
						label: ' OK ',
						action: function(dialog) {
							dialog.close();
							window.location.replace('ContractorDetail.php');
						}
					}]
				});
			}
		};
	});
	$('body').on('change','#txt_cont_state',function(e){
		var StatId          = $(this).val()
		var $DistrictSelect = $('#cmb_cont_dist');
		$.ajax({
			type: 'POST',
			url:  'DistrictsList.php',
			data:  {ParId :StatId },
			dataType: 'json',
			success : function(data){
				if(data !=null && data.length>0){
					$.each(data,function(index, Districts){
						var optionHtml = "<option value='" + Districts.dist_id + "'>" + Districts.dist_name + "</option>";
						$DistrictSelect.append(optionHtml); // HERE WE ADD THE OPTION//
					});
				}
			}
		});
	});
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var ContractorName  = $('#txt_cont_name').val();
			var ContractorGender = $('#txt_cont_gen').checked();
			var ContractorMobileNo = $('#txt_cont_mbno').val();
			var ContractorMailId  = $('#txt_cont_mail').val();
			var ContractorAddress = $('#txt_cont_addr').val();
			var ContractorGST= $('#txt_cont_GST').checked();
			var ContractorPanNo = $('#txt_cont_panno').checked();
			var ContractorType = $('#txt_cont_type').val();
			var ContractorExpLevel = $('#txt_exp_level').val();
			var ContractorWorkType = $('#txt_work_type').val();
			var ContractorState = $('#txt_cont_state').val();
			var ContractorIdProof = $('#txt_id_proof').val();
			
			if(ContractorName == ""){
				BootstrapDialog.alert("Error: Contractor Name should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}else if(ContractorGender == ""){
				BootstrapDialog.alert("Error: Contractor Gender should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(ContractorMobileNo == ""){
				BootstrapDialog.alert("Error: ContractorMobileNo should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(ContractorMailId == ""){
				BootstrapDialog.alert("Error: ContractorMailId should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(ContractorAddress == ""){
				BootstrapDialog.alert("Error: ContractorAddress should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(ContractorGST == ""){
				BootstrapDialog.alert("Error:  ContractorGST should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(ContractorPanNo == ""){
				BootstrapDialog.alert("Error: ContractorPanNo should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(ContractorType == ""){
				BootstrapDialog.alert("Error: contractorType should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(ContractorExpLevel == ""){
				BootstrapDialog.alert("Error:  ContractorExpLevel should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(ContractorWorkType == ""){
				BootstrapDialog.alert("Error:  ContractorWorkType should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if( ContractorState == ""){
				BootstrapDialog.alert("Error:  ContractorState should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(ContractorIdProof == ""){
				BootstrapDialog.alert("Error:  CContractor IdProof should not be in empty...!");
				event.preventDefault();
				event.returnValue = false;
			}
			
			else{
				event.preventDefault();
				BootstrapDialog.show({
					title: 'Confirmation Message',
					message: 'Are you sure want to save Contractor Register?',
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
	

</script>

