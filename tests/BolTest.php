<?php
use PHPUnit\Framework\TestCase;
require_once('bol.php');

class BolTest extends TestCase
{
    protected function setUp(): void {
        global $pdo;
        if (!$pdo) {
            die(" Database connection failed in test environment.");
        }
        $pdo->exec("DELETE FROM users WHERE email = 'test@example.com'"); // ✅ Clean up test data
    }
    public function testIsUniqueEmail_WithExistingEmail_ReturnsFalse()
    {
        global $pdo;
        $result = isUniqueEmail('ks2@gmail.com');

        // Assert
        $this->assertFalse($result);
    }

    public function testIsUniqueEmail_WithNewEmail_ReturnsTrue()
    {
        $result = isUniqueEmail('test@example.com');

        // Assert
        $this->assertTrue($result);
    }

    public function testIsValidPhone_WithValidPhone_ReturnsTrue()
    {
        $result = isValidPhone('09123456789');
        $this->assertTrue($result);
    }

    public function testIsValidUser_WithInvalidCredentials_ReturnsFalse()
    {
        $hashedPassword = password_hash('password123', PASSWORD_DEFAULT);
        $mockUser = ['email' => 'test@example.com', 'password' => $hashedPassword];
        $result = isValidUser('test@example.com', 'wrongpassword');
        $this->assertFalse($result);
    }

    public function testIsUniqueCategory_WithExistingCategory_ReturnsFalse()
    {
        $result = isUniqueCategory('category1');
        $this->assertFalse($result);
    }

    public function testIsUniqueBookTitle_WithExistingTitle_ReturnsFalse()
    {
        $result = isUniqueBookTitle('Title1');
        $this->assertFalse($result);
    }

    public function testIsUniqueBookTitleNotItself_WithDifferentBook_ReturnsFalse()
    {
        $result = isUniqueBookTitleNotItself('Title2', 1);
        $this->assertFalse($result);
    }

    public function testIsUniqueBookTitleNotItself_ReturnsTrue()
    {
        $result = isUniqueBookTitleNotItself('Title1', 1);
        $this->assertTrue($result);
    }
} 