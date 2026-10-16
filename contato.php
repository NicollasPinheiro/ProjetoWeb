<?php $title = "Contato"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include 'includes/head.php'?>
<body>
    <?php include 'includes/header.php'?>
    
    <main class="container">
        <section class="contact-section">
            <h2 class="about-header">Entre em Contato</h2>
            <form id="formContato" class="contact-form">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" class="input-form" required>
                    <span class="error_form" id="erroNome"></span>
                </div>
                
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="input-form" required>
                    <span class="error_form" id="erroEmail"></span>
                </div>
                
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input type="text" id="assunto" name="assunto" class="input-form" required>
                    <span class="error_form" id="erroAssunto"></span>
                </div>
                
                <div class="form-group">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" class="input-form" rows="6" required></textarea>
                    <span class="error_form" id="erroMensagem"></span>
                </div>
                
                <button type="submit" class="btn-submit">Enviar Mensagem</button>
                <div id="statusEnvioContato" class="status-mensagem"></div>
            </form>
        </section>
    </main>

    <?php include 'includes/footer.php'?>
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/carousel.js"></script>
    <script src="assets/js/contato.js"></script>
</body>
</html>