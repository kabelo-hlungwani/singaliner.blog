<?php
session_start();
include 'connect.php';

$page_no  = isset($_GET['page_no']) && (int)$_GET['page_no'] > 0 ? (int)$_GET['page_no'] : 1;
$per_page = 10;
$offset   = ($page_no - 1) * $per_page;

$count_res   = mysqli_query($conn, "SELECT COUNT(*) AS n FROM gallery_category");
$total_rows  = $count_res ? (int)mysqli_fetch_assoc($count_res)['n'] : 0;
$total_pages = $total_rows > 0 ? ceil($total_rows / $per_page) : 1;

$result = mysqli_query($conn, "SELECT * FROM gallery_category LIMIT $offset, $per_page");

$pageTitle = 'Gallery Categories';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Gallery Categories – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>

<?php include 'include/admin-nav.php'; ?>

<div class="page-hdr">
  <div>
    <h1>Gallery Categories</h1>
    <div class="breadcrumb-trail"><a href="dashboard.php">Dashboard</a> / Gallery Categories</div>
  </div>
  <a href="add-category-image.php?edt=<?= $_nav_id ?>" class="btn-adm primary">
    <i class="fas fa-plus"></i> New Category
  </a>
</div>

<div class="admin-card">
  <div class="admin-card-hdr">
    <h5><i class="fas fa-folder-open" style="color:var(--brand);margin-right:7px;"></i><?= $total_rows ?> Categor<?= $total_rows !== 1 ? 'ies' : 'y' ?></h5>
  </div>
  <div class="table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Category Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && mysqli_num_rows($result) > 0):
          $x = $offset + 1;
          while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $x++ ?></td>
          <td><?= htmlspecialchars($row['category']) ?></td>
          <td style="white-space:nowrap;">
            <a href="edit-g.php?edt=<?= (int)$row['category_id'] ?>" class="btn-adm warning" style="padding:5px 12px;font-size:.75rem;">
              <i class="fas fa-edit"></i> Edit
            </a>
            <a href="delete-g.php?edt=<?= (int)$row['category_id'] ?>" class="btn-adm danger" style="padding:5px 12px;font-size:.75rem;"
               onclick="return confirm('Delete this category?')">
              <i class="fas fa-trash"></i>
            </a>
          </td>
        </tr>
        <?php endwhile; else: ?>
        <tr>
          <td colspan="3" style="text-align:center;padding:32px;color:var(--muted);">
            <i class="fas fa-folder-open" style="font-size:1.5rem;margin-bottom:8px;display:block;"></i>
            No categories yet. <a href="add-category-image.php?edt=<?= $_nav_id ?>">Add one</a>
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
  </div>
  <?php endif; ?>
</div>

<?php include 'include/admin-footer.php'; ?>
</body>
</html>
