<?php
session_start();
include 'connect.php';

$id = isset($_GET['edt']) ? (int)$_GET['edt'] : 0;

if (isset($_POST['add'])) {
    $cat = mysqli_real_escape_string($conn, $_POST['category']);

    // Handle optional new image upload
    if (!empty($_FILES['picture']['name'])) {
        $ext      = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        $newname  = 'gallery_' . time() . '.' . $ext;
        $target   = 'gallery/' . $newname;
        $allowed  = ['jpg','jpeg','png','gif','webp'];
        if (!in_array(strtolower($ext), $allowed)) {
            $formError = 'Invalid file type. Allowed: jpg, jpeg, png, gif, webp.';
        } elseif (!move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
            $formError = 'Image upload failed. Please try again.';
        } else {
            $q = mysqli_query($conn, "UPDATE gallery SET section='$cat', picture='$newname' WHERE img_id='$id'");
            if ($q) { $_SESSION['flash'] = ['type'=>'success','msg'=>'Image updated successfully.']; header('Location: gallery.php'); exit; }
            $formError = 'Something went wrong. Please try again.';
        }
    } else {
        $q = mysqli_query($conn, "UPDATE gallery SET section='$cat' WHERE img_id='$id'");
        if ($q) { $_SESSION['flash'] = ['type'=>'success','msg'=>'Image updated successfully.']; header('Location: gallery.php'); exit; }
        $formError = 'Something went wrong. Please try again.';
    }
}

$qry  = mysqli_query($conn, "SELECT * FROM gallery WHERE img_id='$id' LIMIT 1");
$img  = $qry ? mysqli_fetch_assoc($qry) : null;
$cats = mysqli_query($conn, "SELECT * FROM gallery_category ORDER BY category ASC");

$pageTitle = 'Edit Image';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Edit Image – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>
<?php include 'include/admin-nav.php'; ?>
<a href="gallery.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Gallery</a>
<div class="page-hdr"><div><h1>Edit Gallery Image</h1></div></div>
<?php if (!empty($formError)): ?>
<div style="background:#fee2e2;color:#dc2626;border-radius:10px;padding:12px 16px;font-size:.83rem;margin-bottom:16px;">
  <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($formError) ?>
</div>
<?php endif; ?>
<div class="admin-card" style="max-width:540px;">
  <div class="admin-card-hdr"><h5><i class="fas fa-image" style="color:var(--brand);margin-right:7px;"></i>Image Details</h5></div>
  <div class="admin-card-body">
    <?php if ($img && !empty($img['picture'])): ?>
    <div style="margin-bottom:16px;">
      <img src="gallery/<?= htmlspecialchars($img['picture']) ?>" alt="Current"
           style="max-width:220px;border-radius:8px;border:2px solid var(--border);">
      <p style="font-size:.78rem;color:var(--text-muted);margin-top:6px;">Current image</p>
    </div>
    <?php endif; ?>
    <form class="adm-form" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" id="category" name="category" required>
          <option value="">— Select Category —</option>
          <?php if ($cats): while ($c = mysqli_fetch_assoc($cats)): ?>
          <option value="<?= htmlspecialchars($c['category']) ?>"
            <?= (($img['section'] ?? '') == $c['category'] ? 'selected' : '') ?>>
            <?= htmlspecialchars($c['category']) ?>
          </option>
          <?php endwhile; endif; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="picture">Replace Image <span style="color:var(--text-muted);font-weight:400;">(optional)</span></label>
        <input class="form-control" type="file" id="picture" name="picture" accept="image/*">
      </div>
      <button class="btn-adm primary" type="submit" name="add"><i class="fas fa-save"></i> Save Changes</button>
    </form>
  </div>
</div>
<?php include 'include/admin-footer.php'; ?>
</body>
</html>
