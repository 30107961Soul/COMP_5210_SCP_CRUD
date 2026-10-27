<?php
require 'config/database.php';
include 'includes/header.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$stmt = $pdo->prepare('SELECT * FROM SCP WHERE id = ?');
$stmt->execute([$id]);
$subject = $stmt->fetch();

if (!$subject): ?>
    <div class="alert alert-warning">Record not found.</div>
<?php else: ?>
<div class="card p-4">
    <div class="row g-4">

        <div class="col-md-4">
            <img src="<?= htmlspecialchars($subject['image_path']) ?>" 
                 class="img-fluid rounded" 
                 alt="SCP image">
        </div>

        <div class="col-md-8">
            <h1><?= htmlspecialchars($subject['item_number']) ?>: 
                <?= htmlspecialchars($subject['title']) ?>
            </h1>

            <p class="object-class <?= htmlspecialchars($subject['object_class']) ?>">
                Object Class: <?= htmlspecialchars($subject['object_class']) ?>
            </p>

            <h4>Special Containment Procedures</h4>
            <p><?= nl2br(htmlspecialchars($subject['containment'])) ?></p>

            <h4>Description</h4>
            <p><?= nl2br(htmlspecialchars($subject['description'])) ?></p>

            <?php if ($subject['origin_url']): ?>
                <a class="btn btn-outline-info btn-sm" 
                   target="_blank" 
                   href="<?= htmlspecialchars($subject['origin_url']) ?>">
                   View SCP Wiki Source
                </a>
            <?php endif; ?>

            <a class="btn btn-warning btn-sm" 
               href="edit.php?id=<?= (int)$subject['id'] ?>">
               Edit
            </a>

            <a class="btn btn-danger btn-sm" 
               href="delete.php?id=<?= (int)$subject['id'] ?>"
               onclick="return confirm('Delete this record?')">
               Delete
            </a>

            <a class="btn btn-outline-light btn-sm" href="index.php">
                Back
            </a>
        </div>

    </div>
</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
