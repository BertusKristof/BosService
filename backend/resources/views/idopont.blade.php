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
                <a href="{{ url('/') }}">Főoldal</a>
                <a href="#about">Rólunk</a>
                <a href="#services">Szolgáltatásaink</a>
                <a href="#team">Csapatunk</a>
                <a href="#contact">Elérhetőség</a>
            </nav>
        </div>
    </header>

    <main>
        <form class="modern-booking"  method="POST">
            @csrf
            <h2>Foglaljon időpontot könnyedén!</h2>
            <div class="booking-container">
                <div class="service-select">
                    <h3>Válasszon szolgáltatást</h3>
                    <button type="button" onclick="selectService('Gumicsere')">Gumicsere</button>
                    <button type="button" onclick="selectService('Olajcsere')">Olajcsere</button>
                    <button type="button" onclick="selectService('Diagnosztika')">Diagnosztika</button>
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
                    <button id="confirm-booking" onclick="showCarModal ()" type="button">Foglalás megerősítése</button>
                    <!-- <button onclick="showModal()">Modal megjelenítése</button> -->
                </div>
            </div>
            </form>
        <div id="car_myModal" class="car_modal">
            <div class="car_modal-content">
                <span class="car_close">&times;</span>
                <form action="{{ route('idopont') }}" method="POST">
                <h2>Modal Cím</h2>
                <p>Rendszám tábla:</p>
                <input type="text" id="car_modal-input">
                <p>Autó Márka:</p>
                <input type="text" id="car_modal-input">
                <p>Autó Modell:</p>
                <input type="text" id="car_modal-input">
                <p>Évjárat:</p>
                <input type="text" id="car_modal-input">
                <button class="car_modal-submit" onclick="submitCarModal()">Küldés</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Autószerviz. Minden jog fenntartva.</p>
        </div>
    </footer>

    <script src="{{asset('js/scripts.js')}}"></script>
</body>
</html>
