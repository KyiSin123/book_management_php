<?php
require_once '../bol.php';
include_once '../error_handler.php';
include_once '../common/header.php';
include_once '../common/nav.php';

$title = $author = $description = $price = $category = $titleErr = $authorErr = $descriptionErr = 
$priceErr = $successMessage = $errorMessage = $categoryErr = '';
$categories = getCategories();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    if (empty($title)) {
        $titleErr = 'Title is required';
    }
    if (empty($author)) {
        $authorErr = 'Author is required';
    }
    if (empty($description)) {
        $descriptionErr = 'Description is required';
    }
    if (empty($price)) {
        $priceErr = 'Price is required';
    }
    if($category === '') {
        $categoryErr = 'Category is required';
    }
    if (empty($titleErr) && empty($authorErr) && empty($descriptionErr) && empty($priceErr) && empty($categoryErr)) {
        $isUniqueBookTitle = isUniqueBookTitle($title);
        if ($isUniqueBookTitle === false) {
            $titleErr = 'Book title already exists';
        } else {
            $result = addBook($title, $author, $description, $price, $category);
            if ($result === 'success') {
                $successMessage = 'Book added successfully';
                $title = $author = $description = $price = $category = '';
            } else {
                $errorMessage = $result;
            }
        }
    }
}
?>
<div class="row justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title text-center">Add Book</h5>
            <?php if(!empty($errorMessage)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php } ?>
            <?php if(!empty($successMessage)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMessage; ?>
                </div>
            <?php } ?>
            <form method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                    <span class="text-danger"><?php echo $titleErr; ?></span>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?php echo $author; ?>">
                    <span class="text-danger"><?php echo $authorErr; ?></span>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $description; ?>">
                    <span class="text-danger"><?php echo $descriptionErr; ?></span>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
                    <span class="text-danger"><?php echo $priceErr; ?></span>
                </div>
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Select Category</option>
                        <?php
                            foreach ($categories as $category) {
                                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                            }
                        ?>
                    </select>
                    <span class="text-danger"><?php echo $categoryErr; ?></span>
                </div>
                <button type="submit" class="btn btn-primary">Add Book</button>
            </form>
        </div>
    </div>
</div>