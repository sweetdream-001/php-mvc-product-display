<?php
namespace App\Controllers;

use App\Services\ProductService;
use App\Helpers\Config;

class ProductController
{
    protected $productService;
    protected $config;
    
    // Modified constructor to accept dependencies for testing
    public function __construct(ProductService $productService = null, Config $config = null)
    {
        $this->productService = $productService ?? new ProductService();
        $this->config = $config ?? Config::getInstance();
    }
    
    public function index()
    {
        // Get app name from config
        $appName = $this->config->get('name', 'Product Application');
        
        // Get filter parameters from GET request
        $filters = [];
        
        foreach ($_GET as $key => $value) {
            if (!empty($value)) {
                $filters[$key] = $value;
            }
        }
        
        // Get products with optional filters
        $products = $this->productService->getProducts($filters);
        
        // Get unique values for filter options
        $filterOptions = $this->productService->getFilterOptions();
        
        // Render view with data
        $this->render('products/index', [
            'products' => $products,
            'filterOptions' => $filterOptions,
            'currentFilters' => $filters,
            'appName' => $appName,
            'debug' => $this->config->get('debug', false)
        ]);
    }
    
    // Changed from private to protected so it can be mocked
    protected function render($view, $data = [])
    {
        // Extract data to make variables available in view
        extract($data);
        
        // Include layout
        include_once __DIR__ . '/../Views/layouts/main.php';
    }
}
