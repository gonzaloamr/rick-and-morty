<?php
require __DIR__ . '/api.php';

const MAX_RESIDENTS = 20;

$characterId = (int) ($_GET['character'] ?? 0);
$character = $characterId > 0 ? get_character($characterId) : null;

$location = null;
$residents = [];
if ($character && !empty($character['location']['url'])) {
    $location = api_get($character['location']['url']);
}
if ($location) {
    $residentIds = array_map('id_from_url', $location['residents']);
    $residents = get_characters(array_slice($residentIds, 0, MAX_RESIDENTS));
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $location ? e($location['name']) : 'Location' ?> - Rick and Morty</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Bangers&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="arrival">
    <div class="stars"></div>

    <header>
        <a class="back" href="index.php">&larr; Voltar pelo portal</a>
    </header>

    <main>
        <?php if (!$character): ?>
            <p class="error">Personagem não encontrado nesta dimensão.</p>
        <?php else: ?>
            <section class="traveler">
                <div class="portal small">
                    <img src="<?= e($character['image']) ?>" alt="<?= e($character['name']) ?>">
                </div>
                <p><strong><?= e($character['name']) ?></strong> atravessou o portal e chegou em...</p>
            </section>

            <?php if ($location): ?>
                <section class="location">
                    <h1 class="location-name"><?= e($location['name']) ?></h1>

                    <div class="badges">
                        <div class="badge">
                            <span>Tipo</span>
                            <strong><?= e($location['type']) ?></strong>
                        </div>
                        <div class="badge">
                            <span>Dimensão</span>
                            <strong><?= e($location['dimension']) ?></strong>
                        </div>
                        <div class="badge">
                            <span>Residentes</span>
                            <strong><?= count($location['residents']) ?></strong>
                        </div>
                    </div>
                </section>

                <?php if ($residents): ?>
                    <section>
                        <h2 class="section-title">Quem mora aqui</h2>
                        <?php if (count($location['residents']) > MAX_RESIDENTS): ?>
                            <p class="subtitle">Mostrando <?= MAX_RESIDENTS ?> de <?= count($location['residents']) ?> residentes</p>
                        <?php endif; ?>

                        <div class="residents">
                            <?php foreach ($residents as $resident): ?>
                                <a class="resident" href="location.php?character=<?= (int) $resident['id'] ?>">
                                    <img src="<?= e($resident['image']) ?>" alt="<?= e($resident['name']) ?>" loading="lazy">
                                    <span class="dot <?= status_class($resident['status']) ?>"></span>
                                    <span class="resident-name"><?= e($resident['name']) ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
            <?php else: ?>
                <section class="location">
                    <h1 class="location-name"><?= e($character['location']['name'] ?? 'unknown') ?></h1>
                    <p class="subtitle">Nem o Rick sabe onde fica esse lugar.</p>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <footer>Dados de <a href="https://rickandmortyapi.com" target="_blank" rel="noopener">The Rick and Morty API</a></footer>
</body>
</html>
