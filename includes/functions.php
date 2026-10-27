<?php
function setMessage(string $message, string $type = 'success'): void {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}

function clean(string $value): string {
    return trim($value);
}

function validateSubject(array $data): array {
    $errors = [];
    $required = ['item_number','object_class','title','containment','description'];
    foreach ($required as $field) {
        if (empty(trim($data[$field] ?? ''))) {
            $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }
    if (!empty($data['origin_url']) && !filter_var($data['origin_url'], FILTER_VALIDATE_URL)) {
        $errors['origin_url'] = 'Origin URL must be a valid URL.';
    }
    return $errors;
}
?>