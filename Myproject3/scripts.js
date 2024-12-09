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

document.getElementById('booking-date').addEventListener('change', (event) => {
    selectedDate = event.target.value;
    updateSummary();
    generateTimeSlots(); // Frissíti az időpontokat az új dátumhoz
});

function generateTimeSlots() {
    const timeSlots = document.getElementById('time-slots');
    timeSlots.innerHTML = ''; // Töröljük a korábbi időpontokat
    const times = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];
    times.forEach((time) => {
        const button = document.createElement('button');
        button.innerText = time;
        button.onclick = () => {
            selectedTime = time;
            updateSummary();
        };
        timeSlots.appendChild(button);
    });
}
