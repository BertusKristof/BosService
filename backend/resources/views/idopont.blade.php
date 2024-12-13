<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Időpontfoglalás</title>
    <link rel="stylesheet" href="{{asset('styles.css')}}">
</head>
<body>
    <header>
        <div class="container">
            <h1>Időpontfoglalás</h1>
            <nav>
                <a href="index.blade.php">Főoldal</a>
                <a href="#about">Rólunk</a>
                <a href="#services">Szolgáltatásaink</a>
                <a href="#team">Csapatunk</a>
                <a href="#contact">Elérhetőség</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="modern-booking">
            <h2>Foglaljon időpontot könnyedén!</h2>
            <div class="booking-container">
                <div class="service-select">
                    <h3>Válasszon szolgáltatást</h3>
                    <button onclick="selectService('Gumicsere')">Gumicsere</button>
                    <button onclick="selectService('Olajcsere')">Olajcsere</button>
                    <button onclick="selectService('Diagnosztika')">Diagnosztika</button>
                </div>
                <div class="calendar">
                    <h3>Válasszon dátumot</h3>
                    <input type="date" id="booking-date">
                </div>
                <div class="time-slot">
                    <h3>Válasszon időpontot</h3>
                    <div id="time-slots"></div>
                </div>
                <div class="summary">
                    <h3>Foglalás összegzése</h3>
                    <p id="summary"></p>
                    <button id="confirm-booking" onclick="confirmBooking()">Foglalás megerősítése</button>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Autószerviz. Minden jog fenntartva.</p>
        </div>
    </footer>

    <script src="{{asset('scripts.js')}}"></script>
</body>
</html>
