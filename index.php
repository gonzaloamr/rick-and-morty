<?php
require __DIR__ . '/api.php';

// 1 = Rick Sanchez, 2 = Morty Smith
$characters = get_characters([1, 2]);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rick and Morty</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Rick and Morty</h1>
    <p>Clique na foto para ver a location do personagem.</p>

    <?php if (empty($characters)): ?>
        <p class="error">Não foi possível carregar os personagens.</p>
    <?php else: ?>
        <div class="cards">
            <?php foreach ($characters as $character): ?>
                <div class="card">
                    <a href="location.php?character=<?= (int) $character['id'] ?>">
                        <img src="<?= e($character['image']) ?>" alt="<?= e($character['name']) ?>">
                    </a>
                    <h2><?= e($character['name']) ?></h2>
                    <p><?= e($character['species']) ?> - <?= e($character['status']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
