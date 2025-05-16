<?php
$admin_id = $_SESSION['admin_id'];
$ret = "SELECT * FROM rpos_admin WHERE admin_id = ?";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('s', $admin_id);
$stmt->execute();
$res = $stmt->get_result();
while ($admin = $res->fetch_object()) {
    // Set profile image path (use default if empty)
    $profile_pic = !empty($admin->admin_profile_pic) ? $admin->admin_profile_pic : 'assets/img/theme/user-a-min.png';
?>
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="dashboard.php">
                <?php echo $admin->admin_name; ?> Dashboard
            </a>

            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img 
                                    alt="Profile Image" 
                                    src="<?php echo $profile_pic; ?>" 
                                    style="width: 40px; height: 40px; object-fit: cover; object-position: center;">
                            </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold"><?php echo $admin->admin_name; ?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <a href="change_profile.php" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>My profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
<?php } ?>
