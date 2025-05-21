<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;
    
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }
    
    public function getProducts(array $filters = [])
    {
        return $this->productRepository->getFiltered($filters);
    }
    
    public function getFilterOptions()
    {
        return $this->productRepository->getFilterOptions();
    }
}
