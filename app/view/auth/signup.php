<?php require "../app/view/layouts/header.php"; ?>
<?php require "../app/view/layouts/navbar.php"; ?>

<div class="container mt-5 col-md-4">
    <div class="card p-4 shadow">

        <h3 class="text-center mb-3">Signup</h3>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if(!empty($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=signup">

            <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>

            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            <input type="password" name="confirm" class="form-control mb-3" placeholder="Confirm Password" required>

            <button class="btn btn-primary w-100">Signup</button>
        </form>

    </div>
</div>

<?php require "../app/view/layouts/footer.php"; ?>