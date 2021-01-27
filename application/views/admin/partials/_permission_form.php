	<div class="row">
		<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
			<div class="card mb-3">
				<div class="card-body">
					<!----- Content --->
					<?php isset($record) ? extract($record[0]) : ''; ?>
					<form id="permissionListingForm" action="<?php echo isset($url) ? site_url($url) : ''; ?>" method="post" enctype="multipart/form-data" novalidate>

						<div class="col-xl-12">
							<div class="submit-field">
								<label for="permission_name">Name</label>
								<input type="text" class="with-border required" id="permission_name" name="name" placeholder="permission Name" required="true" value="<?php echo isset($name) ? $name : ''; ?>">
								<input type="hidden" class="with-border" id="permission_id" name="permission_id" value="<?php echo isset($id) ? $id : ''; ?>">
								<input type="hidden" id="pageNo" name="pageNo" value="<?php echo isset($pageNo) ? $pageNo : ''; ?>">
								<input type="hidden" id="queryString" name="queryString" value="<?php echo isset($queryString) ? $queryString : ''; ?>">
							</div>
						</div>
						<div class="col-xl-12">
							<div class="submit-field">
								<label for="permission_slug">Master Module</label>
								<select name="master_id" class="with-border" >
									<option value="">Optional Select Master</option>
									<?php if (isset($permssions) && !empty($permssions)) :  ?>
										<?php foreach ($permssions as $permssion) : ?>
											<?php $select = "";
											if ($permssion['id'] == $master_id) {
												$select = "selected";
											}
											?>
											<option value="<?php echo $permssion['id']; ?>" <?php echo $select; ?>><?php echo $permssion['name'] ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div>
						</div>
						<div class="col-xl-12">
							<div class="submit-field">
								<label for="permission_slug">Slug</label>
								<input type="text" class="with-border" id="permission_slug" name="slug" placeholder="permission Slug" required="true" value="<?php echo isset($slug) ? $slug : '' ?>" />
							</div>
						</div>


						<div class="col-xl-12">
							<div class="submit-field">
								<label for="permission_description">Description</label>
								<textarea type="text" class="with-border" id="permission_description" name="description" required="true"><?php echo isset($description) ? $description : '' ?></textarea>
							</div>
						</div>

						<div class="col-xl-12">
							<div class="submit-field">
								<label for="category_meta_keywords">Status</label>
								<select class="form-control form-control-lg" id="status" name="status">
									<option value="1" <?php if (isset($status) && $status == 1) : echo 'selected';
														endif; ?>> Active </option>
									<option value="0" <?php if (isset($status) && $status == 0) : echo 'selected';
														endif; ?>> Inactive </option>
								</select>
							</div>
						</div>
						<?php if (isset($id) && !empty($id)) : ?>
							<button type="submit" name="btn_listingUpdate" id="btnListing" class="btn btn-success mr-2">Update</button>
						<?php else : ?>
							<button type="submit" name="btn_listingSave" id="btnListing" class="btn btn-success mr-2">Save</button>
						<?php endif; ?>
						<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					</form>
					<!----- /Content --->
				</div>
			</div>
		</div>
	</div>