<?php
session_start();
include_once "connection.php";

if($_POST && $_POST['btn_entrar']){
//sanitização
    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL) ??'';
    $senha = filter_input(INPUT_POST,'password',FILTER_DEFAULT) ??'';


    if(!isset($email) || empty($email)) die('email vazio');
    if(!isset($senha) || empty($senha)) die('senha vazia');

    $sql = "SELECT * FROM `users` WHERE `email` = ? LIMIT 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // echo "<pre>";
    // echo $sql . "<br>";
    // var_dump($user);
    // echo "</pre>";
    
    if($user && password_verify($senha, $user['password'])){
        $_SESSION['user'] = $user;
       header("Location: dashboard.php");
    }else{
        echo "Email ou senha inválidos.";
    }

    $conn->close();
}else{
    echo "Sem permissão";
}