<?php

$conn = new mysqli("localhost", "root", "", "loja_app");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}