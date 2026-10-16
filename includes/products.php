<?php

include 'database/connection.php';

//Promoções
$sql_products = "SELECT 
                  p.`id` as idProduto,
                  p.`name`,
                  p.`description`, 
                  p.`price`, 
                  p.`amount`, 
                  p.`image`,
                  p.`sale`,
                  d.`name` as nameDepartment,
                  c.name as nameCategory,
                  p.slug
                  FROM `products` as p 
                  INNER JOIN `department` as d ON (p.department_id = d.id) 
                  INNER JOIN `category` as c ON (p.category_id = c.id)
                  WHERE p.`sale` <> 0
                  ORDER BY p.`id` DESC
                  LIMIT 4";

$stmt_products = $conn->prepare($sql_products);

$stmt_products->execute();

$result = $stmt_products->get_result();

$products = $result->fetch_all();

$stmt_products->close();

$conn->close();

//Mais comprados
//sql de mais comprados
?>
<section class="products-section">
  <div class="container">

    <header class="products-section__header">
      <h1 class="products-section__title">Nossos Produtos</h1>
      <p class="products-section__subtitle">
        Confira as promoções e os produtos mais comprados da loja.
      </p>
    </header>

    <!-- PROMOÇÕES -->
    <section class="products-block" aria-labelledby="promocoes-title">
      <h2 id="promocoes-title" class="products-block__title">Promoções</h2>

      <div class="products-grid">
        <?php
        foreach ($products as $key => $product) {
        ?>

          <a href="produto/<?= $product[0] ?>/<?= $product[9] ?>" class="product-card">
            <img src="assets/img/products/<?= clearText($product[7]) ?>/<?= $product[5] ?>" alt="<?= $product[1] ?>" class="product-card__image">
            <div class="product-card__content">
              <span class="product-card__category"><?= $product[7] ?></span>
              <h3 class="product-card__name"><?= $product[1] ?></h3>
              <?php
              //Vai verificar se existe desconto
              if ($product[6] != 0) {
              ?>
                <span class="product-card__badge">-<?= $product[6] ?>%</span>
              <?php
              }
              ?>

              <div class="product-card__price-wrap" <?= $product[6] === 0 ? 'style="margin-top:52px;"' : '' ?>>
                <?php
                if ($product[6] != 0) {
                ?>
                  <span class="product-card__old-price">R$ <?= moneyBr($product[3], 2, ',', '.') ?></span>
                <?php } ?>
                <span class="product-card__price">R$
                  <?php
                  $desconto_cent    = $product[6] / 100; //Transformou em %
                  $valor_desc       = $product[3] * $desconto_cent; //Transformou %v em valor
                  $valor_final = $product[3] - $valor_desc;
                  echo moneyBr($valor_final);
                  ?>
                </span>
              </div>
              <span class="product-card__button">Ver produto</span>
            </div>
          </a>

        <?php } ?>
      </div>
    </section>

    <!-- MAIS COMPRADOS -->
    <section class="products-block" aria-labelledby="mais-comprados-title">
      <h2 id="mais-comprados-title" class="products-block__title">Mais comprados</h2>

      <div class="products-grid">
        <a href="#" class="product-card">
          <img src="https://picsum.photos/400/300?5" alt="Caixa de som bluetooth" class="product-card__image">
          <div class="product-card__content">
            <span class="product-card__category">Áudio</span>
            <h3 class="product-card__name">Caixa de Som Bluetooth</h3>
            <div class="product-card__price-wrap">
              <span class="product-card__price">R$ 189,90</span>
            </div>
            <span class="product-card__button">Ver produto</span>
          </div>
        </a>


      </div>
    </section>

  </div>
</section>