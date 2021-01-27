<?php
	$pageName = "Pages Tags";
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<!--Admin Page Meta Tags-->
	<title><?php echo $pageName?> | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" href="<?php if (isset($imagesData[0]['favicon'])) echo base_url() . ADMIN_IMAGES . $imagesData[0]['favicon']; ?>" alt="favicon" />
	<meta name="robots" content="noindex">
	<!--/Admin Page Meta Tags-->

	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/includes/headerscripts'); ?>
	<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray">

	<!-- Wrapper -->
	<div id="wrapper">

		<!--------------------------------------------------------------------------------------------------------------->
		<div class="clearfix"></div>
		<!--------------------------------------------------------------------------------------------------------------->


		<!-- Dashboard Container -->
		<!--------------------------------------------------------------------------------------------------------------->
		<div class="dashboard-container">
			<?php $this->load->view('admin/includes/sidebar'); ?>
			<!--------------------------------------------------------------------------------------------------------------->

			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">

					<!-- Dashboard Headline -->
					<div class="dashboard-headline">

						<div class="dashboad_table">
							<i class="mdi mdi-pipe"></i>
							<h3><?php echo $pageName?></h3>
							<div class="ml-auto dropdown user_name">
								<div class="get_user dropdown-toggle" data-toggle="dropdown">AD</div>
								<div class="dropdown-menu">
									<a href="<?php echo base_url(); ?>admin/user_settings" class="dropdown-item"><i class="icon-material-outline-settings"></i> Settings</a>
									<li class="divider"></li>
									<a href="<?php echo base_url(); ?>admin/change_password" class="dropdown-item"><i class="icon-material-outline-lock"></i> Change Password</a>
									<a href="<?php echo base_url(); ?>admin/logout" class="dropdown-item"><i class="icon-material-outline-power-settings-new"></i> Logout</a>
								</div>
							</div>
						</div>
					</div>
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs" class="dark">
						<ul>
							<li><a href="<?php echo base_url(); ?>admin">Home</a></li>
							<li><a href="javascript:void(0);"><?php echo $pageName?></a></li>
						</ul>
					</nav>


					<!-- Row -->
					<div class="row">

						<!-- Dashboard Box -->
						<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">

								<!-- Headline -->
								<div class="headline">
									<h3><?php echo $pageName?> <a href="javascript:void(0);" onclick="addNewRow();"><i class="fa fa-plus" aria-hidden="true"></i></a></h3>
								</div>

								<!----- Content --->
								<div class="card">
									<div class="card-body">
										<form action="<?php echo base_url('admin/save-pages-tags');?>" method="post" enctype="multipart/form-data" />

										<div class="col-xl-12">
											<table class="table" id="pagesTagsTable">
												<tbody>
													<?php
													foreach ($pageTagsData as $key => $value) {
													?>
														<tr>
															<td>
																<select name="pages[]" class="form-control">
																	<option value="">Please Select</option>
																	<?php foreach($pageTags as $row=>$val) {?>
																		<option value="<?php echo $row ?>" <?php if(isset($value['page']) && $value['page'] == $row) { echo 'selected="selected"'; }?>><?php echo $val ?></option>
																	<?php } ?>
																</select>
															</td>

															<td><input type="text" class="form-control" id="name" name="tags[]" placeholder="Write Tags" value="<?php if(isset($value['tags'])) { echo $value['tags']; }?>" /></td>
															<td><a href="javascript:void(0);" class="apiRowDelete"><i class="fas fa-trash" aria-hidden="true"></i></a></td>
														</tr>
													<?php	
													}

													if(count($pageTagsData) == 0) {
													?>
													<tr>
														<td>
															<select name="pages[]" class="form-control">
																<option value="">Please Select</option>
																<?php foreach($pageTags as $row=>$val) {?>
																	<option value="<?php echo $row ?>"><?php echo $val ?></option>
																<?php } ?>
															</select>
														</td>
														<td><input type="text" class="form-control" id="name" name="tags[]" placeholder="Write Tags" /></td>
														<td><a href="javascript:void(0);" class="apiRowDelete"><i class="fas fa-trash" aria-hidden="true"></i></a></td>
													</tr>
													<?php } ?>
												</tbody>
												<tfoot>
													<tr>
														<td colspan="3"><a href="javascript:void(0);" onclick="addNewRow();">Add More</a></td>
													</tr>
												</tfoot>
											</table>
										</div>

										<div class="d-flex justify-content-end">
											<a href="<?php echo site_url('admin/manage-badges') ?>" class="btn theme_btn mr-2">Reset</a>
											<button type="submit" name="btn_categorysave" id="btn_save" class="btn btn-success mr-2 btntheme_color_a">Save</button>
										</div>

										<div id="categoriesSettingsMsg"></div>
										<span id="loadingCategories" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>

										<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

										</form>

									</div>
									<!----- /Content --->

									

								 <!----- PAGES ---------------->
									<div class="row manage_badges_a">
										<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
											<div class="card mb-3">
												<div class="card-body">
													<div class="table-responsive">
														<table id="tbl_pagesTagData" class="table table-striped table-hover responsive">
															<thead>
																<tr>
																	<th>USER</th>
																	<th>IP</th>
                                  									<th>Page</th>
																	<th>Tags</th>
																	<th>Delete</th>
																</tr>
															</thead>
														</table>
													</div>
												</div>
											</div><!-- end card-->
										</div>
									</div>
									<!----- /PAGES ---------------->

								</div>
							</div>
						</div>
					</div>
						<!-- Row / End -->

						<!----------------------------------------------------------------------------------------------------------->
						<?php $this->load->view('user/includes/footer'); ?>
						<!----------------------------------------------------------------------------------------------------------->

					</div>
				</div>
				<!-- Dashboard Content / End -->

			</div>
			<!-- Dashboard Container / End -->

		</div>
		<!-- Wrapper / End -->

		<!--------------------------------------------------------------------------------------------------------------->
		<?php $this->load->view('main/includes/footerscripts'); ?>
		<script type="text/javascript">
			function addNewRow(){
				/*var $tr    = $('#pagesTagsTable').find("tbody").find("tr:last").clone();
				
				$('#pagesTagsTable').append($tr);*/
				var clonedRow = $('#pagesTagsTable tbody tr:first').clone();
				clonedRow.find('input').val('');
				clonedRow.find('select').val('');
				$('#pagesTagsTable').append(clonedRow);
			}
			
			$(document).on('click', ".apiRowDelete", function () {
				var rowCount = $('#pagesTagsTable tbody tr').length;
				if(rowCount > 1) {
					$(this).closest('tr').remove();	
				} else {
					alert("You can not delete this row");
				}
			});

			loadPageTagsData();
		</script>
		<!--------------------------------------------------------------------------------------------------------------->

</body>

</html>