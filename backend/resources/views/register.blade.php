<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció - BosService</title>
    <link rel="stylesheet" href="{{asset('styles.css')}}">
    <script src="{{asset('js/scripts.js')}}" defer></script>
</head>
<body>
    <header>
        <div class="container2">
            <h1>BosService Regisztráció</h1>
            <nav class="nav2">
                <a href="{{url('/')}}">Vissza a főoldalra</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="register2">
            <h2>Regisztráció</h2>
            <form action="{{route('register')}}" method="POST" >
                @csrf
                <label for="last_name">Vezetéknév</label>
                <input type="text" id="last_name" name="last_name" required> 
                
                <label for="first_name">Keresztnév</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="register_email">Email-cím</label>
                <input type="email" id="register_email" name="register_email" required>

                <label for="register_phone">Telefonszám</label>
                <input type="text" id="phone" name="register_phone" required>

                <label for="register_password">Jelszó</label>
                <input type="password" id="register_password" name="register_password" required><br>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
