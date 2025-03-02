<?php
require_once '../bol.php';
include_once '../error_handler.php';

$email = $password = $emailErr = $passwordErr = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)) {
        $emailErr = 'Email is required';
    }
    if (empty($password)) {
        $passwordErr = 'Password is required';
    }
    if(empty($emailErr) && empty($passwordErr)) {
        $isValidUser = isValidUser($email, $password);
        $user = getUserByEmail($email);
        if ($isValidUser) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: ../index.php');
            exit;
        }
        $error = 'Invalid email or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <title>Book Management</title>
</head>
<body>
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <span class="text-danger"><?php echo $emailErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="text-danger"><?php echo $passwordErr; ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                If you don't have an account? <a href="./register.php" class="card-link">Register </a>
            </div>
        </div>
    </div>
</body>
</html>