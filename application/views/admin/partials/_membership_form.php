	<div class="row">
		<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">
			<div class="card">
				<div class="card-body membership_listing_a">
					<!----- Content --->
					<?php
					isset($records) ? extract($records[0]) : ''; ?>
					<form id="membershipListingForm" action="<?php echo isset($url) ? site_url($url) : ''; ?>" method="post" enctype="multipart/form-data" novalidate>
					

						<div class="row">
							<div class="col-xl-6">
								<div class="submit-field">
									<h5 for="membership_name">Membership Name</h5>
									<input type="text" class="with-border required" id="membership_name" name="name" placeholder="Membership Name" required="true" value="<?php echo isset($name) ? $name : ''; ?>">
									<input type="hidden" class="with-border" id="membership_id" name="membership_id" value="<?php echo isset($id) ? $id : ''; ?>">
									<input type="hidden" id="pageNo" name="pageNo" value="<?php echo isset($pageNo) ? $pageNo : ''; ?>">
									<input type="hidden" id="queryString" name="queryString" value="<?php echo isset($queryString) ? $queryString : ''; ?>">
								</div>
							</div>
							<?php $slug = $slug ?? '';
							$this->load->view('admin/includes/_listing_slug_membership', ['slug' => $slug]); ?>
							<div class="col-xl-6">
								<div class="submit-field">
									<h5 for="membership_validity">Membership Validity<code> (Number of Days)</code></h5>
									<input type="text" class="with-border numeric_validation required" id="membership_duration" name="validity" onkeypress='validateInputNumbers(event)' maxlength="<?php echo  MAX_LENGTH_8 ; ?>" placeholder="Membership Validity" value="<?php echo isset($validity) ? $validity : ''; ?>">
								</div>
							</div>
							<div class="col-xl-6">
								<div class="submit-field">
									<h5 for="membership_price">Membership Price ($)</h5>
									<input type="text" class="with-border numeric_validation" id="membership_price" name="price" maxlength="<?php echo CURRENCY_MAXLENGTH ?>" onkeypress='validateInputNumbers(event)' placeholder="Membership Price" required="true" value="<?php echo isset($price) ? $price : ''; ?>">
								</div>
							</div>

							<div class="col-md-6">
								<div class="submit-field">
									<h5 class="invisible">No Validity</h5>
									<div class="monetize_methods">
										<input type="checkbox" class="checkbox_monetize  zero_validity_allow" name="no_validity" <?php if (!empty($no_validity) && $no_validity == '1') echo 'checked';  ?> value="1"> <label> Never Expried </label>
									</div>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5 for="category_meta_keywords">Status</h5>
									<select class="form-control form-control-lg" id="status" name="status">
										<option value="1" <?php if (isset($status) && $status == 1) : echo 'selected';
															endif; ?>> Active </option>
										<option value="0" <?php if (isset($status) && $status == 0) : echo 'selected';
															endif; ?>> Inactive </option>
									</select>
								</div>
							</div>

							<div class="col-xl-12">
								<div class="submit-field">
									<h5 for="membership_description">Membership Description   <span class="text-danger">*</span> </h5>
									<textarea type="text" class="with-border" id="membership_description" name="description" required="true"><?php echo isset($description) ? $description : '' ?></textarea>
								</div>
							</div>

						</div>
						<div class="col-xl-12">

						</div>
						<table class="table table-hover main_permission_class">
							<?php if ($membership_premissions) :
								foreach ($membership_premissions as $key  => $innerval) : ?>
									<tr class="row_start">
										<td>
											<label>
												<input type="checkbox" value="<?php echo $key; ?>" class="checkbox small_checkbox master_class" />
												<?php echo strtoUpper($key); ?>
											</label>
										</td>
										<td>
											<table class="table table-hover">
												<?php foreach ($innerval as $innervalkey => $val) : ?>
													<tr class="slave_row_start">
														<td>
															<label>
																<input type="checkbox" value="1" class="checkbox small_checkbox slave_child" name="is_allowed[<?php echo $val['permission_slug']; ?>]" <?php echo $val['is_allowed'] == 1 ? 'checked' : ''; ?> />

																<input type="hidden" class="hidden_value" name="is_allowed[<?php echo $val['permission_slug']; ?>]" value="0" <?php echo $val['is_allowed'] == 1 ? 'disabled' : ''; ?>>
																<?php echo strtoUpper(str_replace('-', ' ', $val['permission_slug'])); ?>
															</label>
														</td>
													</tr>
												<?php
												endforeach; ?>
											</table>
										</td>
									</tr>
							<?php
								endforeach;
							endif; ?>
						</table>

						<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
						<?php if (isset($id) && !empty($id)) : ?>
							<button type="submit"  id="btnListing" class="btn btn-success mr-2 btn_themecolor_a">Update</button>
						<?php else : ?>
							<button type="submit"  id="btnListing" class="btn btn-success mr-2 btn_themecolor_a">Save</button>
						<?php endif; ?>
						<div id="listingSettingsMsg"></div>
						<span id="loadinglistings" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>
						<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

					</form>
					<!----- /Content --->
				</div>
			</div>
		</div>
	</div>