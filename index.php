<?php
require 'config/database.php';
require 'includes/functions.php';
include 'includes/header.php';

$search = trim($_GET['search'] ?? '');

if ($search !== '') {
    $stmt = $pdo->prepare("
        SELECT * FROM SCP 
        WHERE item_number LIKE ? 
        OR title LIKE ? 
        OR object_class LIKE ? 
        ORDER BY item_number ASC
    ");
    $term = "%$search%";
    $stmt->execute([$term, $term, $term]);
} else {
    $stmt = $pdo->query("SELECT * FROM SCP ORDER BY item_number ASC");
}

$subjects = $stmt->fetchAll();
?>

<section class="hero text-center">
    <span class="badge bg-danger mb-3">CLASSIFIED DATABASE</span>
    <h1>SCP Subject Management System</h1>
    <p class="lead mb-0">Responsive PHP/MySQL CRUD application for administrator control of SCP records.</p>
</section>

<div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
    <form class="d-flex flex-grow-1" method="get">
        <input class="form-control me-2" name="search" 
               placeholder="Search by item, title, or class" 
               value="<?= htmlspecialchars($search) ?>">
        <button class="btn btn-outline-light" type="submit">Search</button>
    </form>
    <a href="create.php" class="btn btn-scp">+ Add SCP Record</a>
</div>

<div class="row g-4">
<?php if (!$subjects): ?>
    <div class="col-12">
        <div class="alert alert-warning">No SCP records found.</div>
    </div>
<?php endif; ?>

<?php foreach ($subjects as $row): ?>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card h-100">
            <img src="<?= htmlspecialchars($row['image_path']) ?>" 
                 class="card-img-top" alt="SCP image">

            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start gap-2">
                    <h5 class="card-title mb-1"><?= htmlspecialchars($row['item_number']) ?></h5>
                    <span class="object-class <?= htmlspecialchars($row['object_class']) ?>">
                        <?= htmlspecialchars($row['object_class']) ?>
                    </span>
                </div>

                <h6 class="text-white-50 mb-3"><?= htmlspecialchars($row['title']) ?></h6>

                <p class="truncate">
                    <strong>Description:</strong> 
                    <?= htmlspecialchars($row['description']) ?>
                </p>

                <div class="btn-group-responsive mt-auto">
                    <a class="btn btn-outline-light btn-sm"
                       data-bs-toggle="modal"
                       data-bs-target="#scpModal<?= $row['id'] ?>">
                       Read
                    </a>

                    <a class="btn btn-warning btn-sm" 
                       href="edit.php?id=<?= (int)$row['id'] ?>">Update</a>

                    <a class="btn btn-danger btn-sm" 
                       href="delete.php?id=<?= (int)$row['id'] ?>"
                       onclick="return confirm('Delete <?= htmlspecialchars($row['item_number']) ?> permanently?')">
                       Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

</main> <!-- CLOSE page-wrap -->
</div> <!-- CLOSE container from header.php -->

<?php foreach ($subjects as $row): ?>
<div class="modal fade" id="scpModal<?= $row['id'] ?>" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-dark text-light border border-danger">
      <div class="modal-header border-secondary">
        <h5 class="modal-title">
          <?= htmlspecialchars($row['item_number']) ?> — <?= htmlspecialchars($row['title']) ?>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <img src="<?= htmlspecialchars($row['image_path']) ?>" 
             class="img-fluid rounded mb-3">

        <p><strong>Object Class:</strong>
           <span class="object-class <?= htmlspecialchars($row['object_class']) ?>">
             <?= htmlspecialchars($row['object_class']) ?>
           </span>
        </p>

        <h4>Special Containment Procedures</h4>
        <p><?= nl2br(htmlspecialchars($row['containment'])) ?></p>

        <h4>Description</h4>
        <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>

        <?php if ($row['origin_url']): ?>
          <a class="btn btn-outline-info btn-sm" 
             target="_blank" 
             href="<?= htmlspecialchars($row['origin_url']) ?>">
            View SCP Wiki Source
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>
