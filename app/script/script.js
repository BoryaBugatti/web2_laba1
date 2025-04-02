function validateForm(event) {
    const patient = document.getElementById("pat").value;
    const doctor = document.getElementById("doc").value;
    const numberPattern = /\d/;
    if (numberPattern.test(patient)) {
        alert("Поле 'Пациент' не может содержать числа.");
        event.preventDefault();
        return false;
    }
    if (numberPattern.test(doctor)) {
        alert("Поле 'Врач' не может содержать числа.");
        event.preventDefault();
        return false;
    }

    return true;
}


document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    form.addEventListener("submit", validateForm);
});