<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($appName ?? 'Product Management') ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?= htmlspecialchars($appName ?? 'Product Management') ?></h1>
        </header>
        
        <main>
            <?php include_once __DIR__ . '/../' . $view . '.php'; ?>
        </main>
        
        <footer>
            <p>PHP MVC Demo &copy; <?= date('Y') ?></p>
            <?php if(isset($debug) && $debug): ?>
                <div class="debug-info">Debug Mode Active</div>
            <?php endif; ?>
        </footer>
    </div>
    
    <script src="/js/script.js"></script>
</body>
</html>
