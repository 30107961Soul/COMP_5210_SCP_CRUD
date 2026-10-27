<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCP Foundation Admin Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top scp-navbar">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">SCP Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Read Records</a></li>
        <li class="nav-item"><a class="nav-link" href="create.php">Create Record</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="page-wrap">
<div class="container">
<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type'] ?? 'info') ?> alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['message']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
<?php endif; ?>
