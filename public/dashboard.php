<?php
session_start();

// Protect this page: must be logged in
if (empty($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | Login System</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<main class="auth-shell">
<section class="card dashboard-card">
    <div class="dashboard-badge">Active Session</div>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['fullname'] ?? $_SESSION['username']) ?></h1>
    <p class="subtitle">You are signed in to the Simple Login System.</p>

    <div class="dashboard-panel">
        <span>Course</span>
        <strong>System Integration and Architecture 1</strong>
    </div>

    <a href="logout.php" class="btn-logout">Logout</a>
</section>
</main>
</body>
</html>
