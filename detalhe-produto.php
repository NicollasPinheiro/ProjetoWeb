<?php
include 'database/connection.php';

$title = "Produtos";
$id    = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? '';
$slug  = filter_input(INPUT_GET, 'slug', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';

if (!$id || !$slug) {
    header('Location:localhost/301_estudante_/produtos');
}

$sql = "SELECT 
            p.id,
            p.name,
            p.description,
            p.price,
            p.amount,
            p.image,
            p.image2,
            p.image3,
            p.sale, 
            p.slug,
            p.department_id,
            p.category_id,
            d.name AS department_name,
            c.name AS category_name      
            FROM `products` AS p
            INNER JOIN department AS d ON ( p.department_id = d.id )
            INNER JOIN category AS c ON ( p.category_id = c.id )
            WHERE p.`id` = ? AND p.`slug` = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $id, $slug);
$stmt->execute();
$result = $stmt->get_result();
$dataProduct = $result->fetch_assoc();
$stmt->close();

$sqlRelated = "SELECT
                    p.id,
                    p.name,
                    p.price,
                    p.image,
                    p.sale,
                    p.slug,
                    d.name AS department_name,
                    c.name AS category_name
                    FROM `products` AS p
                    INNER JOIN department AS d ON ( p.department_id = d.id )
                    INNER JOIN category AS c ON ( p.category_id = c.id )
                    WHERE p.department_id = ? AND p.id <> ?
                    ORDER BY p.id DESC   
                    LIMIT 4
                ";

