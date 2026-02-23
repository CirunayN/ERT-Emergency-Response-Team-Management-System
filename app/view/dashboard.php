<?php require "../app/view/layouts/header.php"; ?>
<?php require "../app/view/layouts/navbar.php"; ?>

<div class="container mt-5">

    <h2>Welcome, <?= $_SESSION["user"]["username"]; ?> 👋</h2>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Manage Incidents</h5>
                <a href="index.php?action=incident" class="btn btn-primary mt-2">Open</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Team Members</h5>
                <button class="btn btn-secondary mt-2" disabled>Coming Soon</button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Reports & Analytics</h5>
                <button class="btn btn-secondary mt-2" disabled>Coming Soon</button>
            </div>
        </div>

    </div>
</div>

<?php require "../app/view/layouts/footer.php"; ?>