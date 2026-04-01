<?php
session_start();
include 'connect.php';

$id = isset($_GET['edt']) ? (int)$_GET['edt'] : 0;    // admin_id from session if needed

if (isset($_POST['add'])) {
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);
    $adid    = (int)$_SESSION['admin_id'];
    $exists  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT category_id FROM gallery_category WHERE category='$heading' LIMIT 1"));
    if ($exists) {
        $formError = 'That category name already exists.';
    } else {
        $q = mysqli_query($conn, "INSERT INTO gallery_category(admin_id,category) VALUES('$adid','$heading')");
        if ($q) { $_SESSION['flash'] = ['type'=>'success','msg'=>'Category added successfully.']; header('Location: g-category.php'); exit; }
        $formError = 'Something went wrong. Please try again.';
    }
}

$pageTitle = 'Add Gallery Category';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Add Gallery Category – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>
<?php include 'include/admin-nav.php'; ?>
<a href="g-category.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Categories</a>
<div class="page-hdr"><div><h1>Add Gallery Category</h1></div></div>
<?php if (!empty($formError)): ?>
<div style="background:#fee2e2;color:#dc2626;border-radius:10px;padding:12px 16px;font-size:.83rem;margin-bottom:16px;">
  <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($formError) ?>
</div>
<?php endif; ?>
<div class="admin-card" style="max-width:480px;">
  <div class="admin-card-hdr"><h5><i class="fas fa-folder-plus" style="color:var(--brand);margin-right:7px;"></i>New Category</h5></div>
  <div class="admin-card-body">
    <form class="adm-form" method="post">
      <div class="form-group">
        <label for="heading">Category Name</label>
        <input class="form-control" type="text" id="heading" name="heading" required
               value="<?= htmlspecialchars($_POST['heading'] ?? '') ?>">
      </div>
      <button class="btn-adm primary" type="submit" name="add"><i class="fas fa-plus"></i> Add Category</button>
    </form>
  </div>
</div>
<?php include 'include/admin-footer.php'; ?>
</body>
</html>
