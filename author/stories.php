<?php
session_start();
include 'connect.php';

$page_no = isset($_GET['page_no']) && (int)$_GET['page_no'] > 0 ? (int)$_GET['page_no'] : 1;
$per_page = 8;
$offset   = ($page_no - 1) * $per_page;

$count_res  = mysqli_query($conn, "SELECT COUNT(*) AS n FROM article");
$total_rows = $count_res ? (int)mysqli_fetch_assoc($count_res)['n'] : 0;
$total_pages = $total_rows > 0 ? ceil($total_rows / $per_page) : 1;

$result = mysqli_query($conn, "SELECT * FROM article ORDER BY date DESC LIMIT $offset, $per_page");

$pageTitle = 'All Articles';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Articles – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>

<?php include 'include/admin-nav.php'; ?>

<div class="page-hdr">
  <div>
    <h1>All Articles</h1>
    <div class="breadcrumb-trail"><a href="dashboard.php">Dashboard</a> / Articles</div>
  </div>
  <a href="add-stories.php?edt=<?= $_nav_id ?>" class="btn-adm primary">
    <i class="fas fa-plus"></i> New Article
  </a>
</div>

<div class="admin-card">
  <div class="admin-card-hdr">
    <h5><i class="fas fa-newspaper" style="color:var(--brand);margin-right:7px;"></i><?= $total_rows ?> Article<?= $total_rows !== 1 ? 's' : '' ?></h5>
    <div class="search-bar">
      <i class="fas fa-search"></i>
      <input type="text" id="articleSearch" placeholder="Search articles…" oninput="filterTable(this.value)">
    </div>
  </div>

  <div class="table-wrap">
    <table class="admin-table" id="articleTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Thumbnail</th>
          <th>Heading</th>
          <th>Category</th>
          <th>Date</th>
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
            <a href="edit-article-picture.php?edt=<?= (int)$row['article_id'] ?>" title="Edit picture">
              <img class="thumb" src="articles/<?= htmlspecialchars($row['picture']) ?>" alt="">
            </a>
          </td>
          <td><?= htmlspecialchars(mb_strimwidth($row['heading'], 0, 60, '…')) ?></td>
          <td>
            <a href="category-edit.php?edt=<?= (int)$row['article_id'] ?>">
              <span class="badge-adm blue"><?= htmlspecialchars($row['category']) ?></span>
            </a>
          </td>
          <td><?= htmlspecialchars($row['date']) ?></td>
          <td style="white-space:nowrap;">
            <a href="edit-a.php?edt=<?= (int)$row['article_id'] ?>" class="btn-adm warning" style="padding:5px 12px;font-size:.75rem;">
              <i class="fas fa-edit"></i> Edit
            </a>
            <a href="delete-a.php?edt=<?= (int)$row['article_id'] ?>" class="btn-adm danger" style="padding:5px 12px;font-size:.75rem;"
               onclick="return confirm('Delete this article?')">
              <i class="fas fa-trash"></i>
            </a>
          </td>
        </tr>
        <?php endwhile; else: ?>
        <tr>
          <td colspan="6" style="text-align:center;padding:32px;color:var(--muted);">
            <i class="fas fa-newspaper" style="font-size:1.5rem;margin-bottom:8px;display:block;"></i>
            No articles yet. <a href="add-stories.php?edt=<?= $_nav_id ?>">Create one</a>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
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
  var rows = document.querySelectorAll('#articleTable tbody tr');
  q = q.toLowerCase();
  rows.forEach(function(row) {
    row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
}
</script>

<?php include 'include/admin-footer.php'; ?>
</body>
</html>
