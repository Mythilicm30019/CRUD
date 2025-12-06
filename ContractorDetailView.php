<?php
require_once 'library/config.php';
$StudentRegisterData     = "SELECT * FROM contractor_detail ORDER BY cont_id ASC";
$Query_StudentRegister   = pg_query($StudentRegisterData);
$StudentDetailsArr       = array();
if(pg_num_rows($Query_StudentRegister)>0){
	while($List = pg_fetch_assoc($Query_StudentRegister)){
		$StudentDetailsArr[] = $List;
	}
}
if (isset($_POST['btn_delete']) && $_POST['btn_delete'] === "Delete") {
	$id    = intval($_POST['id']);
    $query = "UPDATE contractor_detail SET active = 0 WHERE cont_id = $id"; // soft delete

    if (pg_query($query)) {
        $msg ="Contractor Details Deleted Successfully";
		echo $msg;
    } else {
        $msg ="Contractor Details not deleted, please try again...!!";
    }

    exit; 
}
if (isset($_POST['btn_undodelete']) && $_POST['btn_undodelete'] === "UndoDelete") {
	$id    = intval($_POST['id']);
    $query = "UPDATE contractor_detail SET active = 1 WHERE cont_id = $id"; // soft delete
    if (pg_query($query)) {
        $msg ="Contractor Details Activated Successfully";
		echo $msg;
    } else {
        $msg ="Contractor Details not activated, please try again...!!";
    }
    exit; 
}
?>
<link rel="stylesheet" href="dashboard/MyView/bootstrap.min.css">
<?php include "Header.html"; ?>
<script src="dashboard/MyView/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript"></script>
<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
	function goBack(){
		url = "ContractorDetail.php";
		window.location.replace(url);
	}
	 function RedirectToEdit(EditId) {
        var url = "ContractorDetail.php?action=EDIT&id=" + EditId;
        window.location.href = url;
    }
</script>
        <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form" id="form1">
            <?php include "Menu.php"; ?>
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title">Contractor Details View & Edit</div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1 stable" style="overflow:auto">
							<div class="row">
								<div class="box-container box-container-lg" align="center">
									<div class="div12">
										<div class="card cabox">
											<div class="face-static">
												<div class="card-header inkblue-card" align="center">&nbsp;Contractor Details  - View</div>
												<div class="card-body padding-1 ChartCard" id="CourseChart">
													<div class="divrowbox pt-2">
														<div class="table-responsive dt-responsive ResultTable">
															<div class="table-responsive dt-responsive rtabdiv" id="table-stmt">
                                                            	<table id="example" class="display rtable mgtb-8" style="width:100%">
                                                                    <thead>
									                                	<tr class="note heading">
									                                		<th class="colhead" style="text-align:center">SNo.</th>
									                                		<th class="colhead" style="text-align:center">Contractor Name</th>
									                                		<th class="colhead" style="text-align:center">Contractor Gender </th>
                                                                            <th class="colhead" style="text-align:center">Mobile No</th>
									                                		<th class="colhead" style="text-align:center">Mail Id</th>
									                                		<th class="colhead" style="text-align:center">Address</th>
									                                		<th class="colhead" style="text-align:center">GST</th>
									                                		<th class="colhead" style="text-align:center">PAN No</th>
																			<th class="colhead" style="text-align:center">ContractorType</th>
																			<th class="colhead" style="text-align:center">Experiance Level</th>
																			<th class="colhead" style="text-align:center">Work Type</th>
																			<th class="colhead" style="text-align:center">State</th>
																			<th class="colhead" style="text-align:center">ID Proof</th>

																			<th class="colhead" style="text-align:center"></th>
																			<th class="colhead" style="text-align:center">Action</th>
									                                	</tr>
									                                </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                        if(isset($StudentDetailsArr)){
																			if(count($StudentDetailsArr) >0){
                                                                            	$SNO = 1;
                                                                            	foreach($StudentDetailsArr as $key=>$value){
                                                                                
                                                                       				 ?>
								                                					<tr>
																						<td align="center"><?php echo $SNO ?></td>
																						<td align="left"><?php echo $value['cont_name'] ?></td>
																						<td align="left"><?php echo $value['cont_gender'] ?></td>
																						<td align="left"><?php echo $value['cont_mobileno'] ?></td>
																						<td align="left"><?php echo $value['cont_mailid'] ?></td>
																						<td align="left"><?php echo $value['cont_address'] ?></td>
																						<td align="left"><?php echo $value['cont_gst'] ?></td>
																						<td align="left"><?php echo $value['cont_panno'] ?></td>
																						<td align="left"><?php echo $value['cont_type'] ?></td>
																						<td align="left"><?php echo $value['experiance_level'] ?></td>
																						<td align="left"><?php echo $value['work_type'] ?></td>
																						<td align="left"><?php echo $value['cont_state'] ?></td>
																						<td align="left"><?php echo $value['id_proof'] ?></td>
 
																						
								                                				<td align="center" style="width:100px">
                                                                                    <!-- <a data-url="CementGradeType?id=<?php echo $value['cont_id']; ?>" class=" BtnHref btn btn-info" name="btn_edit" id="btn_edit">
																						Edit
																					</a> -->
																					<a  onclick="RedirectToEdit(<?php echo $value['cont_id']; ?>);" class=" BtnHref btn btn-info" name="btn_edit" id="btn_edit">
																						Edit
																					</a>
																					<!-- <a  onclick="RedirectToEdit(<?php echo $value['cont_id']; ?>);" class=" BtnHref btn btn-info" name="btn_delete" id="btn_delete">
																						Delete
																					</a> -->
																					<td align="center" style="width:100px">
                                                                                <?php if($value['active'] == 1){ ?>
								                                					<button type="button" name = "btn_delete" id = "btn_delete" class="btn fa-btn-d gDelete tdelbtn Delete" data-id="<?php echo $value['cont_id']; ?>" title="Click here to delete" style="cursor: pointer;"><i class="fa fa-trash-o"></i></button>								
								                                				<?php }else{ ?>
								                                					<button type="button" disabled name = "btn_delete" id = "btn_delete" class="btn btn-default Delete" style="cursor: pointer;"><i class="fa fa-trash-o"></i></button>											
                                                                                <?php } ?>
																					
																						
								                                						<?php
                                                                       						 $SNO++; 
                                                                        		}
																			}else{  ?>
																				<td colspan ='13'  align="center">No data found ...</td>
																			<?php
																			}

                                                                    	}
                                                                    	?>
																					</tr>
								                                	</tbody>

                                                                </table>
															</div>
														</div>
													</div>
												</div>
												<div align="center">
												<input type="button" class="btn btn-info" onClick="goBack();" name="back" value="Back">
													<!--<input type="submit" class="btn btn-info" name="btn_save" id="btn_save" value="Save" />-->
												</div>
												<div class="clearrowsm">&nbsp;</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</blockquote>
					</div>
				</div>
			</div>
           <?php   include "footer/footer.html"; ?>
            <script src="js/jquery.hoverdir.js"></script>
        </form>
    </body>
