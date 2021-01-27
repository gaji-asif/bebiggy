        <ul class="comment-section-auction after_logincommentsection_a">

            <div id="prev-comments">

            <?php if(!empty($comments)) { foreach ($comments as $comment) { 

            if($comment['author_comment'] !== '1') {
            ?>

			<li  class="comment-auction user-comment">

                <div class="info-comments">
                    <a href="#"><?php if(isset($comment['user_name'])) echo $comment['user_name']; ?></a>
                    <span><?php if(isset($comment['ago'])) echo $comment['ago']; ?></span>
                    <input type="hidden" name="comment_id" id="comment_id" value="<?php if(isset($comment['id'])) echo $comment['id']; ?>">
                </div>

<!--                 
                <a class="avatar-comments" href="#">
                    <img src="<?php //echo base_url().USER_UPLOAD.$comment['thumbnail']; ?>" width="35" alt="Profile Avatar" title="<?php if(isset($comment['user_name'])) echo $comment['user_name']; ?>" />
                </a> -->

                <p><?php if(isset($comment['body'])) echo $comment['body']; ?></p>

			</li>

            <?php } else { ?>

			<li class="comment-auction author-comment">

                <div class="info-comments">
                    <a href="#"><?php if(isset($comment['user_name'])) echo $comment['user_name']; ?> (Author)</a> 
                    <span><?php if(isset($comment['ago'])) echo $comment['ago']; ?></span>
                    <input type="hidden" name="comment_id" id="comment_id" value="<?php if(isset($comment['id'])) echo $comment['id']; ?>">
                </div>

                <a class="avatar-comments" href="#">
                    <img src="<?php echo base_url().USER_UPLOAD.$comment['thumbnail']; ?>" width="35" alt="Profile Avatar" title="Jack Smith" />
                </a>

                <p><?php if(isset($comment['body'])) echo $comment['body']; ?></p>

			</li>

            <?php  } } } else { ?>

            <li  class="comment-auction user-comment">

                <div class="info-comments comment_no_section_a">
                    <a href="#"><?php echo $this->lang->line('lang_nocomments'); ?></a>
                    <span></span>
                </div>
            </li>
            <?php } ?>

            </div>
            <div class="col-md-12">
                <!-- Pagination -->
                <div class="row pagination_div pagi_top w-100 blog_page_pagination_a">
                    <nav class="pagination w-100" aria-label="Page navigation example">
                        <ul class="pagination justify-content-center w-100" style="margin:20px 0">
                            <?php if(!empty($links)) if(isset($links)) { echo $links; }?>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination / End -->
            </div>

            <li class="write-new">

                <form id="commentsForm" class="forms-control" method="post" enctype="multipart/form-data">

                    <textarea placeholder="Write your comment here" name="write_comment" id="write_comment" required="true" class="comment_section_a"></textarea>

                    <?php if(empty($this->session->userdata('user_id'))): ?>
                        <input type="text" required="true" name="user_name" class="form-control" placeholder="Enter your name here" >
                    <?php  else: ?>
                        <input type="hidden" name="user_name" value="<?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?>" >
                    <?php endif ?>
                    <input type="hidden" name="logged_user" id="logged_user" value="<?php echo !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0 ?>">
                    <?php if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_id') === $ownerData[0]['user_id']) { ?>
                    <input type="hidden" name="author_comment" id="author_comment" value="1">
                    <?php } else { ?>
                    <input type="hidden" name="author_comment" id="author_comment" value="0">
                    <?php }?>
                    <?php if($comment_section === 'listing') { ?>
                        <input type="hidden" name="comment_listing" id="comment_listing" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id'];  ?>">
                    <?php } else { ?>
                        <input type="hidden" name="comment_listing" id="comment_listing" value="<?php if(isset($blog[0]['id'])) echo $blog[0]['id'];  ?>">
                    <?php } ?>
                    <input type="hidden" name="comment_section" id="comment_section" value="<?php if(isset($comment_section)) echo $comment_section;  ?>">

                    <div class="image_user_commment_a">
                        <?php if(!empty($this->session->userdata('user_id'))):?>
                                <?php if (fileExists(FCPATH.USER_UPLOAD.$userdata[0]['thumbnail'])) : ?>
                                    <img src="<?php echo base_url().USER_UPLOAD.$userdata[0]['thumbnail']; ?>" width="35" alt="<?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?>" title="Bradley Jones" />
                                <?php endif ?>
                            Logged in as <a href="#"><?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?></a>
                        <?php endif ?>
                        <div id="commentsVal"></div>
                        <button class="slippa-btn slippa-gradient comment_submit_a" type="submit">Submit</button>
                    </div>

                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                </form>

            </li>

		</ul>