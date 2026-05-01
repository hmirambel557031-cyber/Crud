<?php
session_start();
$loggedInUser = $_SESSION["user"] ?? "";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UserCore Landing Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8">
        <div class="card shadow-sm border-0">
          <div class="card-body p-4 p-md-5">
            <h1 class="h3 mb-3">Welcome to UserCore</h1>
            <p class="text-muted mb-4">Your user management landing page.</p>

            <?php if ($loggedInUser !== ""): ?>
              <div class="alert alert-success">
                Logged in as <strong><?php echo htmlspecialchars($loggedInUser, ENT_QUOTES, "UTF-8"); ?></strong>.
              </div>
            <?php else: ?>
              <div class="alert alert-secondary">
                You are not logged in.
              </div>
            <?php endif; ?>

            <div class="d-flex flex-wrap gap-2">
              <?php if ($loggedInUser === ""): ?>
                <a href="login.php" class="btn btn-primary">Login</a>
              <?php else: ?>
                <a href="logout.php" class="btn btn-outline-danger">Logout</a>
              <?php endif; ?>
              <a href="view.php" class="btn btn-outline-secondary">View Users</a>
              <a href="add.php" class="btn btn-outline-secondary">Add User</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
