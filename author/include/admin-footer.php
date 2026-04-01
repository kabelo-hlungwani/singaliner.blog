  </div><!-- /admin-content -->
</div><!-- /admin-wrapper -->

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script>
(function () {
  // Topbar user dropdown
  var userBtn  = document.getElementById('topbarUser');
  if (userBtn) {
    document.addEventListener('click', function (e) {
      if (userBtn.contains(e.target)) {
        userBtn.classList.toggle('open');
      } else {
        userBtn.classList.remove('open');
      }
    });
  }

  // Mobile sidebar toggle
  var hamburger = document.getElementById('topbarHamburger');
  var sidebar   = document.getElementById('adminSidebar');
  var overlay   = document.getElementById('sidebarOverlay');

  function openSidebar() {
    sidebar.classList.add('open');
    overlay.classList.add('show');
  }

  function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('show');
  }

  if (hamburger) hamburger.addEventListener('click', openSidebar);
  if (overlay)   overlay.addEventListener('click', closeSidebar);
})();
</script>