$stmtRelated = $conn->prepare($sqlRelated);
$stmtRelated->bind_param("ii", $dataProduct['category_id'], $dataProduct['id']);
$stmtRelated->execute();
$resultRelated = $stmtRelated->get_result();
$relateProducts = $resultRelated->fetch_all();
$stmtRelated->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php include 'includes/head.php' ?>
<style>
    .product-gallery {
        display: flex;
        gap: 20px;
    }

    .gallery-thumbs {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .gallery-thumbs img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border: 2px solid #e5e5e5;
        border-radius: 10px;
        cursor: pointer;
        transition: .3s;
        background: #fff;
        padding: 5px;
    }

    .gallery-thumbs img:hover {
        border-color: #111;

    }

    .active-thumb {
        border-color: #111 !important;
    }

    .gallery-main {
        flex: 1;
    }

    .gallery-main img {
        width: 100%;
        border-radius: 10px;
        background: #f5f5f5;
        padding: 20px;
    }

    /* Detalhes */
    .product-info {
        background-color: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 32px;
    }

    .product-category {
        display: inline-block;
        background-color: #111827;
        color: #fff;
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 13px;
        margin-bottom: 18px;
    }

    .product-description {
        color: #6b7280;
        line-height: 1.7;
        margin-bottom: 24px;
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 8px;
    }

    .old-price {
        color: #9ca3af;
        text-decoration: line-through;
        font-size: 18px;
    }

    .current-price {
        color: #16a34a;
        font-size: 28px;
    }

    .discount-badge {
        background-color: #dc2626;
        color: #fff;
        padding: 4px 8px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
    }

    .installments {
        color: #16a34a;
        font-weight: 600;
        margin-bottom: 26px;
    }

    .in-stok {
        color: #16a34a;
        font-weight: 700;
    }

    .out-stok {
        color: #dc2626;
        font-weight: 700;
    }

    .product-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .btn-buy,
    .btn-cart {
        border: none;
        padding: 16px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-buy {
        background: #111827;
        color: #fff;
    }

    .btn-buy:hover {
        background: #374151;

    }

    .btn-cart {
        background: #f3f4f6;
        color: #111827;
    }

    .btn-cart:hover {
        background: #e5e7eb;
    }

    @media (max-width: 900px) {
        .product-details {
            grid-template-columns: 1fr;
        }

        .gallery-main img {
            height: 360px;
        }

    }

    @media (max-width: 600px) {
        .product-gallery {
            flex-direction: column-reverse;
        }

        .gallery-thumbs {
            flex-direction: row;
            overflow-x: auto;
        }

        .product-info {
            padding: 22px;
        }

        .product-info h1 {
            font-size: 26px;
        }

        .current-price {
            font-size: 30px;
        }

        .btn-buy,
        .btn-cart {
            width: 100%;
        }
    }
</style>

<body>

    <?php include 'includes/header.php' ?>

    <main class="bg-main">

        <section class="container pt-40">
            <div class="d-flex d-lg-flex">
                <div class="product-gallery w-lg-50">
                    <div class="gallery-thumbs">
                        <img class="thumb active-thumb" src="<?= getenv('URL_SITE') ?>/assets/img/products/<?= clearText($dataProduct['department_name']) ?>/<?= $dataProduct['image'] ?>" alt="<?= $dataProduct['name'] ?>">
                        <img class="thumb" src="<?= getenv('URL_SITE') ?>/assets/img/products/<?= clearText($dataProduct['department_name']) ?>/<?= $dataProduct['image2'] ?>" alt="<?= $dataProduct['name'] ?>">
                        <img class="thumb" src="<?= getenv('URL_SITE') ?>/assets/img/products/<?= clearText($dataProduct['department_name']) ?>/<?= $dataProduct['image3'] ?>" alt="<?= $dataProduct['name'] ?>">
                    </div>

                    <div class="gallery-main">
                        <img class="mainImage" id="mainImage" src="<?= getenv('URL_SITE') ?>/assets/img/products/<?= clearText($dataProduct['department_name']) ?>/<?= $dataProduct['image3'] ?>" alt="<?= $dataProduct['name'] ?>">
                    </div>
                </div>
                <div class="product-info w-lg-50">
                    <span class="product-category">
                        <?= $dataProduct['department_name'] ?> /
                        <?= $dataProduct['category_name'] ?>
                    </span>
                    <h1><?= $dataProduct['name'] ?></h1>
                    <p class="product-description">
                        <?= $dataProduct['description'] ?></p>
                    <?php
                    $price = (float) $dataProduct['price'];
                    $sale = (float) $dataProduct['sale'];
                    if ($sale > 0) {
                        $discountValue = $price * ($sale / 100);
                        $finalPrice = $price - $discountValue;
                    } else {
                        $finalPrice = $price;
                    }
                    ?>
                    <div class="product-price">
                        <?php if ($sale > 0): ?>
                            <span class="old-price"><?= moneyBr($price) ?></span>
                        <?php endif; ?>
                        <strong class="current-price"><?= moneyBr($finalPrice) ?></strong>
                        <?php if ($sale > 0): ?>
                            <span class="discount-badge">-<?= $sale ?> % OFF</span>
                        <?php endif; ?>
                    </div>
                    <p class="installments">
                        em até 12x de <?= moneyBr($finalPrice / 12) ?> sem juros
                    </p>
                    <div class="product-actions">
                        <?php if ($dataProduct['amount'] > 0): ?>
                            <span class="in-stock">Produto disponível</span>
                            <small>Estoque: <?= $dataProduct['amount'] ?> unidade(s)</small>
                        <?php else: ?>
                            <span class="out-stock">Produto indisponível</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-actions mt-30">
                        <button class="btn-buy">
                            Comprar
                        </button>
                        <button class="btn-cart">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            </div>
            <?php
            // echo "<pre>";
            // var_dump($dataProduc t);
            // echo "</pre>";
            //$relateProducts
            ?>
        </section>
    </main>

    <?php include 'includes/footer.php' ?>

    <script>
        const btn = document.querySelector('.btn_mobile');
        const menu = document.querySelector('.menu_mobile');
        const overlay = document.querySelector('.overlay');

        function openMenu() {
            menu.classList.add('open');
            overlay.classList.add('show');
        }

        function closeMenu() {
            menu.classList.remove('open');
            overlay.classList.remove('show');
        }

        function toggleMenu() {
            menu.classList.contains('open') ? closeMenu() : openMenu();
        }

        btn.addEventListener('click', toggleMenu); // ✅ certo
        overlay.addEventListener('click', closeMenu); // ok

        // gallery
        const thumbs = document.querySelectorAll('.thumb');
        const mainImage = document.querySelector('#mainImage');

        thumbs.forEach((thumb) => {
            thumb.addEventListener('click', () => {
                mainImage.src = thumb.src;

                thumbs.forEach((item) => {
                    item.classList.remove('active-thumb');

                });

                thumb.classList.add('active-thumb');
            });
        });
    </script>
</body>

</html>