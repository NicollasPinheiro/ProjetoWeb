<?php

function clearText($text){
    // Transforma paraminúsculo
    $text = mb_strtolower($text, 'UTF-8');
    // remove acentos
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    // remove caracteres especiais
    $text = preg_replace('/[^a-z0-9\s]/', '', $text);
    // remove espaços duplicados
    $text = preg_replace('/\s+/', ' ', $text);
    // remove espaços e hífem
    $text = preg_replace('/[\s-]+/', ' ', $text);
    // remove espaços do início e do fim
    $text = trim($text);
    
    return $text;
}

// formata valor para moeda  brasileira

function moneyBr($value){
    return 'R$ '.number_format($value, 2, ',', '.');
}