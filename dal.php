<?php
require_once '../config.php'; //chabge to config.php in checking unit tests
function registerUser($name, $email, $phone, $password)
{
    global $pdo;
    try {
        $sql = 'INSERT INTO users (name, email, phone_no, password) VALUES (?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $phone, password_hash($password, PASSWORD_DEFAULT)]);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return 'success';
}

function getUserByEmail($email)
{
    global $pdo;
    try {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getCategory($category_name) {
    global $pdo;
    try {
        $sql = 'SELECT * FROM categories WHERE name = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_name]);
        $category = $stmt->fetch();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return $category;
}

function addCategory($category_name) {
    global $pdo;
    try {
        $sql = 'INSERT INTO categories (name) VALUES (?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_name]);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return 'success';
}

function getCategories() {
    global $pdo;
    try {
        $sql = 'SELECT * FROM categories';
        $stmt = $pdo->query($sql);
        $categories = $stmt->fetchAll();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return $categories;
}

function getBookByTitle($title) {
    global $pdo;
    try {
        $sql = 'SELECT * FROM books WHERE title = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title]);
        $book = $stmt->fetch();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return $book;
}

function getBookByTitleNotItself($title, $id) {
    global $pdo;
    try {
        $sql = 'SELECT * FROM books WHERE title = ? AND id != ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $id]);
        $book = $stmt->fetch();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return $book;
}

function addBook($title, $author, $description, $price, $category_id) {
    global $pdo;
    try {
        $sql = 'INSERT INTO books (title, author, description, price, category_id) VALUES (?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $author, $description, $price, $category_id]);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return 'success';
}

function getTotalBooks() {
    global $pdo;
    try {
        $sql = 'SELECT COUNT(*) FROM books';
        $stmt = $pdo->query($sql);
        $totalBooks = $stmt->fetchColumn();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return $totalBooks;
}

function getBooks($page = 1, $perPage = 10, $search = '', $sort = 'title') { 
    global $pdo; 
    $offset = ($page - 1) * $perPage; 
    $sql = "SELECT * FROM books WHERE title LIKE :search OR author LIKE :search ORDER BY $sort 
    LIMIT :limit OFFSET :offset"; 
    $stmt = $pdo->prepare($sql); 
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR); 
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT); 
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT); 
    $stmt->execute(); 
    return $stmt->fetchAll(); 
}

function getBookById($id) {
    global $pdo;
    try {
        $sql = 'SELECT * FROM books WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $book = $stmt->fetch();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return $book;
}

function getCategoryById($id) {
    global $pdo;
    try {
        $sql = 'SELECT * FROM categories WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $category = $stmt->fetch();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return $category;
}

function updateBook($title, $author, $description, $price, $category_id, $book_id) {
    global $pdo;
    try {
        $sql = 'UPDATE books SET title = ?, author = ?, description = ?, price = ?, category_id = ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $author, $description, $price, $category_id, $book_id]); 
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return 'success';
}

function deleteBook($id) {
    global $pdo;
    try {
        $sql = 'DELETE FROM books WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return 'success';
}
?>