<?php
require 'config/database.php';
require 'includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = validateSubject($_POST);

    if (empty($errors)) {

        $sql = "INSERT INTO SCP 
                (item_number, object_class, title, containment, description, origin_url, image_path)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                clean($_POST['item_number']),
                clean($_POST['object_class']),
                clean($_POST['title']),
                clean($_POST['containment']),
                clean($_POST['description']),
                clean($_POST['origin_url'] ?? ''),
                clean($_POST['image_path'] ?? 'assets/img/default-scp.svg')
            ]);

            setMessage('SCP record created successfully.', 'success');
            header('Location: index.php');
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $errors['item_number'] = 'Item number must be unique.';
            }
        }
    }
}

include 'includes/header.php';
?>

<h1 class="mb-4">Create SCP Record</h1>

<?php include 'form.php'; ?>
<?php include 'includes/footer.php'; ?>
