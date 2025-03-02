<?php
require_once '../bol.php';
require_once '../dal.php';
include_once '../error_handler.php';
include_once '../common/header.php';
include_once '../common/nav.php';
require_once '../common/auth_check.php';

$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'title';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$books = getBooks($page ?? 1, 10, $search ?? '', $sort ?? 'title');
$no = 1;
$totalBooks = getTotalBooks();
$totalPages = ceil($totalBooks / 10);
?>
<div class="container pt-2">
    <form method="GET">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="text" name="search" value="<?php echo $search; ?>">
        <label for="sort">Sort by:</label>
        <select name="sort">
            <option value="title" <?php echo $sort === 'title' ? 'selected' : ''; ?>>Title</option>
            <option value="author" <?php echo $sort === 'author' ? 'selected' : ''; ?>>Author</option>
            <option value="price" <?php echo $sort === 'price' ? 'selected' : ''; ?>>Price</option>
        </select>
        <button type="submit" class="btn btn-sm btn-primary">Search</button>
    </form>
    <?php if (isset($_GET['message'])) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_GET['message']; ?>
        </div>
    <?php } ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book) { ?>
                <tr class="table-active">
                    <td> <?php echo $no++ ?></td>
                    <td> <?php echo htmlspecialchars($book['title']) ?></td>
                    <td> <?php echo htmlspecialchars($book['author']) ?></td>
                    <td> <?php echo htmlspecialchars($book['description']) ?></td>
                    <td> <?php echo htmlspecialchars($book['price']) ?></td>
                    <td> <?php $category = getCategoryById($book['category_id']);
                            echo htmlspecialchars($category['name']) ?></td>
                    <td><a class="btn bg-primary" href="edit_book.php?book_id=<?php echo $book['id'] ?>"> Edit </a> &nbsp; &nbsp;
                        <a class="btn bg-danger" href="delete_book.php?page=<?php echo $page ?>&book_id=<?php echo $book['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div>
        <?php if ($page > 1) { ?>
            <a href="?search=<?php echo urlencode($search); ?>&sort=<?php echo $sort ?>&page=<?php echo $page - 1; ?>">Previous</a>
        <?php } ?>
        <span>Page <?php echo $page ?? 1; ?> of <?php echo $totalPages; ?></span>
        <?php if ($page < $totalPages) { ?>
            <a href="?search=<?php echo urlencode($search); ?>&sort=<?php echo $sort ?>&page=<?php echo $page + 1; ?>">Next</a>
        <?php } ?>
    </div>
</div>