</html>
<script>
	$(document).ready(function(){
		$("body").on("click",".Delete", function(){
			var id = $(this).data("id");//console.log(id);
    		$.ajax({
				url: "ContractorDetailView.php",
    		    type: "POST",
    		    data: { btn_delete: "Delete", id: id },
    		    success: function (response) {
    		        if (response.trim() != '') {
    		            if(response != ""){
							BootstrapDialog.show({
								message: response,
								buttons: [{
									label: ' OK ',
									action: function(dialog) {
										dialog.close();
										window.location.replace('ContractorDetailView.php');
									}
								}]
							});
						}
    		        }
    		    }
    		});
		});
		$("body").on("click",".UndoDelete", function(){
			var id = $(this).data("id");
    		$.ajax({
				url: "ContractorDetailView.php",
    		    type: "POST",
    		    data: { btn_undodelete: "UndoDelete", id: id },
    		    success: function (response) {
    		        if (response.trim() != '') {
    		            if(response != ""){
							BootstrapDialog.show({
								message: response,
								buttons: [{
									label: ' OK ',
									action: function(dialog) {
										dialog.close();
										window.location.replace('ContractorDetailView.php');
									}
								}]
							});
						}
    		        }
    		    }
    		});
		});

	});
	$(document).ready(function(){
		
		$('#dataTable thead tr')
        .clone(true)
        .addClass('filters filterhead')
        .insertBefore('#dataTable thead');
 
		var table = $('#dataTable').DataTable({
			orderCellsTop: false,
			fixedHeader: false,
			
			initComplete: function () {
				var api = this.api();
				api
				.columns()
				.eq(0)
				.each(function (colIdx) {
					var cell = $('.filters th').eq(
						$(api.column(colIdx).header()).index()
					);
					var title = $(cell).text(); //  here we have to write based on colindex for display search & Hide colummn text
					if((colIdx == 1)){
						$(cell).html('<input type="text" placeholder="' + title + '" />');
					}else{
						$(cell).html('');
					}
					if((colIdx == 5)){
					$(cell).html('Edit');
					}
					if((colIdx == 6)){
						$(cell).html('Delete');
					}
					if((colIdx == 7)){
						$(cell).html('Activate');
					}
					$(
						'input',
						$('.filters th').eq($(api.column(colIdx).header()).index())
					)
					.off('keyup change')
					.on('change', function (e) {
						$(this).attr('title', $(this).val());
						var regexr = '({search})'; //$(this).parents('th').find('select').val();
						var cursorPosition = this.selectionStart;
						api
						.column(colIdx)
						.search(
							this.value != ''
								? regexr.replace('{search}', '(((' + this.value + ')))')
								: '',
							this.value != '',
							this.value == ''
						)
						.draw();
					})
					.on('keyup', function (e) {
						e.stopPropagation();

						$(this).trigger('change');
						$(this)
							.focus()[0]
							.setSelectionRange(cursorPosition, cursorPosition);
					});
				});
			},
		});
    });
	
</script>