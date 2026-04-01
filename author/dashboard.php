<?php
session_start();
include 'connect.php';

// Stat queries
$artCount  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(article_id) AS n FROM article"))['n'];
$imgCount  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(img_id) AS n FROM gallery"))['n'];
$catCount  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(category_id) AS n FROM blog_category"))['n'];
$gcatCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(category_id) AS n FROM gallery_category"))['n'];
$viewsRow  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(views),0) AS n FROM article"));
$viewCount = $viewsRow ? $viewsRow['n'] : 0;

// Recent articles
$recent = mysqli_query($conn, "SELECT heading, date, picture FROM article ORDER BY date DESC LIMIT 5");

$pageTitle = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Dashboard – Singaliner Admin</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>

<?php include 'include/admin-nav.php'; ?>

<!-- Stat cards -->
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon blue"><i class="fas fa-newspaper"></i></div>
    <div class="stat-info">
      <div class="stat-label">Articles</div>
      <div class="stat-value"><?= (int)$artCount ?></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green"><i class="fas fa-images"></i></div>
    <div class="stat-info">
      <div class="stat-label">Gallery Images</div>
      <div class="stat-value"><?= (int)$imgCount ?></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon orange"><i class="fas fa-tags"></i></div>
    <div class="stat-info">
      <div class="stat-label">Article Categories</div>
      <div class="stat-value"><?= (int)$catCount ?></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon purple"><i class="fas fa-folder-open"></i></div>
    <div class="stat-info">
      <div class="stat-label">Gallery Categories</div>
      <div class="stat-value"><?= (int)$gcatCount ?></div>
    </div>
  </div>
</div>

<!-- Quick actions + recent articles -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;flex-wrap:wrap;">

  <!-- Quick actions -->
  <div class="admin-card">
    <div class="admin-card-hdr"><h5><i class="fas fa-bolt" style="color:var(--accent);margin-right:7px;"></i>Quick Actions</h5></div>
    <div class="admin-card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
      <a href="add-stories.php?edt=<?= $_nav_id ?>" class="btn-adm primary"><i class="fas fa-plus"></i> New Article</a>
      <a href="add-images.php?edt=<?= $_nav_id ?>" class="btn-adm success"><i class="fas fa-cloud-upload-alt"></i> Upload Image</a>
      <a href="s-category.php?edt=<?= $_nav_id ?>" class="btn-adm outline"><i class="fas fa-tags"></i> Article Cats</a>
      <a href="g-category.php?edt=<?= $_nav_id ?>" class="btn-adm outline"><i class="fas fa-folder-open"></i> Gallery Cats</a>
    </div>
  </div>

  <!-- Recent articles -->
  <div class="admin-card">
    <div class="admin-card-hdr">
      <h5><i class="fas fa-clock" style="color:var(--brand);margin-right:7px;"></i>Recent Articles</h5>
      <a href="stories.php?edt=<?= $_nav_id ?>" class="btn-adm outline" style="font-size:.75rem;padding:5px 12px;">View all</a>
    </div>
    <div class="table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Thumbnail</th>
            <th>Heading</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($recent && mysqli_num_rows($recent) > 0):
            while ($r = mysqli_fetch_assoc($recent)): ?>
          <tr>
            <td><img class="thumb" src="articles/<?= htmlspecialchars($r['picture']) ?>" alt=""></td>
            <td><?= htmlspecialchars(mb_strimwidth($r['heading'], 0, 50, '…')) ?></td>
            <td><?= htmlspecialchars($r['date']) ?></td>
          </tr>
          <?php endwhile; else: ?>
          <tr><td colspan="3" style="text-align:center;color:var(--muted);padding:24px;">No articles yet.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php include 'include/admin-footer.php'; ?>
</body>
</html>
         



