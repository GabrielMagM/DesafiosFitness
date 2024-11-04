document.addEventListener("DOMContentLoaded", function () {
    const images = ["cr1.jpg", "palco.jpg"];
    const carouselContainer = document.getElementById("fitness-carousel");
    let currentSlide = 0;

    // Crea las imágenes e indicadores en el HTML
    const carouselImages = document.createElement("div");
    carouselImages.classList.add("flex");

    images.forEach((src, index) => {
        const img = document.createElement("img");
        img.src = src;
        img.classList.add("carousel-image", "w-full", "object-cover");
        carouselImages.appendChild(img);
    });
    carouselContainer.appendChild(carouselImages);

    // Indicadores
    const indicators = document.createElement("div");
    indicators.classList.add("absolute", "bottom-4", "left-1/2", "transform", "-translate-x-1/2", "flex");
    images.forEach((_, index) => {
        const dot = document.createElement("button");
        dot.classList.add("carousel-indicator");
        dot.onclick = () => setSlide(index);
        indicators.appendChild(dot);
    });
    carouselContainer.appendChild(indicators);

    const indicatorDots = indicators.querySelectorAll(".carousel-indicator");

    function showSlide(index) {
        carouselImages.style.transform = `translateX(-${index * 100}%)`;
        indicatorDots.forEach((dot, i) => {
            dot.classList.toggle("active", i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % images.length;
        showSlide(currentSlide);
    }

    function setSlide(index) {
        currentSlide = index;
        showSlide(currentSlide);
    }

    setInterval(nextSlide, 3000);
    showSlide(currentSlide);
});