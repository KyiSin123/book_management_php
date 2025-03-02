<?php
require_once '../bol.php';
include_once '../error_handler.php';
$name = $email = $phone = $password = $successMessage = $failMessage = '';
$nameErr = $emailErr = $phoneErr = $passwordErr = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    if (empty($name)) {
        $nameErr = 'Name is required';
    }
    if (empty($email)) {
        $emailErr = 'Email is required';
    }
    if (empty($phone)) {
        $phoneErr = 'Phone Number is required';
    }
    if (empty($password)) {
        $passwordErr = 'Password is required';
    }
    $isUniqueEmail = isUniqueEmail($email);
    $isValidPhone = isValidPhone($phone);
    if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($passwordErr)) {
        if($isUniqueEmail === false) {
            $failMessage = 'Email already exists';
        } elseif($isValidPhone === false) {
            $failMessage = 'Phone number must be 11 digits and start with 09';
        } else {
            $success = registerUser($name, $email, $phone, $password);  
            if($success !== 'success') {
                $failMessage = $success;
            } else {
                $successMessage = 'Registration successful';
                $name = $email = $phone = $password = '';           
            }
        }
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
                <h5 class="card-title text-center">Register</h5>
                <?php if (!empty($successMessage)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $successMessage; ?>
                    </div>
                <?php } ?>
                <?php if (!empty($failMessage)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $failMessage; ?>
                    </div>
                <?php } ?>
                <form action="register.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                        <span class="text-danger"><?php echo $nameErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                        <span class="text-danger"><?php echo $emailErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone No.</label>
                        <input type="number" class="form-control" id="email" name="phone" value="<?php echo $phone; ?>">
                        <span class="text-danger"><?php echo $phoneErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
                        <span class="text-danger"><?php echo $passwordErr; ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                If you already have an account? <a href="./login.php" class="card-link">Login </a>
            </div>
        </div>
    </div>
</body>
</html>