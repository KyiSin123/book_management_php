<div class="row justify-content-between bg-secondary text-white">
  <div class="col my-3 bg-secondary text-white ">
      <a class="text-white p-5 text-decoration-none my-5"><?php echo $_SESSION['user']['name'] ?></a>
  </div>
  <div class="col-auto m-3 bg-secondary text-white">   
      <a class="text-white text-decoration-none pe-3" href="./add_category.php">Add Category</a>
      <a class="text-white text-decoration-none pe-3" href="add_book.php">Add Book</a>
      <a class="text-white text-decoration-none" href="books.php?page=1">Book List</a>
      <a class="text-white text-decoration-none p-5" href="./logout.php">Logout</a>
</div>
</div>