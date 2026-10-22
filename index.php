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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Bangers&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="stars"></div>

    <header>
        <h1 class="logo">Rick <span>and</span> Morty</h1>
        <p class="subtitle">Clique no portal para viajar até a location do personagem</p>
    </header>

    <main>
        <?php if (empty($characters)): ?>
            <p class="error">Wubba lubba dub dub! Não foi possível carregar os personagens.</p>
        <?php else: ?>
            <div class="cards">
                <?php foreach ($characters as $character): ?>
                    <article class="card">
                        <a class="portal" href="location.php?character=<?= (int) $character['id'] ?>" title="Viajar para <?= e($character['location']['name']) ?>">
                            <img src="<?= e($character['image']) ?>" alt="<?= e($character['name']) ?>">
                        </a>

                        <h2><?= e($character['name']) ?></h2>

                        <p class="status">
                            <span class="dot <?= status_class($character['status']) ?>"></span>
                            <?= e($character['status']) ?> - <?= e($character['species']) ?>
                        </p>

                        <dl>
                            <dt>Gênero</dt>
                            <dd><?= e($character['gender']) ?></dd>
                            <dt>Origem</dt>
                            <dd><?= e($character['origin']['name']) ?></dd>
                            <dt>Última location</dt>
                            <dd><?= e($character['location']['name']) ?></dd>
                            <dt>Episódios</dt>
                            <dd><?= count($character['episode']) ?></dd>
                        </dl>

                        <a class="button" href="location.php?character=<?= (int) $character['id'] ?>">Abrir portal</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer>Dados de <a href="https://rickandmortyapi.com" target="_blank" rel="noopener">The Rick and Morty API by Gonzalo Muñoz</a></footer>
</body>
</html>
