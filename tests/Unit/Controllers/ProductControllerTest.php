<?php
// tests/Unit/Controllers/ProductControllerTest.php
namespace Tests\Unit\Controllers;

use App\Controllers\ProductController;
use App\Services\ProductService;
use App\Helpers\Config;
use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductControllerTest extends TestCase
{
    private $controller;
    private $serviceMock;
    private $configMock;
    
    protected function setUp(): void
    {
        // Create mock for the service
        $this->serviceMock = $this->createMock(ProductService::class);
        
        // Create mock for the Config class
        $this->configMock = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
            
        // Configure mock Config behavior
        $this->configMock->method('get')
            ->willReturnMap([
                ['name', 'Product Application', 'Test Product App'],
                ['debug', false, true]
            ]);
        
        // Create controller with mocked dependencies
        $this->controller = new ProductController($this->serviceMock, $this->configMock);
    }
    
    public function testIndex()
    {
        // Prepare test data
        $mockProducts = [
            new Product([
                'id' => 1,
                'name' => 'Test Product',
                'price' => 99.99
            ])
        ];
        
        $mockFilterOptions = [
            'name' => ['Product 1'],
            'productCode' => ['P1']
        ];
        
        // Reset any GET parameters
        $_GET = [];
        
        // Set up expectations for service calls
        $this->serviceMock->expects($this->once())
            ->method('getProducts')
            ->with([]) // Empty filter array
            ->willReturn($mockProducts);
            
        $this->serviceMock->expects($this->once())
            ->method('getFilterOptions')
            ->willReturn($mockFilterOptions);
        
        // Create a partial mock of the controller to prevent actual rendering
        $controllerMock = $this->getMockBuilder(ProductController::class)
            ->setConstructorArgs([$this->serviceMock, $this->configMock])
            ->onlyMethods(['render'])
            ->getMock();
        
        // Set expectations for the render method
        $controllerMock->expects($this->once())
            ->method('render')
            ->with(
                $this->equalTo('products/index'),
                $this->callback(function($data) use ($mockProducts, $mockFilterOptions) {
                    return isset($data['products']) 
                        && isset($data['filterOptions'])
                        && $data['currentFilters'] === [];
                })
            );
        
        // Execute the controller method
        $controllerMock->index();
    }
}
