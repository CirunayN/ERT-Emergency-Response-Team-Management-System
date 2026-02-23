<?php require "../app/view/layouts/header.php"; ?>
<?php require "../app/view/layouts/navbar.php"; ?>

<div class="container mt-5 col-md-4">
    <div class="card p-4 shadow">

        <h3 class="text-center mb-3">Login</h3>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=login">

            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            <button class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center mt-3">
            No account? <a href="index.php?action=signup">Signup here</a>
        </p>

    </div>
</div>

<?php require "../app/view/layouts/footer.php"; ?>