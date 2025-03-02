<?php
require_once '../dal.php'; //chabge to bol.php in checking unit tests
function isUniqueEmail($email)
{
    global $pdo;
    try {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        if ($user) {
            return false;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return true;
}
function isValidPhone($phone)
{
    if (preg_match('/^09\d{9}$/', $phone)) {
        return true;
    }
    return false;
}

function isValidUser($email, $password)
{
    global $pdo;
    try {
       $user = getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return false;
}

function isUniqueCategory($category_name) {
    $category = getCategory($category_name);
    if ($category) {
        return false;
    }
    return true;
}

function isUniqueBookTitle($title) {
    global $pdo;
    try {
        $book = getBookByTitle($title);
        if ($book) {
            return false;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return true;
}
function isUniqueBookTitleNotItself($title, $id) {
    global $pdo;
    try {
        $book = getBookByTitleNotItself($title, $id);
        if ($book) {
            return false;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
    return true;
}
?>