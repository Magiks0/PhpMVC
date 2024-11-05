<header>
    <nav>
        <div class="logo">
            <i class="fas fa-book-reader"></i> Médiathèque
        </div>
        <div class="nav-links">
            <a href="/"><i class="fas fa-home"></i> Accueil</a>
            <?php if (!isset($_SESSION['user'])){ ?>
                <a href="login"><i class="fas fa-user"></i> Mon compte</a>
            <?php } else { ?>
                <a href="logout"><i class="fas fa-user"></i> <?= $_SESSION['user']['username'] ?></a>
            <?php }?>
            <a href="#"><i class="fas fa-info-circle"></i> À propos</a>
        </div>
    </nav>
</header>