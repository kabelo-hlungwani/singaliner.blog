<?php
/**
 * author/include/admin-nav.php
 *
 * Shared sidebar + topbar for all admin pages.
 * Requires:
 *   - $conn  (from connect.php)
 *   - session started with $_SESSION['email'] set
 * Optional:
 *   - $pageTitle  string shown in topbar (default 'Dashboard')
 */

if (empty($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}

$_nav_email = mysqli_real_escape_string($conn, $_SESSION['email']);
$_nav_res   = mysqli_query($conn, "SELECT * FROM admin WHERE email='$_nav_email' LIMIT 1");
$_nav_admin = $_nav_res ? mysqli_fetch_assoc($_nav_res) : null;

if (!$_nav_admin) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$_nav_id    = (int)$_nav_admin['admin_id'];
$_nav_name  = htmlspecialchars($_nav_admin['name'] . ' ' . $_nav_admin['surname']);
$_nav_title = isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Dashboard';
$_cur       = basename($_SERVER['PHP_SELF']);

function _nav_active($page) {
    global $_cur;
    return $_cur === $page ? ' active' : '';
}
?>
<!-- ===== SIDEBAR ===================================== -->
<aside class="admin-sidebar" id="adminSidebar">
  <a class="sidebar-brand" href="dashboard.php">
    <img src="assets/img/logo.png" alt="Logo">
    <span>Singaliner</span>
  </a>

  <ul class="sidebar-nav">
    <li>
      <a href="dashboard.php" class="<?= _nav_active('dashboard.php') ?>">
        <i class="fas fa-tachometer-alt"></i> Dashboard
      </a>
    </li>

    <li class="nav-label">Articles</li>
    <li>
      <a href="stories.php?edt=<?= $_nav_id ?>" class="<?= _nav_active('stories.php') ?>">
        <i class="fas fa-newspaper"></i> All Articles
      </a>
    </li>
    <li>
      <a href="add-stories.php?edt=<?= $_nav_id ?>" class="<?= _nav_active('add-stories.php') ?>">
        <i class="fas fa-plus-circle"></i> New Article
      </a>
    </li>
    <li>
      <a href="s-category.php?edt=<?= $_nav_id ?>" class="<?= _nav_active('s-category.php') ?>">
        <i class="fas fa-tags"></i> Categories
      </a>
    </li>

    <li class="nav-label">Gallery</li>
    <li>
      <a href="gallery.php?edt=<?= $_nav_id ?>" class="<?= _nav_active('gallery.php') ?>">
        <i class="fas fa-images"></i> All Images
      </a>
    </li>
    <li>
      <a href="add-images.php?edt=<?= $_nav_id ?>" class="<?= _nav_active('add-images.php') ?>">
        <i class="fas fa-cloud-upload-alt"></i> Upload Image
      </a>
    </li>
    <li>
      <a href="g-category.php?edt=<?= $_nav_id ?>" class="<?= _nav_active('g-category.php') ?>">
        <i class="fas fa-folder-open"></i> Categories
      </a>
    </li>
  </ul>
</aside>

<!-- ===== WRAPPER ==================================== -->
<div class="admin-wrapper" id="adminWrapper">

  <!-- TOPBAR -->
  <nav class="admin-topbar">
    <div class="topbar-left">
      <button class="topbar-hamburger" id="topbarHamburger" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
      </button>
      <span class="topbar-title"><?= $_nav_title ?></span>
    </div>

    <div class="topbar-right">
      <div class="topbar-user" id="topbarUser">
        <img class="topbar-avatar" src="assets/img/logo.png" alt="avatar">
        <span class="topbar-name"><?= $_nav_name ?></span>
        <i class="fas fa-chevron-down topbar-caret"></i>
        <div class="topbar-dropdown">
          <a href="profile.php?edt=<?= $_nav_id ?>"><i class="fas fa-user"></i> Profile</a>
          <hr>
          <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- PAGE CONTENT -->
  <div class="admin-content">
