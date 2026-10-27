<?php
require 'config/database.php'; require 'includes/functions.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) { setMessage('Invalid record selected.', 'danger'); header('Location: index.php'); exit; }
$stmt = $pdo->prepare('SELECT * FROM SCP WHERE id = ?'); $stmt->execute([$id]); $subject = $stmt->fetch();
if (!$subject) { setMessage('Record not found.', 'warning'); header('Location: index.php'); exit; }
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validateSubject($_POST);
    if (empty($errors))  {
        $sql = "UPDATE SCP SET item_number=?, object_class=?, title=?, containment=?, description=?, origin_url=?, image_path=? WHERE id=?";
        try {
            $pdo->prepare($sql)->execute([clean($_POST['item_number']), clean($_POST['object_class']), clean($_POST['title']), clean($_POST['containment']), clean($_POST['description']), clean($_POST['origin_url'] ?? ''), clean($_POST['image_path'] ?? 'images/SCP-logo.png'), $id]);
            setMessage('SCP record updated successfully.', 'success'); header('Location: view.php?id='.$id); exit;
        } catch (PDOException $e) { $errors['item_number'] = 'Item number must be unique.'; }
    }
}
include 'includes/header.php';
?>
<h1 class="mb-4">Update SCP Record</h1>
<?php include 'form.php'; include 'includes/footer.php'; ?>
