<!------Admin Changer Model------>
<div class="modal fade" id="change-listing" tabindex="-1" role="dialog" aria-labelledby="change-listing" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-gradient-danger">
      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">LISTING CONTROLS - ADMIN</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="card">
        <div class="card-body">
          <!---card--->
          <div class="modal-body">
            <form id="modalListingChanger" class="forms-control" method="post" enctype="multipart/form-data" />
            <div id="notification"></div>
            <span id="loader" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>

            <h4 class="margin-bottom-15"><strong>LISTINGS</strong></h4>

            <div class="row">

              <div class="form-group col-md-6">
                <label>SPONSORE LISTING FOR (DAYS)</label>
                <input type="number" class="form-control" id="sponsore_listing" name="sponsore_listing" />
              </div>

              <div class="form-group col-md-6">
                <label>EXTEND LISTING DATE IN (DAYS)</label>
                <input type="number" class="form-control" id="listing_extend" name="listing_extend" />
              </div>
            </div>

            <div class="col-12 grid-margin stretch-card">
              <div class="form-group">
                <button id="change-sponsored-listing" type="submit" class="btn btn-success mr-2">UPDATE</button>
              </div>
            </div>

            <input type="hidden" id="plan-id" name="plan-id">
            <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            </form>
          </div>

          <div class="modal-footer">

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Admin Changer Model -->


<!------Show solution page data Model------>
<div class="modal fade" id="solution_select_page_a" tabindex="-1" role="dialog" aria-labelledby="change-listing" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-gradient-danger">
      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">LISTING CONTROLS - ADMIN</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="card">
        <div class="card-body">
          <!---card--->
          <div class="modal-body list_scroll">
            <form id="updateSolutionPage" action="<?php echo site_url('admin/updateSolutionPage'); ?>" method="post">

              <div id="notification"></div>
              <span id="loader" style="display:none;"> <img src="<?php echo base_url(); ?>assets/img/loadingimage.gif" /> </span>
              <div class="row">
                <div class="col-md-6">
                  <h4 class="margin-bottom-15"><strong>LISTINGS On Page - </strong> <strong id="name_popup" data-name-popup></strong> </h4>
                </div>
                <div class="col-md-6">
                  <button id="addListOption" class="btn btn-primary mr-2 btnplustheme_color_a"><i class="fa fa-plus" aria-hidden="true"></i></button>

                </div>
              </div>

              <input type="hidden" name="solution_id" id="solution_id_page">

              <div id="select_solution_id">



              </div>
          </div>

          <div class="modal-footer">
            <div class="col-12 grid-margin stretch-card">
              <div class="form-group">
                <button id="updateSolutionPageBtn" type="submit" class="btn btn-success mr-2 btnplustheme_color_a">UPDATE</button>
              </div>
            </div>

            <!-- <input type="hidden" id="plan-id" name="plan-id"> -->
            <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            </form>


          </div>

        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('.js-example-basic-multiple').select2();

      });
    </script>
  </div>
</div>
<!-- / Show solution page data Model -->