<?php
session_start();
if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
$_SESSION['msg'] = "Entre com seu email e senha.";
header("Location: index.php");
die();
}
//echo"<pre>";
//var_dump($_SESSION['user']);
//echo "Olá, " . $_SESSION['user']['name'] . "! Bem vindo ao sistema.";
//echo "<pre>";

$nome = $_SESSION['user']['nome'];
$arr = explode(" ", $nome);

echo $arr[0].", seja bem vindo ao sistema.";