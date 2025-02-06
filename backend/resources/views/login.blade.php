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
                <a href="{{ url('/') }}">Vissza a főoldalra</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="login">
            <h2>Bejelentkezés</h2>
            <form action="{{route('login')}}" method="POST">
                @csrf
                <label for="login_email">Felhasználónév</label>
                <input type="text" id="login_email" name="login_email" required>
                
                <label for="login_password">Jelszó</label>
                <input type="password" id="login_password" name="login_password" required> 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="#" id="showLoginModal">Elfelejtette a jelszavát?</a>
                <div id="login_myModal" class="login_modal">
                    <div class="login_modal-content">
                        <span class="login_close">&times;</span>
                        <form action="{{ route('login') }}" method="POST">
                        <h2>Modal Cím</h2>
                        <p>Rendszám tábla:</p>
                        <input type="text" id="login_modal-input">
                        <p>Autó Márka:</p>
                        <input type="text" id="login_modal-input">
                        <p>Autó Modell:</p>
                        <input type="text" id="login_modal-input">
                        <p>Évjárat:</p>
                        <input type="text" id="login_modal-input">
                        <button class="login_modal-submit" onclick="submitLoginModal()">Küldés</button>
                        </form>
                    </div>
                </div>
                <button type="submit">Bejelentkezés</button>
            </form>
        <section class="register">
            <a href="{{route('register')}}" class="aclass">
                <button>Regisztráció</button>
            </a>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Autószerviz. Minden jog fenntartva.</p>
        </div>
    </footer>
</body>
</html>
