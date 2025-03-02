<?php
require_once './common/auth_check.php';
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
<div class="row justify-content-between bg-secondary text-white">
  <div class="col my-3 bg-secondary text-white ">
      <a class="text-white p-5 text-decoration-none my-5"><?php echo $_SESSION['user']['name'] ?></a>
  </div>
  <div class="col-auto m-3 bg-secondary text-white">   
      <a class="text-white text-decoration-none pe-3" href="./pages/add_category.php">Add Category</a>
      <a class="text-white text-decoration-none pe-3" href="./pages/add_book.php">Add Book</a>
      <a class="text-white text-decoration-none" href="./pages/books.php?page=1">Book List</a>
      <a class="text-white text-decoration-none p-5" href="./pages/logout.php">Logout</a>
</div>
</div>
Hello <?php echo $_SESSION['user']['name']; ?>,
<h1>Welcome From Book Management System!</h1> 

</body>
</html>