<?php
// tests/Unit/Services/ProductServiceTest.php
namespace Tests\Unit\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    public function testGetProducts()
    {
        // Create a mock for the repository
        $repository = $this->createMock(ProductRepository::class);
        
        // Set up expectations
        $mockProducts = [
            new Product([
                'id' => 1, 
                'name' => 'Mock Product', 
                'price' => 99.99
            ])
        ];
        
        $repository->expects($this->once())
            ->method('getFiltered')
            ->with(['name' => 'Mock Product'])
            ->willReturn($mockProducts);
        
        // Create service with mocked repository using reflection
        $service = new ProductService();
        $reflection = new \ReflectionClass($service);
        $property = $reflection->getProperty('productRepository');
        $property->setAccessible(true);
        $property->setValue($service, $repository);
        
        // Call the method
        $result = $service->getProducts(['name' => 'Mock Product']);
        
        // Assert results
        $this->assertSame($mockProducts, $result);
    }
    
    public function testGetFilterOptions()
    {
        // Create a mock for the repository
        $repository = $this->createMock(ProductRepository::class);
        
        // Set up expectations
        $mockOptions = [
            'name' => ['Product 1', 'Product 2'],
            'productCode' => ['P1', 'P2']
        ];
        
        $repository->expects($this->once())
            ->method('getFilterOptions')
            ->willReturn($mockOptions);
        
        // Create service with mocked repository using reflection
        $service = new ProductService();
        $reflection = new \ReflectionClass($service);
        $property = $reflection->getProperty('productRepository');
        $property->setAccessible(true);
        $property->setValue($service, $repository);
        
        // Call the method
        $result = $service->getFilterOptions();
        
        // Assert results
        $this->assertSame($mockOptions, $result);
    }
}
