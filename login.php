<?php
require_once __DIR__ . '/includes/config.php';

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['login_username'] ?? '');
    $password = trim($_POST['login_password'] ?? '');
    
    if ($username !== '' && $password !== '') {
        if (authenticateUser($username, $password)) {
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
    } else {
        $error = 'Silakan isi username dan password.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - SIMKOM</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" />
  <link rel="stylesheet" href="assets/styles.css" />
  <style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle at top left, rgba(56, 189, 248, 0.12), transparent 28%),
                  radial-gradient(circle at bottom right, rgba(167, 139, 250, 0.12), transparent 28%),
                  #f5f7ff;
    }
    .login-card {
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 32px;
      box-shadow: 0 24px 72px rgba(15, 23, 42, 0.08);
      padding: 40px;
      width: 100%;
      max-width: 400px;
    }
    .login-header {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 16px;
      margin-bottom: 32px;
    }
    .login-icon {
      display: flex;
      height: 56px;
      width: 56px;
      align-items: center;
      justify-content: center;
      border-radius: 16px;
      background: #0ea5e9;
      color: white;
    }
    .login-title {
      font-size: 28px;
      font-weight: 700;
      margin: 0;
      color: #0f172a;
    }
    .error-message {
      margin-bottom: 16px;
      border-radius: 16px;
      background: rgba(220, 38, 38, 0.1);
      padding: 16px;
      font-size: 14px;
      color: #dc2626;
    }
    .form-group {
      margin-bottom: 16px;
    }
    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 8px;
      color: #0f172a;
    }
    .form-input {
      width: 100%;
      border-radius: 18px;
      border: 1px solid #e2e8f0;
      background: #fafbff;
      color: #0f172a;
      padding: 10px 16px;
      outline: none;
      font-size: 14px;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-input:focus {
      border-color: rgba(56, 189, 248, 0.6);
      box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.12);
    }
    .password-group {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .password-group .form-input {
      flex: 1;
    }
    .toggle-password {
      background: transparent;
      border: none;
      cursor: pointer;
      color: #64748b;
      font-size: 24px;
      transition: color 0.2s ease;
    }
    .toggle-password:hover {
      color: #334155;
    }
    .remember-label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      margin: 16px 0;
      color: #0f172a;
    }
    .remember-label input {
      cursor: pointer;
    }
    .login-button {
      width: 100%;
      border-radius: 18px;
      background: #0ea5e9;
      color: white;
      border: none;
      padding: 12px 16px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }
    .login-button:hover {
      background: #0284c7;
      transform: translateY(-1px);
      box-shadow: 0 16px 32px rgba(59, 130, 246, 0.16);
    }
  </style>
</head>
<body>
<div class="login-container">
  <div class="login-card">
    <div class="login-header">
      <div class="login-icon">
        <span class="material-symbols-outlined">lock</span>
      </div>
      <h1 class="login-title">Login SIMKOM</h1>
    </div>

    <?php if ($error): ?>
      <div class="error-message"><?= htmlentities($error) ?></div>
    <?php endif; ?>

    <form method="post" action="login.php">
      <div class="form-group">
        <label class="form-label">Username</label>
        <input type="text" name="login_username" placeholder="Masukkan username" class="form-input" value="<?= htmlentities($_POST['login_username'] ?? '') ?>" required />
      </div>

      <div class="form-group">
        <label class="form-label">Password</label>
        <div class="password-group">
          <input type="password" id="login-password" name="login_password" placeholder="Masukkan password" class="form-input" required />
          <button type="button" id="toggle-password" class="toggle-password material-symbols-outlined">visibility</button>
        </div>
      </div>

      <label class="remember-label">
        <input type="checkbox" name="remember_me" />
        <span>Ingat saya</span>
      </label>

      <button type="submit" class="login-button">Masuk</button>
    </form>
  </div>
</div>

<script>
  const toggleBtn = document.getElementById('toggle-password');
  const passwordField = document.getElementById('login-password');
  
  toggleBtn.addEventListener('click', function() {
    const isPassword = passwordField.type === 'password';
    passwordField.type = isPassword ? 'text' : 'password';
    toggleBtn.textContent = isPassword ? 'visibility_off' : 'visibility';
  });
</script>
</body>
</html>
<div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm max-w-md mx-auto">
  <div class="flex items-center justify-center gap-3 mb-6">
    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-500 text-white">
      <span class="material-symbols-outlined">lock</span>
    </div>
    <h2 class="text-2xl font-bold">Login SIMKOM</h2>
  </div>
  <?php if ($error !== ''): ?>
    <div class="mb-4 rounded-2xl bg-rose-50 p-4 text-sm text-rose-700"><?= htmlentities($error) ?></div>
  <?php endif; ?>
  <form id="login-form" class="space-y-4" method="post" action="login.php">
    <div>
      <label class="block text-sm font-medium mb-2">Email / Username</label>
      <input type="text" name="login_username" placeholder="Masukkan email atau username" class="w-full rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" value="<?= htmlentities($username ?? '') ?>" />
    </div>
    <div>
      <label class="block text-sm font-medium mb-2">Password</label>
      <div class="flex items-center gap-2">
        <input type="password" id="login-password" name="login_password" placeholder="Masukkan password" class="flex-1 rounded-2xl border border-slate-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500" />
        <button type="button" id="toggle-password" class="material-symbols-outlined text-slate-500 hover:text-slate-700 cursor-pointer">visibility</button>
      </div>
    </div>
    <label class="flex items-center gap-2 text-sm">
      <input type="checkbox" name="remember_me" class="rounded" />
      <span>Ingat saya</span>
    </label>
    <button type="submit" class="w-full rounded-2xl bg-sky-500 px-4 py-2 text-white font-medium transition hover:bg-sky-600">Login</button>
  </form>
</div>
<script>
  const togglePassword = document.getElementById('toggle-password');
  const passwordField = document.getElementById('login-password');
  togglePassword.addEventListener('click', () => {
    passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
    togglePassword.textContent = passwordField.type === 'password' ? 'visibility' : 'visibility_off';
  });
</script>
<?php
renderFooter();
