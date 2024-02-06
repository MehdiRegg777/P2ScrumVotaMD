// Obtener el modal
var modal = document.getElementById("myModal");

// Obtener el botón de aceptar
var acceptBtn = document.getElementById("acceptBtn");

// Obtener el botón de rechazar
var declineBtn = document.getElementById("declineBtn");

// Función para cerrar el modal
function closeModal() {
    modal.style.display = "none";
}

// Mostrar el modal cuando se carga la página
window.onload = function () {
    modal.style.display = "block";
}

// Acción al hacer clic en el botón de aceptar
acceptBtn.onclick = function () {
    // Aquí puedes realizar alguna acción cuando el usuario acepta las condiciones
    // Por ejemplo, marcar las condiciones como aceptadas en la base de datos
    // y permitir al usuario operar en la página
    closeModal();
    // Quitar el elemento modal-backdrop
    var backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) {
        backdrop.parentNode.removeChild(backdrop);
    }

    document.cookie = "terms_condition_accepted="+1;
    window.location.href = "login.php";
}

// Acción al hacer clic en el botón de rechazar
declineBtn.addEventListener("click", function () {
    document.cookie = "terms_condition_accepted="+0;
    window.location.href = "index.php";
});