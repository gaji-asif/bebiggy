<div class="content">

	<div class="table-responsive solutions_listings">
		<table class="table table-head-fixed table-border table-hover table-striped table-condensed">
			<thead>
				<tr>
					<th><a href="javascript:void(0);" class="tblMnu">Name</a></th>
					<th><a href="javascript:void(0);" class="tblMnu">ServiceType</a></th>
					<th><a href="javascript:void(0);" class="tblMnu">Category</a></th>
					<th><a href="javascript:void(0);" class="tblMnu">Price</a></th>
					<th><a href="javascript:void(0);" class="tblMnu">Date</a></th>
					<th><a href="javascript:void(0);" class="tblMnu">Status</a></th>
					<th><a href="javascript:void(0);" class="tblMnu">Action</a></th>
			</thead>
			<tbody>
				<?php if (!empty($solutionListing['solution'])) {
					foreach ($solutionListing['solution'] as $listing) { ?>

						<tr>
							<td><?php echo _str_limit($listing['name'], 10); ?></td>
							<td><?php echo $listing['service_type']; ?></td>
							<td><?php echo $listing['category']; ?></td>
							<td><?php echo $listing['price']; ?></td>
							<td><?php echo $listing['date']; ?></td>
							<td>
								<?php if ($listing['status'] != 9) : ?>
									Approved
								<?php else :  ?>
									Approval Pending
								<?php endif; ?>
							</td>
							<td>
								<a href='<?php echo site_url('user/edit-solution/' . $listing['id']); ?>' class="solution_edit_icon_a" id="EditSolution" title=" Edit"><i class="fas fa-edit" aria-hidden="true"></i></a>
								&nbsp;&nbsp;

								<a href="javascript:void(0);" class="solution_delete_icon_a" data-url='admin/deleteSolution' id="deleteSolution" data-id="<?php echo $listing['id'] ?>
        												" title="Delete">
									<i class="fas fa-trash" aria-hidden="true"></i></a>
							</td>
						</tr>
				<?php  }
				} else echo '<li>Sorry !! No Listings are available</li>'; ?>
				<!-- set bundle id just for show side icon-->
			</tbody>
		</table>
	</div>
	<!-- End Listing -->

	<!-- Pagination -->
	<div class="clearfix"></div>
	<div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
		<nav class="pagination">
			<ul>
				<?php if (isset($links)) {
					echo $links;
				}
				?>
			</ul>
		</nav>
	</div>
	<!-- Pagination / End -->

</div>
<!--  content / end  -->