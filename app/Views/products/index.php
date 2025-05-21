<section class="products-section">
    <h2>Products List</h2>
    
    <?php include '_filter_form.php'; ?>
    
    <div class="table-container">
        <table class="products-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Product Code</th>
                    <th>Inventory</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="5" class="no-data">No products found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <img src="<?= htmlspecialchars($product->getImage()) ?>" 
                                     alt="<?= htmlspecialchars($product->getName()) ?>" 
                                     class="product-image">
                            </td>
                            <td><?= htmlspecialchars($product->getName()) ?></td>
                            <td>$<?= number_format($product->getPrice(), 2) ?></td>
                            <td><?= htmlspecialchars($product->getProductCode()) ?></td>
                            <td><?= $product->getInventory() ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
