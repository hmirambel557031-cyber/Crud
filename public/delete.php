<?php
require_once __DIR__ . "/../Component/pdo.php";
require_once __DIR__ . "/../Component/auth.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: view.php?status=invalid_request");
    exit;
}

$action = $_POST["action"] ?? "";

if ($action === "delete_all") {
    $stmt = $pdo->prepare("DELETE FROM users");
    $stmt->execute();

    header("Location: view.php?status=all_deleted");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: view.php?status=invalid_id");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

if ($stmt->rowCount() > 0) {
    header("Location: view.php?status=deleted");
    exit;
}

header("Location: view.php?status=not_found");
exit;
?>
