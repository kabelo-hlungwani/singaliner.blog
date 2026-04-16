<?php
session_start();
include 'connect.php';

$id = isset($_GET['edt']) ? (int)$_GET['edt'] : 0;

function upload_error_message($code) {
  switch ($code) {
    case UPLOAD_ERR_INI_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
      return 'The selected image is too large to upload.';
    case UPLOAD_ERR_PARTIAL:
      return 'The image upload was interrupted. Please try again.';
    case UPLOAD_ERR_NO_FILE:
      return 'Please choose a new image to upload.';
    case UPLOAD_ERR_NO_TMP_DIR:
      return 'The server upload temp directory is missing.';
    case UPLOAD_ERR_CANT_WRITE:
      return 'The server cannot write uploaded files right now.';
    case UPLOAD_ERR_EXTENSION:
      return 'The upload was blocked by a server extension.';
    default:
      return 'Image upload failed. Please try again.';
  }
}

$qry = mysqli_query($conn, "SELECT article_id, heading, picture FROM article WHERE article_id='$id' LIMIT 1");
$art = $qry ? mysqli_fetch_assoc($qry) : null;

if (isset($_POST['add'])) {
  if (!$art) {
    $formError = 'The selected article could not be found.';
  } elseif (!isset($_FILES['picture'])) {
    $formError = 'No image upload was received.';
    } else {
    $uploadError = (int)($_FILES['picture']['error'] ?? UPLOAD_ERR_NO_FILE);
    $ext = strtolower(pathinfo($_FILES['picture']['name'] ?? '', PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];

    if ($uploadError !== UPLOAD_ERR_OK) {
      $formError = upload_error_message($uploadError);
    } elseif (!in_array($ext, $allowed, true)) {
            $formError = 'Invalid file type. Allowed: jpg, jpeg, png, gif, webp.';
        } else {
      $uploadDir = __DIR__ . '/articles';

      if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        $formError = 'The article image folder could not be created.';
      } elseif (!is_writable($uploadDir)) {
        $formError = 'The article image folder is not writable by the server.';
      } elseif (!is_uploaded_file($_FILES['picture']['tmp_name'])) {
        $formError = 'The uploaded image could not be verified.';
      } else {
        try {
          $newname = 'article_' . bin2hex(random_bytes(16)) . '.' . $ext;
        } catch (Exception $e) {
          $newname = 'article_' . uniqid('', true) . '.' . $ext;
        }

        $target = $uploadDir . '/' . $newname;

        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
          $formError = 'Image upload failed. Please try again.';
        } else {
          $safeName = mysqli_real_escape_string($conn, $newname);
          $q = mysqli_query($conn, "UPDATE article SET picture='$safeName' WHERE article_id='$id'");

          if ($q) {
            $oldPicture = $art['picture'] ?? '';
            $oldPath = $uploadDir . '/' . $oldPicture;

            if ($oldPicture !== '' && $oldPicture !== $newname && is_file($oldPath)) {
              @unlink($oldPath);
            }

            $_SESSION['flash'] = ['type'=>'success','msg'=>'Article picture updated.'];
            header('Location: stories.php');
            exit;
          }

          @unlink($target);
          $formError = 'Something went wrong. Please try again.';
        }
      }
        }
    }
}

$pageTitle = 'Edit Article Picture';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Edit Article Picture – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>
<?php include 'include/admin-nav.php'; ?>
<a href="edit-a.php?edt=<?= $id ?>" class="back-link"><i class="fas fa-arrow-left"></i> Back to Edit Article</a>
<div class="page-hdr"><div><h1>Change Article Cover Image</h1></div></div>
<?php if (!empty($formError)): ?>
<div style="background:#fee2e2;color:#dc2626;border-radius:10px;padding:12px 16px;font-size:.83rem;margin-bottom:16px;">
  <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($formError) ?>
</div>
<?php endif; ?>
<div class="admin-card" style="max-width:540px;">
  <div class="admin-card-hdr">
    <h5><i class="fas fa-camera" style="color:var(--brand);margin-right:7px;"></i>
      <?= htmlspecialchars($art['heading'] ?? 'Article') ?>
    </h5>
  </div>
  <div class="admin-card-body">
    <?php if ($art && !empty($art['picture'])): ?>
    <div style="margin-bottom:16px;">
      <img src="articles/<?= htmlspecialchars($art['picture']) ?>" alt="Current cover"
           style="max-width:280px;border-radius:8px;border:2px solid var(--border);">
      <p style="font-size:.78rem;color:var(--text-muted);margin-top:6px;">Current cover image</p>
    </div>
    <?php endif; ?>
    <form class="adm-form" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="picture">New Cover Image</label>
        <input class="form-control" type="file" id="picture" name="picture" accept="image/*" required>
      </div>
      <button class="btn-adm primary" type="submit" name="add"><i class="fas fa-upload"></i> Upload &amp; Save</button>
    </form>
  </div>
</div>
<?php include 'include/admin-footer.php'; ?>
</body>
</html>
