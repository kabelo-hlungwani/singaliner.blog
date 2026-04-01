<?php
session_start();
include 'connect.php';

$id = isset($_GET['edt']) ? (int)$_GET['edt'] : (isset($_SESSION['admin_id']) ? (int)$_SESSION['admin_id'] : 0);

if (isset($_POST['add'])) {
    $cat      = mysqli_real_escape_string($conn, $_POST['category']);
    $imgfile  = $_FILES["image"]["name"];
    $extension = strtolower(substr($imgfile, -4));
    $allowed  = ['.jpg', 'jpeg', '.png', '.gif'];

    if (!in_array($extension, $allowed)) {
        $uploadError = 'Invalid format. Only jpg / jpeg / png / gif allowed.';
    } else {
        $imgnewfile = md5($imgfile) . $extension;
        move_uploaded_file($_FILES["image"]["tmp_name"], "gallery/" . $imgnewfile);
        $query = mysqli_query($conn, "INSERT INTO gallery(admin_id,section,picture) VALUES('$id','$cat','$imgnewfile')");
        if ($query) {
            header('Location: gallery.php');
            exit;
        } else {
            $uploadError = 'Something went wrong. Please try again.';
        }
    }
}

$gcats = mysqli_query($conn, "SELECT * FROM gallery_category");
$pageTitle = 'Upload Image';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Upload Image – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>

<?php include 'include/admin-nav.php'; ?>

<a href="gallery.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Gallery</a>

<div class="page-hdr">
  <div>
    <h1>Upload Image</h1>
    <div class="breadcrumb-trail"><a href="dashboard.php">Dashboard</a> / <a href="gallery.php">Gallery</a> / Upload</div>
  </div>
</div>

<?php if (!empty($uploadError)): ?>
<div style="background:#fee2e2;color:#dc2626;border-radius:10px;padding:12px 16px;font-size:.83rem;margin-bottom:16px;">
  <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($uploadError) ?>
</div>
<?php endif; ?>

<div class="admin-card" style="max-width:540px;">
  <div class="admin-card-hdr">
    <h5><i class="fas fa-cloud-upload-alt" style="color:var(--brand);margin-right:7px;"></i>Image Details</h5>
  </div>
  <div class="admin-card-body">
    <form class="adm-form" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Image File</label>
        <input class="form-control form-control-file" type="file" name="image" accept=".jpg,.jpeg,.png,.gif" required>
        <small style="color:var(--muted);font-size:.72rem;">Accepted: jpg, jpeg, png, gif</small>
      </div>

      <div class="form-group">
        <label for="category">Gallery Category</label>
        <select class="form-control" name="category" id="category" required>
          <option value="">— Select a category —</option>
          <?php if ($gcats && mysqli_num_rows($gcats) > 0):
            while ($c = mysqli_fetch_assoc($gcats)): ?>
          <option value="<?= htmlspecialchars($c['category']) ?>"><?= htmlspecialchars($c['category']) ?></option>
          <?php endwhile; endif; ?>
        </select>
      </div>

      <button class="btn-adm primary" type="submit" name="add">
        <i class="fas fa-cloud-upload-alt"></i> Upload Image
      </button>
    </form>
  </div>
</div>

<?php include 'include/admin-footer.php'; ?>
</body>
</html>
