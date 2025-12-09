<link rel="stylesheet" href="css/menu.css" type="text/css" />
<script>
$(document).ready(function(){
	$(document).on("click","a", function(e){
		var DatUrl = $(this).attr("data-url");
		var SplitUrl = DatUrl.split("?");
		var Len = SplitUrl.length;
		if(Len > 0){
			if(Len == 1){
				var Url = SplitUrl[0]+".php";
			}else{
				var Url = SplitUrl[0]+".php?"+SplitUrl[1];
			}
			window.location.href = Url;
		}
	});
});
</script>
<header>
	<div class="container_13">
		<div class="grid_12">
			<!-- ====================== Logo and Title Section Starts=================== -->
			<h1>
				<a>
					<img src="images/igcar_logo_1.png" width="80" height="80" style="padding-top:2px;padding-bottom:2px;">
				</a>
			</h1>
			<h4>
				<a>
					<div class="titleHead">Fast Reactor Fuel Cycle Facility - EBMS</div>
					<div class="sub-titleHead">Electronic Billing Measurement System, NRB, FRFCF</div>
				</a>
			</h4>
			<!-- ====================== Top Left Menu Section Starts=================== -->
			<div class="menu_block" align="right">
				<div class="dropdown">
					<div align="right" class="wel-msg">
						<i class="fa fa-user" aria-hidden="true" style="padding-top:5px; text-align:right"></i> Welcome  !
						<a  class="btn-hom"><i class="fa fa-rupee" style="font-size:12px; padding-top:5px"></i> Billing</a>
						
						<a  class="btn-hom"><i class="fa fa-home" style="font-size:12px; padding-top:5px"></i></a>
						<a  class="btn-hom" title="Change Password"><i class="fa fa-lock" style="font-size:12px; padding-top:5px"></i></a>
						<a  class="btn-log"><i class="fa fa-power-off" style="font-size:12px; padding-top:5px"></i> Logout</a>
					</div>
				</div>
				<ul id="menu">
					<li><q><a href="" class="drop">Master <i class="fa fa-caret-down down-arr"></i></a></q>
						<div class="dropdown_1column align_right">
							<div class="col_1">
								<h3>Masters</h3>
								<ul class="greybox">
									<li><a data-url="StudentRegister">Student Register</a></li>
									<li><a data-url="EmployeeRegister">Employee Register</a></li>
									<li><a data-url="ItemMaster">Item Master</a></li>
									<li><a data-url="ContractorDetail">ContractorDetails</a></li>
									<li><a data-url="StateMaster">State Master</a></li>
									<li><a data-url="WorkMaster">Work Master</a></li>
									<li><a data-url="DistrictMaster">DistricrMaster</a></li>

								</ul> 
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</header> 

