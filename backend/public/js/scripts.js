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

function UpdateUserAppointment() {
    axios.post('/update-user-appointment', {
        appointment_service: selectedService,
        appointment_date: selectedDate,
        appointment_time: selectedTime,
    }.then((response) => {
        console.log("Adatok fríssitve: ", response.data);
    }).catch((error) => {
        console.error("Hiba történt: ", error);
    }));
}

function confirmBooking() {
    document.getElementById('confirm-booking').addEventListener('click',(event) => {
        event.preventDefault();
        UpdateUserAppointment();
        /*const selectedService = document.getElementById('service-select').value;
        const selectedDate = document.getElementById('calendar').value;
        const selectedTime = document.getElementById('time-slot').value;*/
        
        /*axios.post('/confirm-appointments', {
            appointment_service: selectedService,
            appointment_date: selectedDate,
            appointment_time: selectedTime,
            })*/
       showModal();
    });
}

document.getElementById('booking-date').addEventListener('change', (event) => {
    selectedDate = event.target.value;
    updateSummary();
    generateTimeSlots(); 
});
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
}
    
function showCarModal() {
    const modal = document.getElementById("car_myModal");
    modal.style.display = "block";
}

var span = document.getElementsByClassName("car_close")[0];
span.onclick = function() {
    var modal = document.getElementById("car_myModal");
    modal.style.display = "none";
}

window.onclick = function(event) {
    var modal = document.getElementById("car_myModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// function submitCarModal() {
//     var input = document.getElementById("car_modal-input").value;
//     alert("Beírt szöveg: " + input);
//     var modal = document.getElementById("car_myModal");
//     modal.style.display = "none";
// }

// function showLoginModal() {
//     const modal = document.getElementById("login_myModal");
//     modal.style.display = "block";
// }

// var span = document.getElementsByClassName("login_close")[0];
// span.onclick = function() {
//     var modal = document.getElementById("login_myModal");
//     modal.style.display = "none";
// }

// window.onclick = function(event) {
//     var modal = document.getElementById("login_myModal");
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }

// function submitLoginModal() {
//     var input = document.getElementById("login_modal-input").value;
//     alert("Beírt szöveg: " + input);
//     var modal = document.getElementById("login_myModal");
//     modal.style.display = "none";
// }
document.getElementById('modalLink').onclick = function() {
  document.getElementById('myModal').style.display = 'block';
}

document.getElementsByClassName('close')[0].onclick = function() {
  document.getElementById('myModal').style.display = 'none';
}

window.onclick = function(event) {
  if (event.target == document.getElementById('myModal')) {
    document.getElementById('myModal').style.display = 'none';
  }
}

$('#showLoginForm').submit(function(e) {
    e.preventDefault();
})
