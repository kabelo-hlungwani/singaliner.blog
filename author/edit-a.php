<?php
session_start();
include 'connect.php';

$id = isset($_GET['edt']) ? (int)$_GET['edt'] : 0;

if (isset($_POST['add'])) {
    $head    = mysqli_real_escape_string($conn, $_POST['heading']);
    $content = $_POST['editor1'];
    $edit    = mysqli_query($conn, "UPDATE article SET heading='$head', content='$content' WHERE article_id='$id'");
    if ($edit) {
        header('Location: stories.php');
        exit;
    }
    $saveError = 'Something went wrong. Please try again.';
}

$qry = mysqli_query($conn, "SELECT * FROM article WHERE article_id='$id' LIMIT 1");
$art = $qry ? mysqli_fetch_assoc($qry) : null;

$pageTitle = 'Edit Article';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Edit Article – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<body>

<?php include 'include/admin-nav.php'; ?>

<a href="stories.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Articles</a>

<div class="page-hdr">
  <div>
    <h1>Edit Article</h1>
    <div class="breadcrumb-trail"><a href="dashboard.php">Dashboard</a> / <a href="stories.php">Articles</a> / Edit</div>
  </div>
</div>

<?php if (!empty($saveError)): ?>
<div style="background:#fee2e2;color:#dc2626;border-radius:10px;padding:12px 16px;font-size:.83rem;margin-bottom:16px;">
  <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($saveError) ?>
</div>
<?php endif; ?>

<div class="admin-card">
  <div class="admin-card-hdr">
    <h5><i class="fas fa-edit" style="color:var(--brand);margin-right:7px;"></i>Edit Article Details</h5>
  </div>
  <div class="admin-card-body">
    <form class="adm-form" method="post">
      <div class="form-group">
        <label for="heading">Article Heading</label>
        <input class="form-control" type="text" id="heading" name="heading"
               value="<?= htmlspecialchars($art['heading'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="editor1">Content</label>
        <textarea class="form-control" name="editor1" id="editor1" rows="14"><?= htmlspecialchars($art['content'] ?? '') ?></textarea>
      </div>

      <button class="btn-adm primary" type="submit" name="add">
        <i class="fas fa-save"></i> Save Changes
      </button>
      <a href="edit-article-picture.php?edt=<?= $id ?>" class="btn-adm outline" style="margin-left:10px;">
        <i class="fas fa-image"></i> Change Picture
      </a>
    </form>
  </div>
</div>

<script>CKEDITOR.replace('editor1');</script>

<?php include 'include/admin-footer.php'; ?>
</body>
</html>
