<?php
session_start();
include 'connect.php';

$id = isset($_GET['edt']) ? (int)$_GET['edt'] : 0;

if (isset($_POST['add'])) {
    $cat = mysqli_real_escape_string($conn, $_POST['category']);
    $q   = mysqli_query($conn, "UPDATE article SET category='$cat' WHERE article_id='$id'");
    if ($q) { header('Location: stories.php'); exit; }
    $formError = 'Something went wrong. Please try again.';
}

$qry  = mysqli_query($conn, "SELECT article_id, heading, category FROM article WHERE article_id='$id' LIMIT 1");
$art  = $qry ? mysqli_fetch_assoc($qry) : null;
$cats = mysqli_query($conn, "SELECT * FROM blog_category ORDER BY category ASC");

$pageTitle = 'Edit Article Category';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Edit Article Category – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>
<?php include 'include/admin-nav.php'; ?>
<a href="stories.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Articles</a>
<div class="page-hdr"><div><h1>Change Article Category</h1></div></div>
<?php if (!empty($formError)): ?>
<div style="background:#fee2e2;color:#dc2626;border-radius:10px;padding:12px 16px;font-size:.83rem;margin-bottom:16px;">
  <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($formError) ?>
</div>
<?php endif; ?>
<div class="admin-card" style="max-width:480px;">
  <div class="admin-card-hdr">
    <h5><i class="fas fa-tag" style="color:var(--brand);margin-right:7px;"></i>
      <?= htmlspecialchars($art['heading'] ?? 'Article') ?>
    </h5>
  </div>
  <div class="admin-card-body">
    <form class="adm-form" method="post">
      <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" id="category" name="category" required>
          <option value="">— Select Category —</option>
          <?php if ($cats): while ($c = mysqli_fetch_assoc($cats)): ?>
          <option value="<?= htmlspecialchars($c['category']) ?>"
            <?= (($art['category'] ?? '') == $c['category'] ? 'selected' : '') ?>>
            <?= htmlspecialchars($c['category']) ?>
          </option>
          <?php endwhile; endif; ?>
        </select>
      </div>
      <button class="btn-adm primary" type="submit" name="add"><i class="fas fa-save"></i> Save Changes</button>
    </form>
  </div>
</div>
<?php include 'include/admin-footer.php'; ?>
</body>
</html>
