<?php
include 'database/connection.php';

$title = "Produtos";

// Busca todos os departamentos com seus produtos
$sql = "SELECT 
            p.id,
            p.name,
            p.description,
            p.price,
            p.image,
            p.sale,
            p.slug,
            p.department_id,
            d.name AS department_name
        FROM products AS p
        INNER JOIN department AS d ON (p.department_id = d.id)
        ORDER BY d.name ASC, p.id DESC";

$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();

// Agrupa produtos por departamento
$productsByDept = [];
foreach ($products as $product) {
    $deptName = $product['department_name'];
    if (!isset($productsByDept[$deptName])) {
        $productsByDept[$deptName] = [];
    }
    $productsByDept[$deptName][] = $product;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<?php include 'includes/head.php' ?>
<body>
    <?php include 'includes/header.php' ?>
    
    <main class="container pt-40">
        
        <?php foreach ($productsByDept as $deptName => $deptProducts): ?>
            
            <section class="department-section">
                <h2 class="department-title">
                    <?= htmlspecialchars($deptName) ?>
                </h2>
                
                <div class="products-grid">
                    <?php foreach ($deptProducts as $product): ?>
                        
                        <?php
                        $price = (float) $product['price'];
                        $sale = (float) $product['sale'];
                        if ($sale > 0) {
                            $finalPrice = $price - ($price * ($sale / 100));
                        } else {
                            $finalPrice = $price;
                        }
                        ?>
                        
                        <div class="product-card">
                            <?php if ($sale > 0): ?>
                                <span class="discount-badge">-<?= $sale ?>% OFF</span>
                            <?php endif; ?>
                            
                            <a href="produto-detalhe.php?id=<?= $product['id'] ?>&slug=<?= $product['slug'] ?>">
                                <img src="<?= getenv('URL_SITE') ?>/assets/img/products/<?= clearText($product['department_name']) ?>/<?= $product['image'] ?>" 
                                     alt="<?= htmlspecialchars($product['name']) ?>"
                                     onerror="this.src='<?= getenv('URL_SITE') ?>/assets/img/placeholder.jpg'">
                                
                                <h3><?= htmlspecialchars($product['name']) ?></h3>
                                
                                <div class="price">
                                    <?php if ($sale > 0): ?>
                                        <span class="old-price"><?= moneyBr($price) ?></span>
                                    <?php endif; ?>
                                    <strong class="current-price"><?= moneyBr($finalPrice) ?></strong>
                                </div>
                                
                                <p class="installments-text">
                                    ou 12x de <?= moneyBr($finalPrice / 12) ?> sem juros
                                </p>
                            </a>
                        </div>
                        
                    <?php endforeach; ?>
                </div>
            </section>
            
        <?php endforeach; ?>
        
    </main>
    
    <?php include 'includes/footer.php' ?>
    <script src="assets/js/menu.js"></script>
</body>
</html>