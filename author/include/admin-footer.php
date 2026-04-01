  </div><!-- /admin-content -->
</div><!-- /admin-wrapper -->

<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="toast-wrap" id="toastWrap"></div>

<?php
$_adm_flash = null;
if (!empty($_SESSION['flash'])) {
    $_adm_flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}
?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script>
/* ── Toast ───────────────────────────────────── */
function admToast(type, msg) {
  var icons = { success:'fa-check-circle', error:'fa-times-circle', warning:'fa-exclamation-triangle', info:'fa-info-circle' };
  var wrap = document.getElementById('toastWrap');
  if (!wrap) return;
  var t = document.createElement('div');
  t.className = 'adm-toast ' + type;
  t.innerHTML = '<i class="fas ' + (icons[type] || 'fa-info-circle') + ' adm-toast-icon"></i>'
              + '<span class="adm-toast-msg">' + msg + '</span>'
              + '<button class="adm-toast-close" onclick="this.parentNode.remove()" aria-label="Close"><i class="fas fa-times"></i></button>';
  wrap.appendChild(t);
  // Two rAF calls guarantee the element is painted before adding .show
  requestAnimationFrame(function(){
    requestAnimationFrame(function(){ t.classList.add('show'); });
  });
  setTimeout(function(){
    t.classList.add('hide');
    t.addEventListener('transitionend', function(){ if (t.parentNode) t.remove(); }, { once: true });
  }, 4500);
}

/* ── Topbar dropdown ─────────────────────────── */
var _topbarUser = document.getElementById('topbarUser');
if (_topbarUser) {
  document.addEventListener('click', function(e) {
    if (_topbarUser.contains(e.target)) {
      _topbarUser.classList.toggle('open');
    } else {
      _topbarUser.classList.remove('open');
    }
  });
}

/* ── Mobile sidebar ──────────────────────────── */
var _hamburger = document.getElementById('topbarHamburger');
var _sidebar   = document.getElementById('adminSidebar');
var _overlay   = document.getElementById('sidebarOverlay');
function _openSidebar()  { _sidebar.classList.add('open');    _overlay.classList.add('show'); }
function _closeSidebar() { _sidebar.classList.remove('open'); _overlay.classList.remove('show'); }
if (_hamburger) _hamburger.addEventListener('click', _openSidebar);
if (_overlay)   _overlay.addEventListener('click', _closeSidebar);
</script>

<?php if ($_adm_flash): ?>
<script>
admToast(<?= json_encode($_adm_flash['type']) ?>, <?= json_encode($_adm_flash['msg']) ?>);
</script>
<?php endif; ?>
