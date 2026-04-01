<?php
session_start();
include 'connect.php';

if (isset($_POST['save'])) {
    $fn    = mysqli_real_escape_string($conn, trim($_POST['first_name']));
    $ln    = mysqli_real_escape_string($conn, trim($_POST['last_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $adid  = (int)$_SESSION['admin_id'];
    $q = mysqli_query($conn, "UPDATE admin SET name='$fn', surname='$ln', email='$email' WHERE admin_id='$adid'");
    if ($q) {
        $_SESSION['email'] = $email;
        $_SESSION['flash'] = ['type'=>'success','msg'=>'Profile updated successfully.'];
        header('Location: profile.php?edt=' . $adid);
        exit;
    }
    $saveError = 'Something went wrong. Please try again.';
}

$pageTitle = 'Profile';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Profile – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>

<?php include 'include/admin-nav.php'; ?>

<div class="page-hdr">
  <div>
    <h1>Profile</h1>
    <div class="breadcrumb-trail"><a href="dashboard.php">Dashboard</a> / Profile</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:260px 1fr;gap:20px;align-items:start;">

  <!-- Avatar card -->
  <div class="admin-card">
    <div class="admin-card-body" style="text-align:center;">
      <img src="assets/img/logo.png" alt="Avatar"
           style="width:80px;height:80px;border-radius:50%;border:3px solid var(--line);margin-bottom:14px;">
      <div style="font-weight:600;font-size:.95rem;"><?= $_nav_name ?></div>
      <div style="font-size:.78rem;color:var(--muted);margin-top:4px;"><?= htmlspecialchars($_SESSION['email'] ?? '') ?></div>
      <a href="logout.php" class="btn-adm danger" style="margin-top:18px;width:100%;justify-content:center;">
        <i class="fas fa-sign-out-alt"></i> Sign Out
      </a>
    </div>
  </div>

  <!-- Settings form -->
  <div class="admin-card">
    <div class="admin-card-hdr">
      <h5><i class="fas fa-cog" style="color:var(--brand);margin-right:7px;"></i>Account Settings</h5>
    </div>
    <div class="admin-card-body">
      <?php if (!empty($saveError)): ?>
      <div style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:10px 14px;font-size:.82rem;margin-bottom:14px;">
        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($saveError) ?>
      </div>
      <?php endif; ?>
      <form class="adm-form" method="post">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
          <div class="form-group">
            <label for="first_name">First Name</label>
            <input class="form-control" type="text" id="first_name" name="first_name"
                   placeholder="First name"
                   value="<?= htmlspecialchars($_nav_admin['name'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input class="form-control" type="text" id="last_name" name="last_name"
                   placeholder="Last name"
                   value="<?= htmlspecialchars($_nav_admin['surname'] ?? '') ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input class="form-control" type="email" id="email" name="email"
                 placeholder="admin@example.com"
                 value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>">
        </div>
        <button class="btn-adm primary" type="submit" name="save">
          <i class="fas fa-save"></i> Save Changes
        </button>
      </form>
    </div>
  </div>

</div>

<?php include 'include/admin-footer.php'; ?>
</body>
</html>
