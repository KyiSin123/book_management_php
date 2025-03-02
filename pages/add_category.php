<?php
require_once '../bol.php';
include_once '../error_handler.php';
include_once '../common/header.php';
include_once '../common/nav.php';
include_once '../common/auth_check.php';

$category_name = $category_nameErr = $successMessage = $errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];
    if (empty($category_name)) {
        $category_nameErr = 'Category name is required';
    }
    if (empty($category_nameErr)) {
        $isUniqueCategory = isUniqueCategory($category_name);
        if ($isUniqueCategory === false) {
            $category_nameErr = 'Category name already exists';
        } else {
            $result = addCategory($category_name);
            if ($result === 'success') {
                $successMessage = 'Category added successfully';
                $category_name = '';
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
            <h5 class="card-title text-center">Add Category</h5>
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
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="category" name="category_name" value="<?php echo $category_name; ?>">
                    <span class="text-danger"><?php echo $category_nameErr; ?></span>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>
</div>