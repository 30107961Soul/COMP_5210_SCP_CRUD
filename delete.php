<?php
require 'config/database.php';
require 'includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validate ID from GET
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    setMessage('Invalid delete request.', 'danger');
    header('Location: index.php');
    exit;
}

// Delete record
$stmt = $pdo->prepare('DELETE FROM SCP WHERE id = ?');
$stmt->execute([$id]);

setMessage('SCP record deleted successfully.', 'success');
header('Location: index.php');
exit;
