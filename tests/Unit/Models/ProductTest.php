<?php
// tests/Unit/Models/ProductTest.php
namespace Tests\Unit\Models;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private $productData;

    protected function setUp(): void
    {
        $this->productData = [
            'id' => 1,
            'name' => 'Test Product',
            'price' => 99.99,
            'inventory' => 10,
            'product_code' => 'TP-001',
            'image' => '/test-image.jpg'
        ];
    }
    
    public function testProductCreation()
    {
        $product = new Product($this->productData);
        
        $this->assertEquals(1, $product->getId());
        $this->assertEquals('Test Product', $product->getName());
        $this->assertEquals(99.99, $product->getPrice());
        $this->assertEquals(10, $product->getInventory());
        $this->assertEquals('TP-001', $product->getProductCode());
        $this->assertEquals('/test-image.jpg', $product->getImage());
    }
    
    public function testProductWithMissingData()
    {
        $product = new Product([
            'name' => 'Partial Product',
            'price' => 49.99
        ]);
        
        $this->assertNull($product->getId());
        $this->assertEquals('Partial Product', $product->getName());
        $this->assertEquals(49.99, $product->getPrice());
        $this->assertEquals(0, $product->getInventory());
        $this->assertEquals('', $product->getProductCode());
        $this->assertEquals('', $product->getImage());
    }
}
