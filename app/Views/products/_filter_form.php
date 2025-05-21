<div class="filter-container">
    <h3>Filter Products</h3>
    <form action="" method="GET" class="filter-form">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <select name="name" id="name">
                <option value="">All</option>
                <?php foreach ($filterOptions['name'] as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>" <?= isset($currentFilters['name']) && $currentFilters['name'] == $name ? 'selected' : '' ?>>
                        <?= htmlspecialchars($name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="productCode">Product Code:</label>
            <select name="productCode" id="productCode">
                <option value="">All</option>
                <?php foreach ($filterOptions['productCode'] as $code): ?>
                    <option value="<?= htmlspecialchars($code) ?>" <?= isset($currentFilters['productCode']) && $currentFilters['productCode'] == $code ? 'selected' : '' ?>>
                        <?= htmlspecialchars($code) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-filter">Filter</button>
            <a href="?" class="btn-reset">Reset</a>
        </div>
    </form>
</div>
