<?php
// tests/Unit/Models/AdvancedProductTest.php
namespace Tests\Unit\Models;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class AdvancedProductTest extends TestCase
{
    /**
     * @dataProvider productDataProvider
     */
    public function testProductCreationWithDataProvider($id, $name, $price, $inventory)
    {
        $product = new Product([
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'inventory' => $inventory
        ]);
        
        $this->assertEquals($id, $product->getId());
        $this->assertEquals($name, $product->getName());
        $this->assertEquals($price, $product->getPrice());
        $this->assertEquals($inventory, $product->getInventory());
    }
    
    public function productDataProvider()
    {
        return [
            [1, 'Product 1', 99.99, 10],
            [2, 'Product 2', 149.99, 5],
            [3, 'Product 3', 199.99, 0]
        ];
    }
}
