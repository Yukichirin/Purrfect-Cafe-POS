<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();

// Initialize variables to avoid undefined variable warning
$letters = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);  // Random 3 letters
$numbers = rand(100, 999);  // Random 3 digits
$admin_number = $letters . "-" . $numbers;  // Combine letters and numbers

//Add Admin
if (isset($_POST['addAdmin'])) {
  // Prevent Posting Blank Values
  if (empty($_POST["admin_name"]) || empty($_POST['admin_email']) || empty($_POST['admin_password']) || empty($_FILES['admin_profile_pic']['name'])) {
    $err = "Blank Values Not Accepted";
  } else {
    // Admin Name, Email, and Password
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = sha1(md5($_POST['admin_password']));

    // Handle the Profile Picture upload
    $target_dir = "uploads/";  // Directory to store the profile picture
    $target_file = $target_dir . basename($_FILES["admin_profile_pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an image
    if (isset($_POST["submit"])) {
      $check = getimagesize($_FILES["admin_profile_pic"]["tmp_name"]);
      if ($check !== false) {
        $uploadOk = 1;
      } else {
        $err = "File is not an image.";
        $uploadOk = 0;
      }
    }

    // Check file size (limit to 5MB)
    if ($_FILES["admin_profile_pic"]["size"] > 5000000) {
      $err = "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      $err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $err = "Sorry, your file was not uploaded.";
    } else {
      // If everything is ok, try to upload the file
      if (move_uploaded_file($_FILES["admin_profile_pic"]["tmp_name"], $target_file)) {
        $admin_profile_pic = $target_file;  // Save the file path to the database

        // Insert Captured information to the database table
        $postQuery = "INSERT INTO rpos_admin (admin_number, admin_name, admin_email, admin_password, admin_profile_pic) VALUES(?,?,?,?,?)";
        $postStmt = $mysqli->prepare($postQuery);
        // Bind parameters
        $rc = $postStmt->bind_param('sssss', $admin_number, $admin_name, $admin_email, $admin_password, $admin_profile_pic);
        $postStmt->execute();
        // Declare a variable which will be passed to alert function
        if ($postStmt) {
          $success = "Admin Added" && header("refresh:1; url=hrm.php");
        } else {
          $err = "Please Try Again Or Try Later";
        }
      } else {
        $err = "Sorry, there was an error uploading your file.";
      }
    }
  }
}

require_once('partials/_head.php');
?>

<body>
  <style>
    body {
      background-color: #b09081;
    }
  </style>
  <!-- Sidenav -->
  <?php require_once('partials/_sidebar.php'); ?>

  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php require_once('partials/_topnav.php'); ?>

    <!-- Header -->
    <div style="background-image: url(assets/img/theme/bg.jpg); background-size: cover;" class="header pb-8 pt-5 pt-md-8">
      <span class="mask bg-gradient-dark opacity-5"></span>
      <div class="container-fluid">
        <div class="header-body"></div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--8">
      <!-- Admin Add Form -->
      <div class="row">
        <div class="col">
          <div class="card shadow" style="background-color: #f5f5dc;">
            <div class="card-header border-0" style="background-color: #f5f5dc;">
              <h3>Please Fill All Fields</h3>
            </div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-6">
                    <label>Admin Number</label>
                    <input type="text" name="admin_number_display" class="form-control" value="<?php echo $admin_number; ?>" disabled>
                  </div>
                  <div class="col-md-6">
                    <label>Admin Name</label>
                    <input type="text" name="admin_name" class="form-control" required>
                  </div>
                </div>
                <hr>
                <div class="form-row">
                  <div class="col-md-6">
                    <label>Admin Email</label>
                    <input type="email" name="admin_email" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label>Admin Password</label>
                    <input type="password" name="admin_password" class="form-control" required>
                  </div>
                </div>
                <hr>
                <div class="form-row">
                  <div class="col-md-6">
                    <label>Admin Profile Picture</label>
                    <input type="file" name="admin_profile_pic" class="form-control" accept="image/*" required>
                  </div>
                </div>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="addAdmin" value="Add Admin" class="btn btn-success">
                  </div>
                </div>
              </form>
              <?php
              if (isset($err)) {
                echo "<div class='alert alert-danger mt-3'>$err</div>";
              }
              if (isset($success)) {
                echo "<div class='alert alert-success mt-3'>Admin Added Successfully</div>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php require_once('partials/_footer.php'); ?>
    </div>
  </div>

  <!-- Argon Scripts -->
  <?php require_once('partials/_scripts.php'); ?>
</body>

</html>
