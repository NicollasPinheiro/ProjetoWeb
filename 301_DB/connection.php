<?php

$Server = "localhost";
$user = "root";
$pass = "";
$db = "loja";

$conn = new mysqli($Server, $user, $pass, $db);

if ($conn ->connect_error) die("Erro SQL: " .$conn->error);//die("Falha na conexão" . $conn->connect_error);

$conn->set_charset("utf8");
//echo "Conectado com sucesso!";


