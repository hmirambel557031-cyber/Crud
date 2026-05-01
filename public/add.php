<?php
require_once __DIR__ . "/../Component/pdo.php";
require_once __DIR__ . "/../Component/auth.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = trim($_POST["firstname"] ?? "");
    $lastname = trim($_POST["lastname"] ?? "");

    if ($firstname === "" || $lastname === "") {
        header("Location: add.php?success=0");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname) VALUES (?, ?)");
    $stmt->execute([$firstname, $lastname]);

    header("Location: add.php?success=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h4 mb-4 text-center">Add New User</h1>

                        <?php if (isset($_GET["success"]) && $_GET["success"] == 1): ?>
                            <div class="alert alert-success">User added successfully!</div>
                        <?php endif; ?>
                        <?php if (isset($_GET["success"]) && $_GET["success"] == 0): ?>
                            <div class="alert alert-danger">Please fill in all fields.</div>
                        <?php endif; ?>

                        <form method="post">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter first name" required>
                            </div>
                            <div class="mb-4">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter last name" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Save User</button>
                                <a href="view.php" class="btn btn-secondary btn-lg">View Users</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
