<?php
$old = $_SESSION['old'] ?? [];
function old($key, $default = '') {
    global $old;
    return htmlspecialchars($old[$key] ?? $default, ENT_QUOTES);
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Emergency Response Team</title>
  <link href="form-style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h1 class="text-center">Emergency Response Team Management System</h1>

    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card p-4 shadow">

          <?php if(!empty($error ?? '')): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>

          <?php if(!empty($success ?? '')): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
          <?php endif; ?>

          <form method="POST" action="index.php">
            <div class="mb-3">
              <label class="form-label">Reporter Name</label>
              <input type="text" name="reporter" class="form-control" value="<?= old('reporter') ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Contact Number</label>
              <input type="text" name="contact" class="form-control" value="<?= old('contact') ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Incident Location</label>
              <input type="text" name="location" class="form-control" value="<?= old('location') ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Incident Type</label>
              <select name="type" class="form-select">
                <option value="">Select Type</option>
                <?php $types = ['Fire','Flood','Earthquake','Medical Emergency','Accident']; ?>
                <?php foreach($types as $t): ?>
                  <option <?= (old('type') === $t) ? 'selected' : '' ?>><?= htmlspecialchars($t) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Danger Level</label>
              <select name="danger" class="form-select">
                <option value="">Select Danger Level</option>
                <?php $levels = ['Low','Medium','High','Critical']; ?>
                <?php foreach($levels as $l): ?>
                  <option <?= (old('danger') === $l) ? 'selected' : '' ?>><?= htmlspecialchars($l) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="4"><?= old('description') ?></textarea>
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
                <th>Danger Level</th>
                <th>Date & Time</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($incidents)): ?>
                <?php foreach($incidents as $incident): ?>
                  <?php
                    $badgeClass = 'bg-secondary';
                    switch($incident['danger']) {
                      case 'Low': $badgeClass = 'bg-success'; break;
                      case 'Medium': $badgeClass = 'bg-warning text-dark'; break;
                      case 'High': $badgeClass = 'bg-warning'; break;
                      case 'Critical': $badgeClass = 'bg-danger'; break;
                    }
                  ?>
                  <tr>
                    <td><?= htmlspecialchars($incident['reporter']) ?></td>
                    <td><?= htmlspecialchars($incident['contact']) ?></td>
                    <td><?= htmlspecialchars($incident['location']) ?></td>
                    <td><?= htmlspecialchars($incident['type']) ?></td>
                    <td><span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($incident['danger']) ?></span></td>
                    <td><?= htmlspecialchars($incident['datetime']) ?></td>
                    <td><?= htmlspecialchars($incident['description']) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="7">No incidents yet.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
<?php
// clear old variables available to view
unset($old);
?>
