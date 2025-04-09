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


document.addEventListener("DOMContentLoaded", () => {
    const formCard = document.querySelector(".form-card");
    formCard.style.opacity = "0";
    formCard.style.transform = "scale(0.9)";
    setTimeout(() => {
        formCard.style.transition = "all 0.5s ease";
        formCard.style.opacity = "1";
        formCard.style.transform = "scale(1)";
    }, 300);
});

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    form.addEventListener("submit", validateForm);
});