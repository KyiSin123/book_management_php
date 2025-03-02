<?php
use PHPUnit\Framework\TestCase;
require_once 'dal.php';

class DalTest extends TestCase
{
    private $pdo;
    
    protected function setUp(): void {
        global $pdo;
        if (!$pdo) {
            die(" Database connection failed in test environment.");
        }
        $pdo->exec("DELETE FROM users WHERE email = 'test@example.com'");
    }
    
    public function testRegisterUser()
    {
        $result = registerUser('John Doe', 'john@example1.com', '09123456789', 'password123');
        $this->assertEquals('success', $result);
        
        $user = getUserByEmail('john@example1.com');
        $this->assertEquals('John Doe', $user['name']);
        $this->assertTrue(password_verify('password123', $user['password']));
    }
    
    public function testCategoryOperations()
    {
        // Test adding category
        $result = addCategory('Fiction1');
        $this->assertEquals('success', $result);
        
        // Test getting category
        $category = getCategory('Fiction1');
        $this->assertEquals('Fiction1', $category['name']);
        
        // Test getting all categories
        $categories = getCategories();
        $this->assertCount(5, $categories);
        $this->assertEquals('Fiction', $categories[0]['name']);
    }
    
    public function testBookOperations()
    {
        // Add a category first
        addCategory('Fiction1');
        $category = getCategory('Fiction1');
        
        // Test adding book
        $result = addBook('Test Book', 'Test Author', 'Description', 29.99, $category['id']);
        $this->assertEquals('success', $result);
        
        // Test getting book by title
        $book = getBookByTitle('Test Book');
        $this->assertEquals('Test Author', $book['author']);
        
        // Test getting book by ID
        $bookById = getBookById($book['id']);
        $this->assertEquals('Test Book', $bookById['title']);
        
        // Test updating book
        $result = updateBook('Updated Book', 'Updated Author', 'Updated Description', 39.99, $category['id'], 1);
        $this->assertEquals('success', $result);
        
        // Test pagination and search
        $books = getBooks(1, 10, 'Updated');
        $this->assertCount(1, $books);
        $this->assertEquals('Updated Book', $books[0]['title']);
        
        // Test total books count
        $totalBooks = getTotalBooks();
        $this->assertEquals(1, $totalBooks);
        
        // Test deleting book
        $result = deleteBook($book['id']);
        $this->assertEquals('success', $result);
        
        // Verify book was deleted
        $totalBooks = getTotalBooks();
        $this->assertEquals(0, $totalBooks);
    }
} 