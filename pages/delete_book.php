<?php
require_once '../dal.php';
include_once '../error_handler.php';

if(isset($_GET['book_id'])) {
    $result = deleteBook($_GET['book_id']);
    if ($result === 'success') {
        header(header: "Location:./books.php?page=$page&message=Book deleted successfully");
    } else {
        echo $result;
    }
}