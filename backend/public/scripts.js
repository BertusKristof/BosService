function registerUser() {
    const first_name = document.getElementById('first_name').value;
    const last_name = document.getElementById('last_name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;

    fetch('http://localhost/project/Autoszerelo/register/register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ first_name, last_name, email, phone, password }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === 'success') {
                alert(data.message);
                // Irányítsd át a login oldalra, ha sikeres
                window.location.href = 'index.html';
            } else {
                alert(data.message);
            }
        })
        .catch((error) => console.error('Hiba történt:', error));
}

let selectedService = null;
let selectedDate = null;
let selectedTime = null;

function selectService(service) {
    selectedService = service;
    updateSummary();
}

function updateSummary() {
    const summary = document.getElementById('summary');
    summary.innerHTML = `
        Szolgáltatás: ${selectedService || 'Nincs kiválasztva'}<br>
        Dátum: ${selectedDate || 'Nincs kiválasztva'}<br>
        Időpont: ${selectedTime || 'Nincs kiválasztva'}
    `;
}

function confirmBooking() {
    if (selectedService && selectedDate && selectedTime) {
        alert(`Foglalás sikeres: ${selectedService}, ${selectedDate}, ${selectedTime}`);
    } else {
        alert('Kérlek, válassz minden adatot a foglaláshoz.');
    }
}

// document.getElementById('booking-date').addEventListener('change', (event) => {
//     selectedDate = event.target.value;
//     updateSummary();
//     generateTimeSlots(); // Frissíti az időpontokat az új dátumhoz
// });