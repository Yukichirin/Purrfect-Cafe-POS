<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; // Keep as string since it's a unique ID
    $adn = "DELETE FROM rpos_products WHERE prod_id = ?";
    $stmt = $mysqli->prepare($adn);

    if ($stmt) {
        $stmt->bind_param('s', $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $success = "Product Deleted Successfully!" && header("refresh:1; url=products.php");
        } else {
            $err = "Deletion failed. Product not found.";
        }

        $stmt->close();
    } else {
        $err = "Query preparation failed.";
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
  <?php
  require_once('partials/_sidebar.php');
  ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php
    require_once('partials/_topnav.php');
    ?>
    <!-- Header -->
    <div style="background-image: url(assets/img/theme/bjes.png); background-size: cover;" class="header  pb-8 pt-5 pt-md-9">
    <span class="mask bg-gradient-dark opacity-5"></span>
      <div class="container-fluid">
        <div class="header-body">
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            
            <div class="table-responsive">
              <table class="table align-items-center table-flush" style="background-color: #f5f5dc;">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Barcode</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  rpos_products ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($prod = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td>
                        <?php
                        if ($prod->prod_img) {
                          echo "<img src='assets/img/products/$prod->prod_img' height='60' width='60' class='img-thumbnail'>";
                        } else {
                          echo "<img src='assets/img/products/default.jpg' height='60' width='60' class='img-thumbnail'>";
                        }
                        ?>
                      </td>
                      <td><?php echo $prod->barcode; ?></td>
                      <td><?php echo $prod->prod_name; ?></td>
                      <td>$ <?php echo $prod->prod_price; ?></td>
                      <td>

                        <a href="update_product.php?update=<?php echo $prod->prod_id; ?>">
                          <button class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                            Update
                          </button>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php
      require_once('partials/_footer.php');
      ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>
</html>