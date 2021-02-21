<ul data-submenu-title="Organize and Manage">
	<li <?php if (in_array($this->uri->segment(2), ['create_listings', 'manage_offers', 'manage_solutions'])) echo "class='active-submenu'" ?>><a href="#"><i class="icon-material-outline-business-center"></i> Listings</a>
		<ul>
			<li><a href="<?php echo site_url('user/create_listings'); ?>">Create a Listing</a></li>
			<!-- <?php //if (in_array('auction', array_column($options, 'platform'))) { 
					?>
				<li><a href="<?php// echo site_url('user/manage_listings'); ?>">Manage Auctions<span class="nav-tag"><?php // echo $listingCount; 
																														?></span></a></li>
			<?php //} 
			?> -->
			<?php if (in_array('classified', array_column($options, 'platform'))) { ?>
				<li><a href="<?php echo site_url('user/manage_offers'); ?>">Manage Offers<span class="nav-tag"><?php echo $listingOfferCount; ?></span></a></li>
			<?php } ?>
			<?php if (empty($listingSolutionCount)) {
				$listingSolutionCount = 0;
			} ?>
			<li><a href="<?php echo site_url('user/manage_solutions'); ?>">Manage Solutions<span class="nav-tag"><?php echo $listingSolutionCount; ?></span></a></li>
		</ul>
	</li>
	<li <?php if (in_array($this->uri->segment(2), ['pending_offers'])) echo "class='active-submenu'" ?>><a href="#"><i class="mdi mdi-gavel"></i> Bids & Offers</a>
		<ul>
			<?php if (in_array('auction', array_column($options, 'platform'))) { ?>
				<li><a href="<?php echo site_url('user/pending_bids'); ?>">My Active Bids</a></li>
			<?php } ?>
			<?php if (in_array('classified', array_column($options, 'platform'))) { ?>
				<li><a href="<?php echo site_url('user/pending_offers'); ?>">My Active Offers</a></li>
			<?php } ?>
		</ul>
	</li>

	<li <?php if (in_array($this->uri->segment(2), ['transcation'])) echo "class='active'" ?>><a href="<?php echo site_url('user/transcation'); ?>"><i class="icon-material-outline-assignment"></i> Transcation </a></li>

	<li <?php if (in_array($this->uri->segment(2), ['contract'])) echo "class='active-submenu'" ?>><a href="#"><i class="icon-material-outline-assignment"></i> Open Transaction <span class="nav-tag"><?php echo count($openContracts); ?></span></a>
		<ul>
			<?php foreach ($openContracts as $contract) { ?>
				<li><a href="<?php echo site_url('user/contract/' . $contract['contract_id']); ?>">Transaction - #<?php echo $contract['contract_id']; ?> </a></li>
			<?php } ?>
		</ul>
	</li>

	<li <?php if (in_array($this->uri->segment(2), ['closed_contracts'])) echo "class='active-submenu'" ?>><a href="#"><i class="mdi mdi-briefcase-check"></i> Closed Transaction <span class="nav-tag"><?php echo count($closeContracts); ?></span></a>
		<ul>
			<?php foreach ($closeContracts as $contract) { ?>
				<li><a href="<?php echo site_url('user/closed_contracts/' . $contract['contract_id']); ?>">Transaction - #<?php echo $contract['contract_id']; ?> </a></li>
			<?php } ?>
		</ul>
	</li>

	<li <?php if (in_array($this->uri->segment(2), ['invoices'])) echo "class='active'" ?>><a href="<?php echo site_url('user/invoices'); ?>"><i class="mdi mdi-fax"></i> Invoices </a></li>
</ul>