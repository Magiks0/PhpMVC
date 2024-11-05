<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médiathèque - Tableau de Bord</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= THEME ?>">
</head>

<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --text-color: #2c3e50;
    --background-color: #f5f6fa;
}

body {
    background-color: var(--background-color);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Header */
header {
    background-color: var(--primary-color);
    color: white;
    padding: 1rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.logo {
    font-size: 1.5rem;
    font-weight: bold;
}

.nav-links {
    display: flex;
    gap: 2rem;
}

.nav-links a {
    color: white;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.nav-links a:hover {
    background-color: var(--secondary-color);
}

/* Main Content */
main {
    flex: 1;
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.search-bar {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.search-bar input {
    padding: 0.5rem 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 300px;
}

.media-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
}

.media-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.media-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.media-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background-color: #ddd;
}

.media-content {
    padding: 1rem;
}

.media-title {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: var(--text-color);
}

.media-author {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.media-status {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 3px;
    font-size: 0.8rem;
    font-weight: bold;
}

.status-available {
    background-color: #2ecc71;
    color: white;
}

.status-unavailable {
    background-color: var(--accent-color);
    color: white;
}

/* Footer */
footer {
    background-color: var(--primary-color);
    color: white;
    padding: 1rem;
    text-align: center;
    margin-top: auto;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.social-links a {
    color: white;
    margin: 0 0.5rem;
    text-decoration: none;
}

.social-links a:hover {
    color: var(--secondary-color);
}
</style>

<body>
    <?php require __DIR__ . '/../components/header.html.php'; ?>
    <main>
        <div class="dashboard-header">
            <h1>Catalogue des Médias</h1>
            <div class="search-bar">
                <form name="search" action="#" method="POST">
                    <select name="search">
                        <option value="all" default>Tous</option>
                        <option value="available">Disponibles</option>
                        <option value="movie">Films</option>
                        <option value="book">Livres</option>
                        <option value="album">Albums</option>
                    </select>
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        
        <div class="media-grid">
            <?php foreach ($medias as $media) {?>
                <div class="media-card">
                <img src="/public/media/sda.jpg" alt="<?= $media->getTitle() ?>" class="media-image">
                    <div class="media-content">
                        <div class="media-title"><?= $media->getTitle() ?></div>
                        <div class="media-author">
                            <i class="fas fa-user"></i> 
                            <?= htmlspecialchars($media->getAuthor()) ?>
                        </div>
                        <div class="media-status" style="display: flex; align-items: center; gap: 10px;">
                            <div class="round" style="border-radius: 100%; <?= $media->getAvailable() ? 'background: #04ff01;' : 'background: #ff0101;' ?> width: 10px; height: 10px;">
                            </div>
                            <?= $media->getAvailable() ? 'Disponible' : 'Indisponible' ?>
                        </div>
                        <?php if (isset($_SESSION['user'])) { ?>
                            <form action="/changeAvailable" method="POST">
                                <input type="hidden" name="media_id" value="<?php echo $media->getId(); ?>">
                                <button style="width: 50%; background: gray; border: none; padding: 10px; border-radius: 25px;" type="submit" class="btn btn-primary"><?= $media->getAvailable() ? 'Emprunter' : 'Rendre' ?></button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <?php require __DIR__ . '/../components/footer.html.php'; ?>
</body>
</html>
