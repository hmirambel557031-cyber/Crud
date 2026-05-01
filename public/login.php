<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");

    if ($username !== "") {
        $_SESSION["user"] = $username;
        header("Location: index.php");
        exit;
    }

    header("Location: login.php?error=1");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-5">
        <div class="card shadow-sm border-0">
          <div class="card-body p-4">
            <h1 class="h4 mb-4 text-center">Login</h1>

            <?php if (isset($_GET["error"]) && $_GET["error"] === "1"): ?>
              <div class="alert alert-danger">Please enter a username.</div>
            <?php endif; ?>

            <form method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Log In</button>
                <a href="index.php" class="btn btn-secondary">Back to Landing Page</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
