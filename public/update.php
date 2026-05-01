<?php
require_once __DIR__ . "/../Component/pdo.php";
require_once __DIR__ . "/../Component/auth.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $firstname = trim($_POST["firstname"] ?? "");
    $lastname = trim($_POST["lastname"] ?? "");

    if (!$id) {
        header("Location: view.php?status=invalid_id");
        exit;
    }

    if ($firstname === "" || $lastname === "") {
        $error = "Please fill in all fields.";
    } else {
        $sql = "UPDATE users SET firstname = ?, lastname = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$firstname, $lastname, $id]);

        header("Location: view.php?status=updated");
        exit;
    }
}

if (!$id) {
    header("Location: view.php?status=invalid_id");
    exit;
}

$stmt = $pdo->prepare("SELECT id, firstname, lastname FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: view.php?status=not_found");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-body p-4 p-md-5">
            <h1 class="h4 mb-4 text-center">Update User</h1>

            <?php if ($error !== ""): ?>
              <div class="alert alert-danger"><?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8"); ?></div>
            <?php endif; ?>

            <form method="post">
              <input type="hidden" name="id" value="<?php echo htmlspecialchars((string) $user["id"], ENT_QUOTES, "UTF-8"); ?>">

              <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input
                  type="text"
                  id="firstname"
                  name="firstname"
                  class="form-control"
                  value="<?php echo htmlspecialchars($user["firstname"], ENT_QUOTES, "UTF-8"); ?>"
                  required
                >
              </div>

              <div class="mb-4">
                <label for="lastname" class="form-label">Last Name</label>
                <input
                  type="text"
                  id="lastname"
                  name="lastname"
                  class="form-control"
                  value="<?php echo htmlspecialchars($user["lastname"], ENT_QUOTES, "UTF-8"); ?>"
                  required
                >
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Update User</button>
                <a href="view.php" class="btn btn-secondary btn-lg">Back to Users</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
