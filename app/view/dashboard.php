<?php require "layouts/header.php"; ?>
<?php require "layouts/navbar.php"; ?>

<div class="container mt-5">

<h2>Welcome <?= $_SESSION["user"]["username"] ?></h2>

<?php if(isset($_COOKIE["remember_user"])): ?>

<p>Cookie User: <?= $_COOKIE["remember_user"] ?></p>

<?php endif; ?>

<a href="index.php?action=incident" class="btn btn-dark mt-3">
Manage Incidents
</a>

</div>

<?php require "layouts/footer.php"; ?>