<?php
echo "<h1>Teste de Caminhos JS</h1>";
echo "<style>body{font-family:Arial;background:#1C1C1E;color:#fff;padding:20px;} .ok{color:#2ecc71;} .erro{color:#ff6b6b;} .box{background:#2a2a2e;padding:20px;border-radius:8px;margin:15px 0;}</style>";

echo "<div class='box'>";
echo "<h2>Verificando Arquivos JS</h2>";

$arquivos = [
    'js/menu.js',
    'js/contato.js',
    'js/carousel.js',
    'assets/js/menu.js',
    'assets/js/contato.js',
    'public/js/menu.js',
    'public/js/contato.js',
    'resources/js/menu.js',
    'resources/js/contato.js'
];

foreach ($arquivos as $arq) {
    $caminhoCompleto = __DIR__ . '/' . $arq;
    if (file_exists($caminhoCompleto)) {
        $tamanho = filesize($caminhoCompleto);
        echo "<p class='ok'>✅ $arq ($tamanho bytes)</p>";
    } else {
        echo "<p class='erro'>❌ $arq</p>";
    }
}

echo "</div>";

echo "<div class='box'>";
echo "<h2>Procurando arquivos .js</h2>";
echo "<pre style='background:#000;padding:15px;border-radius:5px;'>";

function findJsFiles($dir, $prefix = '') {
    $files = [];
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . '/' . $item;
        if (is_dir($path)) {
            $files = array_merge($files, findJsFiles($path, $prefix . $item . '/'));
        } elseif (pathinfo($item, PATHINFO_EXTENSION) === 'js') {
            $files[] = $prefix . $item;
        }
    }
    return $files;
}

$jsFiles = findJsFiles(__DIR__);
if (count($jsFiles) > 0) {
    echo "Arquivos .js encontrados:\n";
    foreach ($jsFiles as $file) {
        echo "📄 $file\n";
    }
} else {
    echo "❌ Nenhum arquivo .js encontrado!\n";
}

echo "</pre>";
echo "</div>";
?>