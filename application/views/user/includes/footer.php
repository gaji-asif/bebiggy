			<!-- Footer -->
			<div class="dashboard-footer-spacer"></div>
			<div class="small-footer margin-top-15">
				<div class="small-footer-copyrights">
					&copy; <?php echo date('Y'); ?><strong><a href="<?php echo base_url(); ?>" target="_blank"><?php echo $this->lang->line('site_name'); ?> </a></strong> <?php if ($settings[0]['footer_credits'] === '1') { ?> <?php } ?>
				</div>
				<ul class="footer-social-links">
					<?php if (!empty($settings[0]['user_facebook'])) { ?>
						<li>
							<a href="<?php //echo $settings[0]['user_facebook']; 
										?>https://www.facebook.com/bebiggy/" title="Facebook" data-tippy-placement="bottom" data-tippy-theme="light">
								<i class="icon-brand-facebook-f"></i>
							</a>
						</li>
					<?php }
					if (!empty($settings[0]['user_twitter'])) { ?>
						<li class="twitter_a">
							<a href="<?php echo $settings[0]['user_twitter']; ?>" title="Twitter" data-tippy-placement="bottom" data-tippy-theme="light">
								<i class="icon-brand-twitter"></i>
							</a>
						</li>
					<?php }
					if (!empty($settings[0]['user_Instagram'])) { ?>
						<li class="instagram_a">
							<a href="<?php echo $settings[0]['user_Instagram']; ?>" title="Instagram" data-tippy-placement="bottom" data-tippy-theme="light">
								<i class="icon-brand-instagram"></i>
							</a>
						</li>
					<?php }
					if (!empty($settings[0]['user_github'])) { ?>
						<li class="github_a">
							<a href="<?php echo $settings[0]['user_github']; ?>" title="Github" data-tippy-placement="bottom" data-tippy-theme="light">
								<i class="icon-brand-github"></i>
							</a>
						</li>
					<?php }
					if (!empty($settings[0]['user_google'])) { ?>
						<li class="google_icon_a">
							<a href="<?php echo $settings[0]['user_google']; ?>" title="Google Plus" data-tippy-placement="bottom" data-tippy-theme="light">
								<i class="icon-brand-google-plus-g"></i>
							</a>
						</li>
					<?php } ?>
				</ul>
				<div class="clearfix"></div>
			</div>
			<!-- Footer / End -->

			<script type="text/javascript">
				$(document).ready(function() {
					// 	$(".admin_dashboard_left ul li").click(function() {

					// 		$(".admin_dashboard_left ul li").removeClass("active");
					// 		$(this).addClass("active");

					// 	})

					// 

					// function myFunction(x) {
					// 	x.classList.toggle("change");
					// 	$('.tablet_menu').toggle('hide');
					// }
				});
			</script>