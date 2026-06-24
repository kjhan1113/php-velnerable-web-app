<?php
session_start();
include __DIR__ . '/../db-connection.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

$message = "";

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // 1. SQL Injection Prevention (Prepared Statement)
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Use password_verify() for hashed password from DB
            if ($password === trim($row['password'])) {

                $_SESSION['username'] = $row['username'];

                header("Location: /dashboard.php");
                exit;
            } else {
                $message = "Incorrect username or password";
            }
        } else {
            $message = "Incorrect username or password";
        }

        $stmt->close();
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    $message = "<h4 style='color: red;'>System error occurred.</h4>";
} finally {
    if (isset($conn)) {
        $conn->close();
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
    <main class="form-signin w-100 m-auto">
        <form class="align-items-center" method="POST" action="">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
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
            <p class="py-5">
                <?php echo $message; ?>
            </p>
        </form>
    </main>
</body>

</html>