<nav class="navbar navbar-expand-lg navbar-light bg-light" style="z-index:99">
  <a class="navbar-brand" href="#">Musical-Instrument</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <ul class="navbar-nav navbar-center">

      <?php 

      if(array_key_exists('user', $_SESSION)){
       ?>
       
      <?php 
      if($_SESSION['user']['role_id'] == 1){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="items.php">Items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">Users</a>
        </li>

        <?php
      } else {
        ?>

        <li class="nav-item">
          <a class="nav-link" href="catalog.php">Catalog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><span class="badge badge-dark" id="cart_count"><?php echo array_sum($_SESSION['cart']); ?></span> Cart</a>
        </li>

        <?php
      }

      ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo ucwords($_SESSION['user']['firstname']); ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="../controllers/logout_endpoint.php">Logout</a>
        </div>
      </li>
      <?php
    } else {
      ?>

      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="catalog.php">Catalog</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="cart.php"><span class="badge badge-dark" id="cart_count"><?php echo array_sum($_SESSION['cart']); ?></span> Cart</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>

      <?php
    }

    ?>


    

  </ul>
</div>

</nav>