<?php

include_once "../database/connection.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

function generateSlug($text)
{
    $text = mb_strtolower($text, 'UTF-8');
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

$sql = "SELECT id, name FROM products";
$result = $conn->query($sql);

if (!$result) {
    die("Erro ao buscar produtos: " . $conn->error);
}

while ($product = $result->fetch_assoc()) {

    $slug = generateSlug($product['name']);

    $sql_update = "UPDATE products SET slug = ? WHERE id = ?";

    $stmt = $conn->prepare($sql_update);

    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }

    $stmt->bind_param("si", $slug, $product['id']);

    if ($stmt->execute()) {
        echo "Produto atualizado: {$product['name']} => {$slug}<br>";
    } else {
        echo "Erro ao atualizar {$product['name']}: " . $stmt->error . "<br>";
    }
}

echo "<hr>";
echo "Todos os slugs foram atualizados!";