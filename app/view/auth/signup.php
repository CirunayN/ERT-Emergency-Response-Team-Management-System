<?php require __DIR__ . "/../layouts/header.php"; ?>
<?php require __DIR__ . "/../layouts/navbar.php"; ?>

<div class="container mt-5 col-md-4">
    <div class="card p-4 shadow">

        <h3 class="text-center mb-3">Signup</h3>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=signup">

            <div class="mb-3">
                <label class="form-label text-light">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Confirm Password</label>
                <input type="password" name="confirm" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Signup</button>
        </form>

    </div>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>