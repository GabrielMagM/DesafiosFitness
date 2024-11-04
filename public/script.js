document.addEventListener("DOMContentLoaded", function () {
    const profileIcon = document.getElementById("profile-icon");
    const dropdownMenu = document.getElementById("dropdown-menu");

    // Mostrar el menú cuando el mouse pase por encima del icono o del menú
    profileIcon.addEventListener("mouseover", () => {
        dropdownMenu.classList.remove("hidden");
    });
    dropdownMenu.addEventListener("mouseover", () => {
        dropdownMenu.classList.remove("hidden");
    });

    // Ocultar el menú cuando el mouse sale del icono y del menú
    profileIcon.addEventListener("mouseleave", () => {
        setTimeout(() => {
            if (!dropdownMenu.matches(':hover')) {
                dropdownMenu.classList.add("hidden");
            }
        }, 100);
    });
    dropdownMenu.addEventListener("mouseleave", () => {
        dropdownMenu.classList.add("hidden");
    });
});