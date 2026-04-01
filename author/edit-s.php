<?php
session_start();
include 'connect.php';

$id = isset($_GET['edt']) ? (int)$_GET['edt'] : 0;

if (isset($_POST['add'])) {
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);
    $exists  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT category_id FROM blog_category WHERE category='$heading' AND category_id != '$id' LIMIT 1"));
    if ($exists) {
        $formError = 'That category name is already taken.';
    } else {
        $q = mysqli_query($conn, "UPDATE blog_category SET category='$heading' WHERE category_id='$id'");
        if ($q) { header('Location: s-category.php'); exit; }
        $formError = 'Something went wrong. Please try again.';
    }
}

$qry = mysqli_query($conn, "SELECT * FROM blog_category WHERE category_id='$id' LIMIT 1");
$cat = $qry ? mysqli_fetch_assoc($qry) : null;

$pageTitle = 'Edit Category';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Edit Category – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>
<?php include 'include/admin-nav.php'; ?>
<a href="s-category.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Categories</a>
<div class="page-hdr"><div><h1>Edit Article Category</h1></div></div>
<?php if (!empty($formError)): ?>
<div style="background:#fee2e2;color:#dc2626;border-radius:10px;padding:12px 16px;font-size:.83rem;margin-bottom:16px;">
  <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($formError) ?>
</div>
<?php endif; ?>
<div class="admin-card" style="max-width:480px;">
  <div class="admin-card-hdr"><h5><i class="fas fa-edit" style="color:var(--brand);margin-right:7px;"></i>Edit Category</h5></div>
  <div class="admin-card-body">
    <form class="adm-form" method="post">
      <div class="form-group">
        <label for="heading">Category Name</label>
        <input class="form-control" type="text" id="heading" name="heading" required
               value="<?= htmlspecialchars(($_POST['heading'] ?? '') ?: ($cat['category'] ?? '')) ?>">
      </div>
      <button class="btn-adm primary" type="submit" name="add"><i class="fas fa-save"></i> Save Changes</button>
    </form>
  </div>
</div>
<?php include 'include/admin-footer.php'; ?>
</body>
</html>
