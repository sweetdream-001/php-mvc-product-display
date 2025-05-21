<?php
// tests/Unit/Repositories/ProductRepositoryTest.php
namespace Tests\Unit\Repositories;

use App\Models\Product;
use App\Repositories\ProductRepository;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ProductRepositoryTest extends TestCase
{
    private $repository;
    private $testDataPath;
    
    protected function setUp(): void
    {
        $this->testDataPath = __DIR__ . '/../../../data/test-products.json';
        
        // Create test data if it doesn't exist
        if (!file_exists($this->testDataPath)) {
            $testData = [
                [
                    'id' => 1,
                    'name' => 'Test Product 1',
                    'price' => 99.99,
                    'inventory' => 10,
                    'product_code' => 'TP-001',
                    'image' => '/test-image1.jpg'
                ],
                [
                    'id' => 2,
                    'name' => 'Test Product 2',
                    'price' => 199.99,
                    'inventory' => 5,
                    'product_code' => 'TP-002',
                    'image' => '/test-image2.jpg'
                ]
            ];
            file_put_contents($this->testDataPath, json_encode($testData));
        }
        
        // Use reflection to set private properties
        $this->repository = new ProductRepository();
        $reflection = new ReflectionClass($this->repository);
        
        $dataPathProperty = $reflection->getProperty('dataPath');
        $dataPathProperty->setAccessible(true);
        $dataPathProperty->setValue($this->repository, $this->testDataPath);
        
        $defaultImageProperty = $reflection->getProperty('defaultImage');
        $defaultImageProperty->setAccessible(true);
        $defaultImageProperty->setValue($this->repository, '/images/placeholders/default.jpg');
    }
    
    public function testGetAll()
    {
        $products = $this->repository->getAll();
        
        $this->assertCount(2, $products);
        $this->assertContainsOnlyInstancesOf(Product::class, $products);
        $this->assertEquals('Test Product 1', $products[0]->getName());
        $this->assertEquals('Test Product 2', $products[1]->getName());
    }
    
    public function testGetFiltered()
    {
        $filteredProducts = $this->repository->getFiltered(['name' => 'Test Product 1']);
        $this->assertCount(1, $filteredProducts);
        
        $product = reset($filteredProducts);
        $this->assertEquals('Test Product 1', $product->getName());
        $this->assertEquals('TP-001', $product->getProductCode());
    }
    
    public function testGetFilterOptions()
    {
        $options = $this->repository->getFilterOptions();
        
        $this->assertArrayHasKey('name', $options);
        $this->assertArrayHasKey('productCode', $options);
        $this->assertCount(2, $options['name']);
        $this->assertCount(2, $options['productCode']);
        $this->assertContains('Test Product 1', $options['name']);
        $this->assertContains('TP-002', $options['productCode']);
    }
}
