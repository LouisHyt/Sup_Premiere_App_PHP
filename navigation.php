<?php
  session_start();
  $productsCount = isset($_SESSION['products']) ? count($_SESSION['products']) : "0";
?>

<header class="ui pointing menu">
  <a class="dashboard item <?= ($currentRoute == 'dashboard') ? 'active': '' ?>" href="?">
    Dashboard
  </a>
  <a class="recap item <?= ($currentRoute == 'recap') ? 'active': '' ?>" href="?route=recap">
    Recap
    <p class="product_count"> <?= $productsCount ?></p>
  </a>
</div>
</header>