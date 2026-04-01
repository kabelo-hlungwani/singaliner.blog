<?php
session_start();
include 'connect.php';

// Remove duplicate connect — handled above
$id = isset($_GET['edt']) ? (int)$_GET['edt'] : (isset($_SESSION['admin_id']) ? (int)$_SESSION['admin_id'] : 0);

if (isset($_POST['add'])) {
    $head    = mysqli_real_escape_string($conn, $_POST['heading']);
    $cat     = mysqli_real_escape_string($conn, $_POST['category']);
    $content = $_POST['editor1']; // CKEditor HTML — sanitised on output
    $imgfile  = $_FILES["picture"]["name"];
    $extension = strtolower(substr($imgfile, -4));
    $allowed = ['.jpg', 'jpeg', '.png', '.gif'];

    if (!in_array($extension, $allowed)) {
        $uploadError = 'Invalid format. Only jpg / jpeg / png / gif allowed.';
    } else {
        $imgnewfile = md5($imgfile) . $extension;
        move_uploaded_file($_FILES["picture"]["tmp_name"], "articles/" . $imgnewfile);
        $query = mysqli_query($conn, "INSERT INTO article (admin_id,heading,picture,content,category) VALUES('$id','$head','$imgnewfile','$content','$cat')");
        if ($query) {
            header('Location: stories.php');
            exit;
        } else {
            $uploadError = 'Something went wrong saving the article. Please try again.';
        }
    }
}

$cats = mysqli_query($conn, "SELECT * FROM blog_category");
$pageTitle = 'New Article';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>New Article – Singaliner Admin</title>
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
    <h1>New Article</h1>
    <div class="breadcrumb-trail"><a href="dashboard.php">Dashboard</a> / <a href="stories.php">Articles</a> / New</div>
  </div>
</div>

<?php if (!empty($uploadError)): ?>
<div style="background:#fee2e2;color:#dc2626;border-radius:10px;padding:12px 16px;font-size:.83rem;margin-bottom:16px;">
  <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($uploadError) ?>
</div>
<?php endif; ?>

<div class="admin-card">
  <div class="admin-card-hdr">
    <h5><i class="fas fa-newspaper" style="color:var(--brand);margin-right:7px;"></i>Article Details</h5>
  </div>
  <div class="admin-card-body">
    <form class="adm-form" method="post" enctype="multipart/form-data" name="add">
      <div class="form-group">
        <label for="heading">Article Heading</label>
        <input class="form-control" type="text" id="heading" name="heading" placeholder="Enter article heading" required>
      </div>

      <div class="form-group">
        <label>Featured Image</label>
        <input class="form-control form-control-file" type="file" name="picture" accept=".jpg,.jpeg,.png,.gif">
        <small style="color:var(--muted);font-size:.72rem;">Accepted: jpg, jpeg, png, gif</small>
      </div>

      <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" name="category" id="category" required>
          <option value="">— Select a category —</option>
          <?php if ($cats && mysqli_num_rows($cats) > 0):
            while ($c = mysqli_fetch_assoc($cats)): ?>
          <option value="<?= htmlspecialchars($c['category']) ?>"><?= htmlspecialchars($c['category']) ?></option>
          <?php endwhile; endif; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="editor1">Content</label>
        <textarea class="form-control" name="editor1" id="editor1" rows="12" placeholder="Write article content…"></textarea>
      </div>

      <button class="btn-adm primary" type="submit" name="add">
        <i class="fas fa-save"></i> Publish Article
      </button>
    </form>
  </div>
</div>

<script>CKEDITOR.replace('editor1');</script>

<?php include 'include/admin-footer.php'; ?>
</body>
</html>
