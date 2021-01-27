<?php

if (in_array($this->session->userdata('user_id'), ALLOW_USER)) :  ?>
    <!-- <div class="col-md-6">
        <div class="submit-field">
            <h5>Show Product on page</h5>
            <select id="display_on_page" name="display_on_page[]" class="js-example-basic-multiple with-border" multiple>
                <?php


                if (isset($page)) {
                    $display_page =  explode(",", $page);
                }

                foreach (PAGESNAME as $v1) {
                    if (isset($display_page)) {
                        $selected = "";
                        if (in_array($v1, $display_page)) {
                            $selected = "selected";
                        }
                      //  echo "<option value='" . str_rep($v1) . "' $selected >" . str_rep($v1) . "</option>";
                    } else {
                        //echo "<option value='" . str_rep($v1) . "'>" . str_rep($v1) . "</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="submit-field">
            <h5>Show Product Section on page</h5>
            <select id="frontend_section" name="frontend_section" class="with-border">
                <option value="">Select Option </option>";
                <?php

                foreach (SECTION as $k => $v) {
                    $selecte = "";
                    if (!empty($section)) {
                        if ($section == $k)
                            $selecte = 'selected';
                    }
                   //\ echo "<option value='$k' $selecte >" . ucwords(strtolower($v)) . "</option>";
                } ?>
            </select>
        </div>
    </div> -->
<?php endif;  ?>