<?php
function loadEnv($path){
    if(!file_exists($path)){
        throw new Exception(".env não encontrado");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach($lines as $line){
        if(strpos(trim($line), '#') === 0) continue;

        list($name, $value) = explode('=', $line, 2);

        $name = trim($name);
        $value = trim($value);
        
        // ✅ Remove aspas duplas ou simples
        if ((substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
            (substr($value, 0, 1) === "'" && substr($value, -1) === "'")) {
            $value = substr($value, 1, -1);
        }

        putenv("$name=$value");
        $_ENV[$name] = $value;
    }
}

loadEnv(__DIR__.'/../.env');