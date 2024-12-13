<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés - BosService</title>
    <link rel="stylesheet" href="{{asset('styles.css')}}">
</head>
<body>
    <header>
        <div class="container">
            <h1>BosService Bejelentkezés</h1>
            <nav>
                <a href="index.blade.php">Vissza a főoldalra</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="login">
            <h2>Bejelentkezés</h2>
            <form action="{{route('login')}}" method="POST">
                <label for="username">Felhasználónév</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Jelszó</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Bejelentkezés</button>
            </form>
        <section class="register">
            <a href="register.blade.php" class="aclass">
                <button href="register.blade.php">Regisztráció</button>
            </a>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Autószerviz. Minden jog fenntartva.</p>
        </div>
    </footer>
</body>
</html>
