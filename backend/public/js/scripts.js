document.addEventListener('DOMContentLoaded', initialize);

function initialize() {
    document.getElementById('login-modal').addEventListener('click', (event) => {
        event.preventDefault();
        showLoginModal();
    });

    var loginClose = document.getElementsByClassName("login_close")[0];
    loginClose.onclick = function() {
        var loginModal = document.getElementById("login_myModal");
        loginModal.style.display = "none";
    }

    window.onclick = function(event) {
        var loginModal = document.getElementById("login_myModal");
        if (event.target == loginModal) {
            loginModal.style.display = "none";
        }
    }

    var carClose = document.getElementsByClassName("car_close")[0];
    carClose.onclick = function() {
        var carModal = document.getElementById("car_myModal");
        carModal.style.display = "none";
    }
    window.onclick = function(event) {
        var carModal = document.getElementById("car_myModal");
        if (event.target == carModal) {
            carModal.style.display = "none";
        }
    }
}

function showLoginModal() {
    const loginModal = document.getElementById("login_myModal");
    loginModal.style.display = "block";
}

function submitLoginModal() {
    var input1 = document.getElementById("login_modal-input1").value;
    var input2 = document.getElementById("login_modal-input2").value;
    alert("Beírt szöveg: " + input1 + " és " + input2);
    var loginModal = document.getElementById("login_myModal");
    loginModal.style.display = "none";
}

function showCarModal() {
    const carModal = document.getElementById("car_myModal");
    carModal.style.display = "block";
}

function submitCarModal() {
    var input = document.getElementById("car_modal-input").value;
    alert("Beírt szöveg: " + input);
    var carModal = document.getElementById("car_myModal");
    carModal.style.display = "none";
}

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
    service.preventDefault();
    selectedService = service;
    updateSummary();
}
<<<<<<< Updated upstream
  document.getElementById('booking-date').addEventListener('change', (event) => {
=======
document.getElementById('booking-date').addEventListener('change', (event) => {
>>>>>>> Stashed changes
    selectedDate = event.target.value;
    updateSummary();
    generateTimeSlots(); 
});

document.getElementById('confirm-booking').addEventListener('click', (event) => {
    event.preventDefault();
    UpdateUserAppointment();
    showCarModal();
});

function updateSummary() {
    const summary = document.getElementById('summary');
    summary.innerHTML = `
        Szolgáltatás: ${selectedService || 'Nincs kiválasztva'}<br>
        Dátum: ${selectedDate || 'Nincs kiválasztva'}<br>
        Időpont: ${selectedTime || 'Nincs kiválasztva'}
    `;
}

function UpdateUserAppointment() {
    axios.post('/update-user-appointment', {
        appointment_service: selectedService,
        appointment_date: selectedDate,
        appointment_time: selectedTime,
    }).then((response) => {
        console.log("Adatok fríssitve: ", response.data);
    }).catch((error) => {
        console.error("Hiba történt: ", error);
    });
}

function generateTimeSlots() {
    const timeSlots = document.getElementById('time-slots')
    timeSlots.innerHTML = ''; 
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
<<<<<<< Updated upstream
}
=======
}
fetch('http://localhost/api/endpoint', {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
    }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
>>>>>>> Stashed changes
