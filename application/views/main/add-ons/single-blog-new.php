<?php $i = 0; $add_class = ''; foreach ($blogs as $key => $post) { 
    ?>
    <div class="col-md-4 col-sm-12 h-100">
        <a href="<?php echo base_url().'blog/'.$post['slug'] ?>" class="blog-post">
            <div class="box_blog_a mb-3">
                <div class="card shadow each_blog_a">
                    <div class="card-header">
                        <?php
                        
                        $img_url = base_url().BLOG_UPLOAD.'banner-10.jpg';
                        if(isset($post['thumbnail'])){
                            $img_url = FCPATH.BLOG_UPLOAD.$post['thumbnail'];  
                            
                            if(fileExists($img_url)) {
                                
                                $img_url = base_url().BLOG_UPLOAD.$post['thumbnail'];  
                            } else {
                                $img_url = base_url().BLOG_UPLOAD.'banner-10.jpg';
                            }
                        } else {
                            $img_url = base_url().BLOG_UPLOAD.'banner-10.jpg';
                        }
                        ?>
                        <img src="<?php echo $img_url; ?>" class="w-100"></div>
                    <div class="card-body">
                        <div class="author_box_a">
                            <div class="title_blog_a">
                                <h5><?php if(isset($post['title'])) echo $post['title']; ?></h5>
                            </div>
                            <div class="row">
                                <div class="blog_author_a">
                                    <h6>By: <?php if(isset($ownerData[0]['username'])) echo $ownerData[0]['username']; ?></h6>
                                    <span class="center_divider_a">|</span>
                                    <h6>
                                        <?php if(isset($post['date'])) echo date('F d Y',strtotime($post['date'])); ?>    
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="blog_content">
                            <p><?php if(isset($post['metadescription'])) echo substr($post['metadescription'], 0,45); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

<?php 
    
    $i++; 
} 
?>

<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
<div class="col-md-12">
    <!-- Pagination -->
    <!-- <div class="pagination-container margin-top-40 margin-bottom-10 centerButtons"> -->
    <div class="row pagination_div pagi_top w-100">
	    <nav class="pagination paginationBlog w-100" aria-label="Page navigation example">
	        <ul class="pagination justify-content-center w-100" style="margin:20px 0">
	            <?php if(!empty($links)) if(isset($links)) { echo $links; }?>
	        </ul>
	    </nav>
    </div>
    <div class="clearfix"></div>
    <!-- Pagination / End -->
</div>