<?php //print_r($listingOptions);exit;
$listing_type_arr = array('Regular' => 1, 'Highlighted' => 2, 'Premium' => 3);?>
<div class="col-xl-6 col-md-4">
        <div class="submit-field">
            <h5>Select Type</h5>
            
            <select class="form-control with-border" name="listing_header_priority" >
            <?php if (isset($listingOptions)) {

                foreach ($listingOptions as $option) {?>
                    <option <?php echo 	$listing_data[0]['listing_header_priority'] == $listing_type_arr[trim($option['listing_name'])] ? 'selected="selected"': '' ?> value="<?php echo $option['listing_id'] ?>"><?php echo $option['listing_name']; ?></option>
                <?php } 
            } ?>
            </select>
            
        </div>
    </div>
    <div class="col-xl-6 col-md-4">
        <div class="submit-field">
            <h5>Select Sponsorship</h5>
            
            <select class="form-control with-border" name="sponsorship_priority" >
            <option value="">Select Sponsorship </option>
            <?php if (isset($sponsorOptions)) {
                
                foreach ($sponsorOptions as $option) {?>
                    <option <?php echo 	$listing_data[0]['sponsorship_priority'] == array_search($option['listing_id'], LISTING_HEADER_SPONSORSHIP) ? 'selected="selected"': '' ?> value="<?php echo $option['listing_id'] ?>"><?php echo $option['listing_name']; ?></option>
                <?php } 
            } ?>
            </select>
            
        </div>
    </div>
<!--  end -->

