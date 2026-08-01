<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// If already logged in, go straight to the dashboard
if (!empty($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter both username and password.';
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password, fullname FROM users1 WHERE LOWER(username) = LOWER(?) LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        $storedPassword = $user['password'] ?? '';
        $passwordMatches = false;

        if ($user) {
            if (password_verify($password, $storedPassword)) {
                $passwordMatches = true;
            } elseif (hash_equals($storedPassword, $password)) {
                $passwordMatches = true;

                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $update = $pdo->prepare("UPDATE users1 SET password = ? WHERE id = ?");
                $update->execute([$newHash, $user['id']]);
            }
        }

        if ($passwordMatches) {
            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullname'] = $user['fullname'] ?? $user['username'];

            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login System</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<main class="auth-shell">
<section class="card auth-card">
    <div class="card-header">
        <p class="eyebrow">Welcome back</p>
        <h1>Login System</h1>
        
    </div>

    <?php if ($error): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" autocomplete="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="current-password" required>
        </div>

        <div class="btn-group">
            <button type="submit" name="login" class="btn-login">Login</button>
            <button type="reset" class="btn-reset">Reset</button>
        </div>
    </form>
</section>
</main>
</body>
</html>
