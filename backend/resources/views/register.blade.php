<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés - BosService</title>
    <link rel="stylesheet" href="{{asset('styles.css')}}">
    <script src="{{asset('scripts.js')}}" defer></script>
</head>
<body>
    <header>
        <div class="container2">
            <h1>BosService Regisztráció</h1>
            <nav class="nav2">
                <a href="index.blade.php">Vissza a főoldalra</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="register2">
            <h2>Regisztráció</h2>
            <form onsubmit="registerUser()" action="{{route('register')}}" method="POST" >
                <label for="last_name">Vezetéknév</label>
                <input type="text" id="last_name" name="last_name" required> 
                
                <label for="first_name">Keresztnév</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="email">Email-cím</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Telefonszám</label>
                <input type="number" id="phone" name="phone_number" required>

                <label for="password">Jelszó</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Regisztráció</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="container2">
            <p>&copy; 2024 Autószerviz. Minden jog fenntartva.</p>
        </div>
    </footer>
</body>
</html>
