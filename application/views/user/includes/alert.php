<?php
if (!empty($this->session->userdata('buy_message'))) { ?>
    <div class="alert alert-success">
        <?php
        echo  $this->session->userdata('buy_message');
        $this->session->unset_userdata('buy_message');
        ?>
    </div>
<?php } ?>