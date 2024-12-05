<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Autószerelő</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#home">Főoldal</a></li>
                <li><a href="#about">Rólunk</a></li>
                <li><a href="#services">Szolgáltatások</a></li>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <li><a><?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
                    <li><a href="logout.php">Kijelentkezés</a></li>
                <?php else: ?>
                    <li><a href="login/loginHTML.php">Bejelentkezés</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section id="home">
        <div class="main">
            <h1>Autószerviz - Profi javítás</h1>
            <p>Gyors és megbízható autójavítás, modern technológiával.</p>
            <img src="imgs/szereles.jpg" alt="Autószerelő">
        </div>
    </section>

    <section id="about">
            <h2>Rólunk</h2>
            <p>Cégünk 5 éve foglalkozik professzionális autójavítással, főként Skodával és Volkswagennel. Megbízható csapatunk garantálja a gyors és precíz munkát.</p>
            <img src="imgs/skoda.png" alt="1" class="logo1">
            <img src="imgs/vw.png" alt="2" class="logo2">
    </section>
    

    <footer>
        <div class="footer-content">
        <div  class="footer-item">
        <h2>Szolgáltatások</h2>
            <ul>Olajcsere</ul>
            <ul>Fékjavítás</ul>
            <ul>Motor diagnosztika</ul>
            <ul>Teljes körű karbantartás</ul>
        </div>
        <div class="footer-item">
        <h3>Kapcsolat</h3>
            <p>Elérhetőség: +36 30 123 4567</p>
            <p>Email-cím: autoszerelo@gmail.com</p>
        </div>
        <div class="footer-item">
        <p>&copy; 2024 Autószerviz</p>
        </div>
    </div>
    </footer>
</body>
</html>