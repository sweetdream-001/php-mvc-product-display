<?php
// tests/Integration/ProductDisplayTest.php
namespace Tests\Integration;

use App\Repositories\ProductRepository;
use App\Services\ProductService;
use PHPUnit\Framework\TestCase;

class ProductDisplayTest extends TestCase
{
    private $repository;
    private $service;
    
    protected function setUp(): void
    {
        // Create test data
        $testDataPath = __DIR__ . '/../../data/test-products.json';
        $testData = [
            [
                'id' => 1,
                'name' => 'Integration Test Product',
                'price' => 129.99,
                'inventory' => 15,
                'product_code' => 'ITP-001',
                'image' => '/test-integration.jpg'
            ]
        ];
        file_put_contents($testDataPath, json_encode($testData));
        
        // Create actual instances (not mocks)
        $this->repository = new ProductRepository();
        $reflection = new \ReflectionClass($this->repository);
        $property = $reflection->getProperty('dataPath');
        $property->setAccessible(true);
        $property->setValue($this->repository, $testDataPath);
        
        $this->service = new ProductService();
        $reflection = new \ReflectionClass($this->service);
        $property = $reflection->getProperty('productRepository');
        $property->setAccessible(true);
        $property->setValue($this->service, $this->repository);
    }
    
    public function testProductFilteringFlow()
    {
        // Test the entire flow from service to repository
        $products = $this->service->getProducts(['name' => 'Integration Test Product']);
        
        $this->assertCount(1, $products);
        $this->assertEquals('Integration Test Product', $products[0]->getName());
        $this->assertEquals(129.99, $products[0]->getPrice());
        
        // Test with a filter that should return no results
        $emptyResults = $this->service->getProducts(['name' => 'Non-existent Product']);
        $this->assertCount(0, $emptyResults);
    }
    
    protected function tearDown(): void
    {
        // Clean up test data
        $testDataPath = __DIR__ . '/../../data/test-products.json';
        if (file_exists($testDataPath)) {
            unlink($testDataPath);
        }
    }
}
