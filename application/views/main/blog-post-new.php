<?php // $this->load->view('main/includes/headerscripts'); ?>
<!-- Post Content -->
<div class="container single_blog_page_container_a">
	<div class="row">
		
		<!-- Inner Content -->
		<div class="col-xl-8 col-lg-8 left_single_blog_a">
			<!-- Blog Post -->
			<div class="blog-post single-post single_post_content_a">

				<!-- Blog Post Thumbnail -->
				<div class="blog-post-thumbnail">
					<div class="blog-post-thumbnail-inner single_blog_image_a">
						<span class="blog-item-tag single_blog_a">POST</span>
						<img src="<?php if(isset($blog[0]['thumbnail'])) echo base_url().BLOG_UPLOAD.$blog[0]['thumbnail']; ?>" alt="">
					</div>
				</div>

				<!-- Blog Post Content -->
				<div class="blog-post-content single_blog_content_a">
					<h3 class="margin-bottom-10"><?php if(isset($blog[0]['title'])) echo $blog[0]['title']; ?></h3>

					<div class="blog-post-info-list margin-bottom-20">
						<a href="#" class="blog-post-info singlebblog_date_a"><?php if(isset($blog[0]['date'])) echo date('F d Y',strtotime($blog[0]['date'])); ?></a>
						<a href="#"  class="blog-post-info singleblog_views_a"><?php if(isset($blog[0]['views'])) echo $blog[0]['views']; ?> Views</a>
					</div>

					<?php if(isset($blog[0]['blog_post'])) if(DECODE_DESCRIPTIONS) echo html_entity_decode($blog[0]['blog_post']);  else echo ($blog[0]['blog_post']); ?>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25 singleblog_sharesection_a">
						<div class="share-buttons-trigger singleblog_share_a"><i class="fa fa-share-alt" aria-hidden="true"></i></div>
						<div class="share-buttons-content social_icons_postion_a">
							<span><?php echo $this->lang->line('lang_social_interesting');  ?> <strong><?php echo $this->lang->line('lang_social_share');  ?></strong></span>
							<div class="social_iconsingleblog"> 	
							<ul class="share-buttons-icons singleblog_share_icon_a">
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>" data-button-color="#3b5998" title="Share on <?php echo $this->lang->line('lang_social_facebook');  ?>" data-tippy-placement="top"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="https://twitter.com/intent/tweet?text=<?php echo current_url(); ?>" data-button-color="#1da1f2" title="Share on <?php echo $this->lang->line('lang_social_Twitter');  ?>" data-tippy-placement="top"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="#" data-button-color="#dd4b39" title="Share on <?php echo $this->lang->line('lang_social_Google');  ?>" data-tippy-placement="top"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=<?php echo current_url(); ?>" data-button-color="#0077b5" title="Share on <?php echo $this->lang->line('lang_social_linkedin');  ?>" data-tippy-placement="top"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- Blog Post Content / End -->
			
			<!-- Blog Nav -->
			<ul id="posts-nav" class="margin-top-0 margin-bottom-40 next_prev_single_blogpage_a">

				<li class="prev-post">
					<?php if(!empty($prevPost))	: ?>				
					<a href="<?php echo base_url().'blog/'.$prevPost[0]['slug'] ?>">
						<div class="prev_post_a">
						<span>Previous Post</span>
						</div>
						<strong><?php if(isset($prevPost[0]['title'])) echo $prevPost[0]['title'];  ?></strong>
					</a>
					<?php endif ?>
				</li>
				<li class="next-post">
					<?php if(!empty($nextPost)): ?>	
						<a href="<?php echo base_url().'blog/'.$nextPost[0]['slug'] ?>">
							<div class="next_post_a">
								<span>Next Post</span>
							</div>
							<strong><?php if(isset($nextPost[0]['title'])) echo $nextPost[0]['title'];  ?></strong>
						</a>
					<?php endif ?>
					
				</li>
				<input type="hidden" name="current_id" id="current_id" value="<?php if(isset($blog[0]['id'])) echo $blog[0]['id'];  ?>">
			</ul>
			
			<!-- Related Posts -->
			<div class="row">
				
			<!-- ad-section -->	
			<!--------------------------------------------------------------------------------------------------------------->
			<?php if(!empty($ads[0]['blog__post_page_720x90'])) { ?>					
			<div class="ad-section text-center margin-bottom-25">
				<?php print_r($ads[0]['blog__post_page_720x90']); ?>
			</div>
			<?php } ?>
			<!--------------------------------------------------------------------------------------------------------------->
			<!-- ad-section / End-->

			</div>
			<!-- Related Posts / End -->
				

			<!-- Comments -->
			<div class="boxed-list margin-bottom-60">
				<?php // if(!empty($this->session->userdata('user_id'))) { ?>
					<div class="boxed-list-headline comment_title_a">
						<h3><i class="fa fa-comments"></i> Comments</h3>
					</div>

					<div id="commentsSection"></div>
					<!--------------------------------------------------------------------------------------------------------------->
					<?php $this->load->view('main/add-ons/comments'); ?>
					<!--------------------------------------------------------------------------------------------------------------->
					<?php /*} else { ?>
					<div class="boxed-list-headline singleblog_loginsection_a">
						<h3><i class="fa fa-lock" aria-hidden="true"></i> Please <a href="<?php echo base_url().'login' ?>">login</a> to View Comments</h3>
					</div>	
				<?php } */?>


			</div>
			<!-- Comments / End -->

			<div class="col-md-12" style="margin-top: 50px;">
				<?php
                if (isset($blog_detail_page_right_side) && is_array($blog_detail_page_right_side) && count($blog_detail_page_right_side) > 0) {

                    for ($k = 0; $k < count($blog_detail_page_right_side); $k++) {

                        if (isset($blog_detail_page_right_side[$k]) && trim($blog_detail_page_right_side[$k]['text_or_icon']) != '') {
                            $img_url = FCPATH . CATEGORY_IMAGES . "/" . trim($blog_detail_page_right_side[$k]['text_or_icon']);

                            if (fileExists($img_url)) {

                                $img_url = base_url() . CATEGORY_IMAGES . "/" . trim($blog_detail_page_right_side[$k]['text_or_icon']); ?>
                                <div class="col-md-12 px-0 advertisement_box course_adv_a">
                                    <img src="<?php echo isset($img_url) ? $img_url : ''; ?>" alt="" title="" />
                                </div>

                <?php  }
                        }
                    }
                }
                ?>
			</div>


		</div>
		<!-- Inner Content / End -->


		<div class="col-xl-4 col-lg-4 content-left-offset single_post_blogsearch_a">

			<!-- ad-section -->	
			<!--------------------------------------------------------------------------------------------------------------->
			<?php if(!empty($ads[0]['blog__post_page_300x250'])) { ?>					
			<div class="ad-section text-center margin-bottom-25">
				<?php print_r($ads[0]['blog__post_page_300x250']); ?>
			</div>
			<?php } ?>
			<!--------------------------------------------------------------------------------------------------------------->
			<!-- ad-section / End-->

			<div class="sidebar-container ">
				
				<!-- Location -->
				<div class="sidebar-widget mb-4 d-none">
					<div class="input-with-icon single_blog_search_a">
						<input id="autocomplete-input" type="text" placeholder="Search">
						<i class="fa fa-search search_singlepost_a" aria-hidden="true"></i>
					</div>
				</div>

				<!-- Widget -->
				<div class="sidebar-widget single_post_page_blog_title_a">
					<h3>Trending Posts</h3>
					<ul class="widget-tabs single_blog_list_a">
						<?php foreach ($trendingPosts as $post) { ?>
						<!-- Post #1 -->
						<li>
							<a href="<?php echo base_url().'blog/'.$post['slug'] ?>" class="widget-content active">
								<img src="<?php if(isset($post['thumbnail'])) echo base_url().BLOG_UPLOAD.$post['thumbnail']; ?>" alt="">
								<div class="widget-text singlepost_titlewithpara_a">
									<h5><?php if(isset($post['title'])) echo $post['title']; ?></h5>
									<span><?php if(isset($post['date'])) echo date('F d Y',strtotime($post['date'])); ?></span>
								</div>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
				<!-- Widget / End-->

				<?php if(!empty($blog[0]['blog_tags'])) { ?>
				<!-- Tags Widget -->
				<div class="sidebar-widget tags_singleblog_a">
					<h3>Tags</h3>
					<div class="task-tags">
						<?php foreach (json_decode(html_entity_decode($blog[0]['blog_tags']),true) as $key) { ?>
							<a href="#"><span><?php echo $key; ?></span></a>
						<?php } ?>
					</div>
				</div>
				<?php } ?>

				<?php
                if (isset($blog_detail_page_right_side) && is_array($blog_detail_page_right_side) && count($blog_detail_page_right_side) > 0) {

                    for ($k = 0; $k < count($blog_detail_page_right_side); $k++) {

                        if (isset($blog_detail_page_right_side[$k]) && trim($blog_detail_page_right_side[$k]['text_or_icon']) != '') {
                            $img_url = FCPATH . CATEGORY_IMAGES . "/" . trim($blog_detail_page_right_side[$k]['text_or_icon']);

                            if (fileExists($img_url)) {

                                $img_url = base_url() . CATEGORY_IMAGES . "/" . trim($blog_detail_page_right_side[$k]['text_or_icon']); ?>
                                <div class="col-md-12 px-0 advertisement_box course_adv_a">
                                    <img src="<?php echo isset($img_url) ? $img_url : ''; ?>" alt="" title="" />
                                </div>

                <?php  }
                        }
                    }
                }
                ?>

			</div>
		</div>

	</div>
</div>
