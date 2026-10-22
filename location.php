<?php
require __DIR__ . '/api.php';

$characterId = (int) ($_GET['character'] ?? 0);
$character = $characterId > 0 ? get_character($characterId) : null;

$location = null;
if ($character && !empty($character['location']['url'])) {
    $location = api_get($character['location']['url']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p><a href="index.php">&larr; Voltar</a></p>

    <?php if (!$character): ?>
        <p class="error">Personagem não encontrado.</p>
    <?php else: ?>
        <div class="card">
            <img src="<?= e($character['image']) ?>" alt="<?= e($character['name']) ?>">
            <h1><?= e($character['name']) ?></h1>
        </div>

        <h2>Location</h2>
        <?php if ($location): ?>
            <table>
                <tr><th>Nome</th><td><?= e($location['name']) ?></td></tr>
                <tr><th>Tipo</th><td><?= e($location['type']) ?></td></tr>
                <tr><th>Dimensão</th><td><?= e($location['dimension']) ?></td></tr>
                <tr><th>Residentes</th><td><?= count($location['residents']) ?></td></tr>
            </table>
        <?php else: ?>
            <p><?= e($character['location']['name'] ?? 'unknown') ?></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
