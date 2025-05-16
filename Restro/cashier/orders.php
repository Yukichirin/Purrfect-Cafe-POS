<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
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
  
  <div class="main-content">
    <!-- Top navbar -->
    <?php require_once('partials/_topnav.php'); ?>
    
    <div style="background-image: url(assets/img/theme/bjes.png); background-size: cover;" class="header pb-8 pt-5 pt-md-9">
      <span class="mask bg-gradient-dark opacity-5"></span>
      <div class="container-fluid">
        <div class="header-body"></div>
      </div>
    </div>
    
    <div class="container-fluid mt--8" >
      <div class="row">
        <div class="col-lg-6">
          <div class="card shadow" style="height: 500px; overflow-y: auto;" >
            <div class="card-header border-0" style="background-color: #f5f5dc;">
              <h3>Select Products</h3>
              <input type="text" id="barcodeInput" class="form-control" placeholder="Scan barcode...">
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush" style="background-color: #f5f5dc;">
                <thead class="thead-light">
                  <tr>
                    <th>Image</th>
                    <th>Barcode</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM rpos_products";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($prod = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td><img src="assets/img/products/<?= $prod->prod_img ?: 'default.jpg'; ?>" height="60" width="60" class="img-thumbnail"></td>
                      <td><?= $prod->barcode; ?></td>
                      <td><?= $prod->prod_name; ?></td>
                      <td>$ <?= $prod->prod_price; ?></td>
                      <td><button class="btn btn-sm btn-warning add-to-cart" data-id="<?= $prod->prod_id; ?>" data-name="<?= $prod->prod_name; ?>" data-price="<?= $prod->prod_price; ?>">Add</button></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <div class="col-lg-6">
          <div class="card shadow" style="height: 500px; overflow-y: auto; background-color: #f5f5dc;">
            <div class="card-header border-0" style="background-color: #f5f5dc;">
              <h3>Cart</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="cart-body">
                </tbody>
              </table>
            </div>
            <div class="card-footer text-right" style="background-color: #f5f5dc;">
              <h4>Total: $<span id="totalPrice">0.00</span></h4>
              <button class="btn btn-success" id="checkout">Checkout</button>
            </div>
          </div>
        </div>
      </div>
      <?php require_once('partials/_footer.php'); ?>
    </div>
  </div>

  <?php require_once('partials/_scripts.php'); ?>
  
  <script>
    let cart = {};

    function updateCart() {
      let cartBody = document.getElementById('cart-body');
      let totalPrice = 0;
      cartBody.innerHTML = '';
      for (let id in cart) {
        let item = cart[id];
        totalPrice += item.price * item.qty;
        cartBody.innerHTML += `
          <tr>
            <td>${item.name}</td>
            <td><input type='number' class='form-control qty' data-id='${id}' value='${item.qty}'></td>
            <td>$${item.price.toFixed(2)}</td>
            <td>$${(item.price * item.qty).toFixed(2)}</td>
            <td><button class='btn btn-danger btn-sm remove-item' data-id='${id}'>X</button></td>
          </tr>`;
      }
      document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
    }

    document.querySelectorAll('.add-to-cart').forEach(button => {
      button.addEventListener('click', () => {
        let id = button.getAttribute('data-id');
        let name = button.getAttribute('data-name');
        let price = parseFloat(button.getAttribute('data-price'));
        if (cart[id]) {
          cart[id].qty += 1;
        } else {
          cart[id] = { name, price, qty: 1 };
        }
        updateCart();
      });
    });

    document.getElementById('cart-body').addEventListener('click', (e) => {
      if (e.target.classList.contains('remove-item')) {
        let id = e.target.getAttribute('data-id');
        delete cart[id];
        updateCart();
      }
    });

    document.getElementById('cart-body').addEventListener('input', (e) => {
      if (e.target.classList.contains('qty')) {
        let id = e.target.getAttribute('data-id');
        let qty = parseInt(e.target.value);
        if (qty > 0) {
          cart[id].qty = qty;
        } else {
          delete cart[id];
        }
        updateCart();
      }
    });

    document.getElementById('barcodeInput').addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        let barcode = e.target.value;
        fetch(`fetch_product.php?barcode=${barcode}`)
          .then(response => response.json())
          .then(product => {
            if (product) {
              let id = product.prod_id;
              if (cart[id]) {
                cart[id].qty += 1;
              } else {
                cart[id] = { name: product.prod_name, price: parseFloat(product.prod_price), qty: 1 };
              }
              updateCart();
            }
          });
        e.target.value = '';

        
      }
      

      
    });
    document.getElementById('checkout').addEventListener('click', () => {
    let cartData = JSON.stringify(cart);
    
    // Send cart data to PHP using fetch
    fetch('save_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: cartData
    }).then(response => response.json()).then(data => {
        if (data.success) {
            window.location.href = 'payments.php';
        } else {
            console.error("Error storing cart data");
        }
    });
});

  </script>
</body>
</html>
