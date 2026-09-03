<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // $senha = '123456';
        // $hash = password_hash($senha,PASSWORD_DEFAULT);
        // echo $hash;
        if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"])){
            echo "<p style='color: red;'>".$_SESSION["msg"]."</p>";
            unset($_SESSION["msg"]) ;
        }
    ?>
    <form action="verify.php" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <input type="submit" value="Entrar" name="btn_entrar">
        </div>
    </form>
</body>
</html>