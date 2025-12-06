
<?php
@ob_start();
require_once 'library/config.php';
$msg = "";
if(isset($_POST['btn_save']) == " Save "){
	$ItemID          = $_POST['item_id'];
    $ItemDescription   = $_POST['txt_Item_Desc'];
	$ItemUnit   = $_POST['txt_Item_Unit'] ?? '';;
	$ItemType        = $_POST['txt_Item_type'] ?? '';
    $ItemCode  = $_POST['txt_Item_code'];
     	if($ItemID != NULL){
		$update_query = "UPDATE item_master SET item_description=' $ItemDescription',item_unit='$ItemUnit',item_type='$ItemType',item_code='$ItemCode',updated_at=NOW() WHERE item_id='$ItemID'";
		$update_sql1 = pg_query($update_query); 
		if($update_sql1 == true){
			$msg = "Item Details Updated Successfully..!!";
		}else{
			$msg = "Kindly try again..!!";
		}
	}
	else{
		$insert_query = "INSERT INTO item_master (item_description, item_unit, item_type, item_code,  active, created_at) VALUES ('$ItemDescription','$ItemUnit','$ItemType', '$ItemCode',  1, NOW())";
		$insert_sql1  = pg_query($insert_query);  //INSERT QUERY //
		if($insert_sql1 == true){
			$msg = "Item Details Successfully Saved..!!";
		}else{
			$msg = "";
		}
	}

}
if(isset($_GET['id'])){
	$ItemID = $_GET['id'];
	$SelectQuery = "SELECT * FROM item_master WHERE item_id='$ItemID'";
	$ItemDetailsQuery = pg_query($SelectQuery);
	if($ItemDetailsQuery != NULL){
		if(pg_num_rows($ItemDetailsQuery)>0){
			$List = pg_fetch_assoc($ItemDetailsQuery);
			$ItemDescriptionByID    = $List['item_description'];
			$ItemUnitByID    = $List['item_unit'];
			$ItemTypeByID   = $List['item_type'];
    		$ItemCodeByID   = $List['item_code'];
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
		url = "ItemMasterView.php";
		window.location.replace(url);
	}
	
</script>
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form" id="form1">
            <?php include "Menu.php"; ?>
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title">Item Master Create</div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1 stable" style="overflow:auto">
							<div class="row">
								<div class="box-container box-container-lg" align="center">
								<div class="div1">&nbsp;</div>
									<div class="div10">
										<div class="card cabox">
											<div class="face-static">
												<div class="card-header inkblue-card" align="center">Item Master</div>
									            <div class="card-body padding-1 ChartCard" id="CourseChart">
									            	<div class="divrowbox  pt-2">
									            		<div class="row smclearrow"></div>                                                                             											
									            		<div class="div3 lboxlabel">Item Description </div>	
                                                        <div class="div9"><input type="text" name="txt_Item_Desc" id="'txt_Item_Desc'" maxlength="150" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ItemDescriptionByID; } ?>" style="width:500px"></div>
									            		
														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Item Unit </div>											
									            		<div class="div9">
															<select name="select item" name="'txt_Item_Unit'" id="'txt_Item_Unit'" maxlength="10" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ItemTypeByID ; } ?>" style="width:500px">
																<option value="select Unit">Select Unit	</option>
																<option value="General" <?php if(isset($_GET['id']) && ($ItemUnitByID=="General")) echo "selected"; ?>>General</option>
																<option value="Service" <?php if(isset($_GET['id'])&& ($ItemUnitByID=="Service")) echo "selected"; ?>>Service</option>
																<option value="Consumable" <?php if(isset($_GET['id'])&&($ItemUnitByID=="Consumable")) echo "selected"; ?>>Consumable</option>
															</select>
														</div>
														<div class="row smclearrow"></div>
                                                        <div class="div3 lboxlabel">Item Type </div>                                            
                                                        <div class="div9">
                                                            Perishable<input type="radio"name="txt_Item_Type" id="type_persihable"value="Perishable"<?php if (isset($_GET['id']) && $ItemTypeByID == "Perishable") echo "checked"; ?>>
                                                            Non Perishable<input type="radio" name="txt_Item_Type"  id="type_nonpersihable"value="Non Perishable"<?php if (isset($_GET['id']) && $ItemTypeByID == "Non Perishable") echo "checked"; ?>>

                                                        </div>
														<div class="row smclearrow"></div>
									            		<div class="div3 lboxlabel">Item code  </div>											
									            		<div class="div9"><input type="text" name="txt_Item_code" id="txt_Item_code" maxlength="10" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo $ItemCodeByID ; } ?>" style="width:500px"></div>
									            											
									            		<div class="row smclearrow"></div>
														<input type="hidden" name="item_id" id="item_id" maxlength="25" class="tboxclass alphanumeric" value="<?php if(isset($_GET['id']) != "" ){ echo 	$ItemID; } ?>" style="width:500px" >
									            		<div class="row smclearrow"></div>
															<div class="div12" align="center">
<!-- 														<input type="button" class="btn btn-info" name="back" id="back" value="Back" />
 -->																<input type="submit" class="btn btn-info" name="btn_save" id="btn_save" value="  Save " />
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
							window.location.replace('ItemMaster.php');
						}
					}]
				});
			}
		};
		var KillEvent = 0;
		$("body").on("click","#btn_save", function(event){
			if(KillEvent == 0){
				var ItemDescription = $('#txt_Item_Desc').val();
				var ItemCode = $('#txt_Item_code').val();
/* 				var StudentAge        = $('#txt_stud_age').val();
 */				if(StudentFirstName == ""){
					BootstrapDialog.alert("Item Descrption should not be in empty...!");
					event.preventDefault();
					event.returnValue = false;
				}else if(StudentSecondName == ""){
					BootstrapDialog.alert("Item Code should not be in empty...!");
					event.preventDefault();
					event.returnValue = false;
				}/* else if(StudentAge == ""){
					BootstrapDialog.alert("Error:  Age Name should not be in empty...!");
					event.preventDefault();
					event.returnValue = false;
				} */else{
					event.preventDefault();
					BootstrapDialog.show({
						title: 'Confirmation Message',
						message: 'Are you sure want to save Item Master?',
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

