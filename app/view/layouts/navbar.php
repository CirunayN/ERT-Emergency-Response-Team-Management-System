<?php
$loggedIn = isset($_SESSION["user"]);
$username = $_SESSION["user"]["username"] ?? '';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow">
  <div class="container">

    <a class="navbar-brand fw-bold" href="index.php?action=dashboard">
      🚑 ERT Management
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <?php if($loggedIn): ?>
        <ul class="navbar-nav me-auto">

          <li class="nav-item">
            <a class="nav-link" href="index.php?action=dashboard">
              Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?action=incident">
              Manage Incidents
            </a>
          </li>

        </ul>

        <ul class="navbar-nav ms-auto align-items-center">

          <li class="nav-item me-3 text-white">
            👤 <?= htmlspecialchars($username) ?>
          </li>

          <li class="nav-item">
            <a href="index.php?action=logout" class="btn btn-light btn-sm">
              Logout
            </a>
          </li>

        </ul>

      <?php else: ?>

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=signup">Signup</a>
          </li>
        </ul>

      <?php endif; ?>

    </div>
  </div>
</nav>