<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');
require_once('partials/_analytics.php');

// Total number of products
$query = "SELECT COUNT(*) AS total_products FROM rpos_products";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$products = $row['total_products'];

// Total number of orders
$query = "SELECT COUNT(*) AS total_orders, IFNULL(SUM(total_price), 0) AS total_sales FROM orders";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$orders = $row['total_orders'];
$sales = $row['total_sales'];
?>

<body>
<style>
  body {
    background-color: #b09081;
  }
</style>

<?php require_once('partials/_sidebar.php'); ?>

<div class="main-content">
  <?php require_once('partials/_topnav.php'); ?>

  <div style="background-image: url(assets/img/theme/bjes.png); background-size: cover;" class="header pb-8 pt-5 pt-md-8">
    <span class="mask bg-gradient-dark opacity-5"></span>
    <div class="container-fluid">
      <div class="header-body">
        <div class="row">
          <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0" style="background-color: #f5f5dc;">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Products</h5>
                    <span class="h2 font-weight-bold mb-0"><?php echo $products; ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                      <i class="fas fa-utensils"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0" style="background-color: #f5f5dc;">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Orders</h5>
                    <span class="h2 font-weight-bold mb-0"><?php echo $orders; ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0" style="background-color: #f5f5dc;">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                    <span class="h2 font-weight-bold mb-0">$<?php echo number_format($sales, 2); ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- row -->
      </div>
    </div>
  </div>

  <div class="container-fluid mt--7">
    <div class="row mt-5">
      <div class="col-xl-12 mb-5 mb-xl-0" style="background-color: #f5f5dc;">
        <div class="card shadow">
          <div class="card-header border-0 d-flex justify-content-between align-items-center" style="background-color: #f5f5dc;">
            <h3 class="mb-0">Total Sales by Product</h3>
            <select id="salesFilter" class="form-control w-auto">
              <option value="today">Today</option>
              <option value="yesterday">Yesterday</option>
              <option value="this_week">This Week</option>
              <option value="this_month" selected>This Month</option>
            </select>
          </div>
          <div class="card-body">
            <canvas id="salesChart" style="width:100%; height:400px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <?php require_once('partials/_footer.php'); ?>
  </div>
</div>

<?php require_once('partials/_scripts.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('salesChart').getContext('2d');
  let salesChart;

  function loadSalesData(filter = 'this_month') {
    fetch(`fetch_sales_data.php?filter=${filter}`)
      .then(res => res.json())
      .then(data => {
        if (salesChart) {
          salesChart.data.labels = data.labels;
          salesChart.data.datasets[0].data = data.sales;
          salesChart.update();
        } else {
          salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: data.labels,
              datasets: [{
                label: 'Total Sales by Product ($)',
                data: data.sales,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    callback: value => '$' + value
                  }
                }
              }
            }
          });
        }
      })
      .catch(error => console.error('Error loading sales data:', error));
  }

  document.getElementById('salesFilter').addEventListener('change', function () {
    loadSalesData(this.value);
  });

  // Initial load
  window.addEventListener('DOMContentLoaded', () => {
    loadSalesData(document.getElementById('salesFilter').value);
  });
</script>
</body>
</html>
