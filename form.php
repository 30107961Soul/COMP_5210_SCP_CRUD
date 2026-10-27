<?php $isEdit = isset($subject); ?>
<div class="card p-4">
<form method="post" novalidate>
    <div class="row g-3">

        <div class="col-md-4">
            <label class="form-label">Item Number</label>
            <input name="item_number" 
                   class="form-control <?= isset($errors['item_number'])?'is-invalid':'' ?>" 
                   value="<?= htmlspecialchars($subject['item_number'] ?? $_POST['item_number'] ?? '') ?>" 
                   placeholder="Enter SCP number">
            <div class="invalid-feedback"><?= $errors['item_number'] ?? '' ?></div>
        </div>

        <div class="col-md-4">
            <label class="form-label">Object Class</label>
            <?php $current = $subject['object_class'] ?? $_POST['object_class'] ?? ''; ?>
            <select name="object_class" 
                    class="form-select <?= isset($errors['object_class'])?'is-invalid':'' ?>">
                <option value="">Select class</option>
                <?php foreach(['Safe','Euclid','Keter','Thaumiel','Neutralized','Apollyon'] as $class): ?>
                    <option value="<?= $class ?>" <?= $current===$class?'selected':'' ?>>
                        <?= $class ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback"><?= $errors['object_class'] ?? '' ?></div>
        </div>

        <div class="col-md-4">
            <label class="form-label">Title</label>
            <input name="title" 
                   class="form-control <?= isset($errors['title'])?'is-invalid':'' ?>" 
                   value="<?= htmlspecialchars($subject['title'] ?? $_POST['title'] ?? '') ?>">
            <div class="invalid-feedback"><?= $errors['title'] ?? '' ?></div>
        </div>

        <div class="col-12">
            <label class="form-label">Special Containment Procedures</label>
            <textarea name="containment" rows="5" 
                      class="form-control <?= isset($errors['containment'])?'is-invalid':'' ?>">
                <?= htmlspecialchars($subject['containment'] ?? $_POST['containment'] ?? '') ?>
            </textarea>
            <div class="invalid-feedback"><?= $errors['containment'] ?? '' ?></div>
        </div>

        <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" rows="5" 
                      class="form-control <?= isset($errors['description'])?'is-invalid':'' ?>">
                <?= htmlspecialchars($subject['description'] ?? $_POST['description'] ?? '') ?>
            </textarea>
            <div class="invalid-feedback"><?= $errors['description'] ?? '' ?></div>
        </div>

        <div class="col-md-6">
            <label class="form-label">SCP Wiki Source URL</label>
            <input name="origin_url" 
                   class="form-control <?= isset($errors['origin_url'])?'is-invalid':'' ?>" 
                   value="<?= htmlspecialchars($subject['origin_url'] ?? $_POST['origin_url'] ?? '') ?>">
            <div class="invalid-feedback"><?= $errors['origin_url'] ?? '' ?></div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Image Path</label>
            <input name="image_path" class="form-control"
                   placeholder="e.g., images/SCP-002.jpg"
                   value="<?= htmlspecialchars($subject['image_path'] ?? $_POST['image_path'] ?? 'images/SCP-logo.png') ?>">
        </div>

        <div class="col-12 d-flex gap-2">
            <button class="btn btn-scp" type="submit">
                <?= $isEdit ? 'Update Record' : 'Create Record' ?>
            </button>
            <a class="btn btn-outline-light" href="index.php">Cancel</a>
        </div>

    </div>
</form>
</div>
