<?php
session_start();
include 'connect.php';

$page_no  = isset($_GET['page_no']) && (int)$_GET['page_no'] > 0 ? (int)$_GET['page_no'] : 1;
$per_page = 8;
$offset   = ($page_no - 1) * $per_page;

$count_res   = mysqli_query($conn, "SELECT COUNT(*) AS n FROM gallery");
$total_rows  = $count_res ? (int)mysqli_fetch_assoc($count_res)['n'] : 0;
$total_pages = $total_rows > 0 ? ceil($total_rows / $per_page) : 1;

$result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY img_id DESC LIMIT $offset, $per_page");

$pageTitle = 'Gallery';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Gallery – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>

<?php include 'include/admin-nav.php'; ?>

<div class="page-hdr">
  <div>
    <h1>Gallery</h1>
    <div class="breadcrumb-trail"><a href="dashboard.php">Dashboard</a> / Gallery</div>
  </div>
  <a href="add-images.php?edt=<?= $_nav_id ?>" class="btn-adm primary">
    <i class="fas fa-cloud-upload-alt"></i> Upload Image
  </a>
</div>

<div class="admin-card">
  <div class="admin-card-hdr">
    <h5><i class="fas fa-images" style="color:var(--brand);margin-right:7px;"></i><?= $total_rows ?> Image<?= $total_rows !== 1 ? 's' : '' ?></h5>
    <div class="search-bar">
      <i class="fas fa-search"></i>
      <input type="text" placeholder="Search by category…" oninput="filterTable(this.value)">
    </div>
  </div>

  <div class="table-wrap">
    <table class="admin-table" id="galleryTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Category</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && mysqli_num_rows($result) > 0):
          $x = $offset + 1;
          while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $x++ ?></td>
          <td>
            <img class="thumb" src="gallery/<?= htmlspecialchars($row['picture']) ?>" alt="" style="width:90px;height:62px;">
          </td>
          <td><span class="badge-adm blue"><?= htmlspecialchars($row['section']) ?></span></td>
          <td style="white-space:nowrap;">
            <a href="edit-image.php?edt=<?= (int)$row['img_id'] ?>" class="btn-adm warning" style="padding:5px 12px;font-size:.75rem;">
              <i class="fas fa-edit"></i> Edit
            </a>
            <a href="delete-image.php?edt=<?= (int)$row['img_id'] ?>" class="btn-adm danger" style="padding:5px 12px;font-size:.75rem;"
               onclick="return confirm('Delete this image?')">
              <i class="fas fa-trash"></i>
            </a>
          </td>
        </tr>
        <?php endwhile; else: ?>
        <tr>
          <td colspan="4" style="text-align:center;padding:32px;color:var(--muted);">
            <i class="fas fa-images" style="font-size:1.5rem;margin-bottom:8px;display:block;"></i>
            No images yet. <a href="add-images.php?edt=<?= $_nav_id ?>">Upload one</a>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if ($total_pages > 1): ?>
  <div class="adm-pagination">
    <a class="adm-pg-btn <?= $page_no <= 1 ? 'disabled' : '' ?>" href="?page_no=<?= $page_no - 1 ?>">
      <i class="fas fa-chevron-left"></i>
    </a>
    <?php for ($i = max(1, $page_no - 2); $i <= min($total_pages, $page_no + 2); $i++): ?>
    <a class="adm-pg-btn <?= $i === $page_no ? 'active' : '' ?>" href="?page_no=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
    <a class="adm-pg-btn <?= $page_no >= $total_pages ? 'disabled' : '' ?>" href="?page_no=<?= $page_no + 1 ?>">
      <i class="fas fa-chevron-right"></i>
    </a>
    <span style="margin-left:8px;font-size:.78rem;color:var(--muted);">Page <?= $page_no ?> of <?= $total_pages ?></span>
  </div>
  <?php endif; ?>
</div>

<script>
function filterTable(q) {
  var rows = document.querySelectorAll('#galleryTable tbody tr');
  q = q.toLowerCase();
  rows.forEach(function(r) { r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none'; });
}
</script>

<?php include 'include/admin-footer.php'; ?>
</body>
</html>
