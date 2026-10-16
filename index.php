<?php
    $title = "Home";

?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php include 'includes/head.php'; ?>

<body>

    <?php include 'includes/header.php'; ?>

    <main>

        <?php include 'includes/carousel.php'; ?>

        <section class="container grid-itens-section">
            <div class="grid-itens">
                <div class="item">
                    <i class="fa fa-ticket" aria-hidden="true"></i>
                    <h2>Cupons ativos</h2>
                </div>
                <div class="item">
                    <i class="fa fa-id-card-o" aria-hidden="true"></i>
                    <h2>X12 sem juros</h2>
                </div>
                <div class="item">
                    <i class="fa fa-truck" aria-hidden="true"></i>
                    <h2>Frete gratis</h2>
                </div>
                <div class="item">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                    <h2>Whatsapp</h2>
                </div>
            </div>
        </section>
        <br>

        <?php include 'includes/products.php'; ?>

        <br>
        <section class="bg-newsletter pt-50 pb-50">

            <div class="container text-center">
                <h2 class="title-newsletter">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    &nbsp; | &nbsp;
                    Receba as novidades.
                </h2>
                <br>
                <form class="d-lg-flex" id="formContato" action="phpmailer/phpmailer.php" method="post">
                    <div class="position-relative w-lg-15 w-ex-23">
                        <input type="text" class="input-form w-100 w-lg-100 p-20 mb-20" name="nome" id="nome" placeholder="Escreva seu nome completo.">
                        <small class="erro_form" id="erroNome"></small>
                    </div>
                    <div class="position-relative w-lg-15 w-ex-23">
                        <input type="email" class="input-form w-100 w-lg-100 p-20 mb-20" name="email" id="email" placeholder="Escreva seu e-mail.">
                        <small class="erro_form" id="erroEmail"></small>
                    </div>
                    <div class="position-relative w-lg-15 w-ex-23">
                        <input type="text" class="input-form w-100 w-lg-100 p-20 mb-20" name="mensagem" id="mensagem" placeholder="Escreva sua mensagem.">
                        <small class="erro_form" id="erroMensagem"></small>
                    </div>
                    <div class="position-relative w-lg-15 w-ex-23">
                        <input type="submit" id="btnEnviar" class="btn-submit w-100 w-lg-100" value="Enviar">
                        <div id="statusEnvio"></div>
                    </div>
                </form>
            </div>

        </section>
    </main>

    <?php include 'includes/footer.php' ?>

    <script src="assets/js/menu.js"></script>
    <script src="assets/js/carousel.js"></script>
</body>

</html>