<?php
namespace App\Repositories;

use App\Models\Product;
use App\Helpers\Config;

class ProductRepository
{
    private $dataPath;
    private $defaultImage;
    
    public function __construct()
    {
        $config = Config::getInstance();
        
        $this->dataPath = $config->get('storage.products_json');
        $this->defaultImage = $config->get('storage.default_image');
    }
    
    public function getAll()
    {
        if (!file_exists($this->dataPath)) {
            $this->logError("Products data file not found: {$this->dataPath}");
            return [];
        }
        
        $jsonData = file_get_contents($this->dataPath);
        $productsData = json_decode($jsonData, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->logError("Error parsing products JSON: " . json_last_error_msg());
            return [];
        }
        
        $products = [];
        foreach ($productsData as $productData) {
            // Check if image exists, otherwise use default
            $productData['image'] = $this->verifyImage($productData['image'] ?? '');
            $products[] = new Product($productData);
        }
        
        return $products;
    }
    
    public function getFiltered(array $filters)
    {
        $allProducts = $this->getAll();
        
        if (empty($filters)) {
            return $allProducts;
        }
        
        return array_filter($allProducts, function($product) use ($filters) {
            foreach ($filters as $property => $value) {
                $getterMethod = 'get' . ucfirst($property);
                
                if (method_exists($product, $getterMethod)) {
                    $productValue = $product->$getterMethod();
                    
                    // Simple string comparison (could be enhanced for different types)
                    if (strtolower($productValue) != strtolower($value)) {
                        return false;
                    }
                }
            }
            return true;
        });
    }
    
    public function getFilterOptions()
    {
        $products = $this->getAll();
        $options = [
            'name' => [],
            'productCode' => []
        ];
        
        foreach ($products as $product) {
            $options['name'][$product->getName()] = $product->getName();
            $options['productCode'][$product->getProductCode()] = $product->getProductCode();
        }
        
        return $options;
    }
    
    private function verifyImage($imagePath)
    {
        if (empty($imagePath)) {
            return $this->defaultImage;
        }
        
        // If it's a URL, return it directly
        if (strpos($imagePath, 'http://') === 0 || strpos($imagePath, 'https://') === 0) {
            return $imagePath;
        }
        
        // Check if the file exists in the public directory
        $relativePath = ltrim($imagePath, '/');
        $fullPath = __DIR__ . '/../../public/' . $relativePath;
        
        return file_exists($fullPath) ? $imagePath : $this->defaultImage;
    }
    
    private function logError($message)
    {
        $config = Config::getInstance();
        
        if ($config->get('logging.level') === 'debug' || $config->get('logging.level') === 'error') {
            error_log("[ERROR] {$message}");
        }
    }
}
