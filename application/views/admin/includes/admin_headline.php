<!-- Dashboard Headline -->
<div class="dashboard-headline">
    <div class="dashboad_table">
        <i class="icon-material-outline-dashboard"></i>
        <h3>Admin Dashboard</h3>
        <div class="ml-auto dropdown user_name">
            <div class="get_user dropdown-toggle" data-toggle="dropdown">AD</div>
            <div class="dropdown-menu">
                <a href="<?php echo base_url(); ?>admin/user_settings" class="dropdown-item"><i class="icon-material-outline-settings"></i> Settings</a>
                <li class="divider"></li>
                <a href="<?php echo base_url(); ?>admin/change_password" class="dropdown-item"><i class="icon-material-outline-lock"></i> Change Password</a>
                <a href="<?php echo base_url(); ?>admin/logout" class="dropdown-item"><i class="icon-material-outline-power-settings-new"></i> Logout</a>
            </div>
        </div>
    </div>
</div>