<?php
session_start();
include 'connect.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $result   = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$password' LIMIT 1");
    $row      = $result ? mysqli_fetch_assoc($result) : null;

    if ($row && strtolower($row['email']) === strtolower($_POST['email'])) {
        $_SESSION['email']    = $row['email'];
        $_SESSION['admin_id'] = $row['admin_id'];
        header('Location: dashboard.php');
        exit;
    } else {
        $loginError = 'Invalid email or password. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Admin Login – Singaliner Inc</title>
  <link rel="icon" href="assets/img/logo.png">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/admin-modern.css">
</head>
<body>

<div class="login-page">

  <!-- Left brand panel -->
  <div class="login-brand">
    <img class="login-brand-logo" src="assets/img/logo.png" alt="Singaliner Logo">
    <div class="login-brand-title">Singaliner Inc.</div>
    <p class="login-brand-sub">Admin panel — manage articles, gallery and site content from one place.</p>
  </div>

  <!-- Right form panel -->
  <div class="login-form-panel">
    <h2>Welcome back</h2>
    <p>Sign in to your admin account to continue.</p>

    <?php if (!empty($loginError)): ?>
      <div style="background:#fee2e2;color:#dc2626;border-radius:10px;padding:10px 16px;font-size:.83rem;margin-bottom:18px;max-width:360px;width:100%;">
        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($loginError) ?>
      </div>
    <?php endif; ?>

    <form class="login-form" name="loginForm" method="post" action="" onsubmit="return validateLogin(event)">
      <div class="login-field">
        <label for="email">Email address</label>
        <input type="email" id="email" name="email" placeholder="admin@example.com"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        <span class="field-error" id="emailErr"></span>
      </div>

      <div class="login-field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••">
        <span class="field-error" id="passErr"></span>
      </div>

      <button class="login-btn" type="submit">
        <i class="fas fa-sign-in-alt" style="margin-right:6px;"></i> Sign In
      </button>
    </form>
  </div>

</div>

<script>
function validateLogin(e) {
  var email = document.getElementById('email').value.trim();
  var pass  = document.getElementById('password').value;
  var ok    = true;

  document.getElementById('emailErr').textContent = '';
  document.getElementById('passErr').textContent  = '';

  if (!email) {
    document.getElementById('emailErr').textContent = 'Email address is required.';
    ok = false;
  }
  if (!pass) {
    document.getElementById('passErr').textContent = 'Password is required.';
    ok = false;
  }
  if (!ok) e.preventDefault();
}
</script>

</body>
</html>