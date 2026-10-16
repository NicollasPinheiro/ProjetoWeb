<?php
    http_response_code(404);
    $title = "Página não encontrada.";
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include 'includes/head.php'?>

<body>
    
    <?php include 'includes/header.php'?>
    
    <main>
        <section class="container">
            <div>
                <h1>Página não encontrada</h1>
                <p>A página não existe ou o acesso foi bloqueado!</p>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'?>

    <script src = "assets/js/menu.js"></script>
      
</body>

</html>