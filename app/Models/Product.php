<?php
namespace App\Models;

class Product
{
    private $id;
    private $name;
    private $price;
    private $inventory;
    private $productCode;
    private $image;
    
    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->price = $data['price'] ?? 0;
        $this->inventory = $data['inventory'] ?? 0;
        $this->productCode = $data['product_code'] ?? '';
        $this->image = $data['image'] ?? '';
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function getInventory()
    {
        return $this->inventory;
    }
    
    public function getProductCode()
    {
        return $this->productCode;
    }
    
    public function getImage()
    {
        return $this->image;
    }
}
