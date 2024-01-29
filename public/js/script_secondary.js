function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// animation of all pizzas
document.addEventListener("DOMContentLoaded", function () {
    const numberOfPizzas = 15;

    for (let i = 1; i <= numberOfPizzas; i++) {
        const pizza = document.createElement("img");
        pizza.classList.add("pizza");
        pizza.src = "/public/images/others/logo.png";
        pizza.style.left = getRandomInt(20, 80) + "vw";
        pizza.style.top = getRandomInt(20, 80) + "vh";
        pizza.style.animationName = `move-pizza-${i}`;
        document.body.appendChild(pizza);

        const keyframes = `@keyframes move-pizza-${i} {
            0% { transform: translate(0, 0); }
            12% { transform: translate(${getRandomInt(-100, 100)}px, ${getRandomInt(-100, 100)}px); }
            25% { transform: translate(${getRandomInt(-100, 100)}px, 0); }
            37% { transform: translate(${getRandomInt(-100, 100)}px, ${getRandomInt(-100, 100)}px); }
            50% { transform: translate(0, ${getRandomInt(-100, 100)}px); }
            62% { transform: translate(${getRandomInt(-100, 100)}px, ${getRandomInt(-100, 100)}px); }
            75% { transform: translate(${getRandomInt(-100, 100)}px, 0); }
            87% { transform: translate(${getRandomInt(-100, 100)}px, ${getRandomInt(-100, 100)}px); }
            100% { transform: translate(0, 0); }
        }`;

        const style = document.createElement("style");
        style.position = 'relative';
        style.width = '50px';
        style.height = '50px';
        style.textContent = keyframes;
        document.head.appendChild(style);

        pizza.addEventListener('animationiteration', function () {
            const rect = pizza.getBoundingClientRect();
            if (rect.bottom < 0 || rect.top > window.innerHeight || rect.right < 0 || rect.left > window.innerWidth) {
                document.removeChild(pizza);
            }
        });
    }
});
