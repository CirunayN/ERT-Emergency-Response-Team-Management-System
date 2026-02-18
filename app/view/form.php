<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Emergency Response Team Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="public/form-style.css">
    </head>

    <body>

        <h1 class="text-center">Emergency Response Team Management System</h1>

        <div class="container mt-4">
        <div class="row">


        <div class="col-md-4">
        <div class="card p-4 shadow">

        <?php if($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="">

        <div class="mb-3">
            <label class="form-label">Reporter Name</label>
            <input type="text" name="reporter" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Contact Number</label>
            <input type="text" name="contact" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Incident Location</label>
            <input type="text" name="location" value="<?php echo $prefillLocation; ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Incident Type</label>
            <select name="type" class="form-select">
                <option value="">Select Type</option>
                <option>Fire</option>
                <option>Flood</option>
                <option>Earthquake</option>
                <option>Medical Emergency</option>
                <option>Accident</option>
            </select>
        </div>

        <div class="mb-3">
        <label class="form-label">Severity Level</label>
        <select name="severity" class="form-select">
            <option value="">Select Severity</option>
            <option>Low</option>
            <option>Medium</option>
            <option>High</option>
            <option>Critical</option>
        </select>
        </div>

        <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Report Incident</button>
        </form>
        </div>
        </div>


        <div class="col-md-8">
        <div class="card p-4 shadow">
        <table class="table table-bordered text-center table-hover">
        <thead class="table-dark">
        <tr>
            <th>Reporter</th>
            <th>Contact</th>
            <th>Location</th>
            <th>Type</th>
            <th>Severity</th>
            <th>Date & Time</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if (!empty($incidents)) {
            foreach ($incidents as $incident) {

                
                $badgeClass = "";
                switch($incident['severity']) {
                    case "Low":
                        $badgeClass = "bg-success";
                        break;
                    case "Medium":
                        $badgeClass = "bg-warning text-dark";
                        break;
                    case "High":
                        $badgeClass = "bg-orange";
                        break;
                    case "Critical":
                        $badgeClass = "bg-danger";
                        break;
                }

                echo "<tr>
                <td>{$incident['reporter']}</td>
                <td>{$incident['contact']}</td>
                <td>{$incident['location']}</td>
                <td>{$incident['type']}</td>
                <td><span class='badge {$badgeClass}'>{$incident['severity']}</span></td>
                <td>{$incident['datetime']}</td>
                </tr>";
            }
        }
        ?>
        </tbody>
        </table>

        </div>
        </div>

        </div>
        </div>

    </body>
</html>