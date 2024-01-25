function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

document.addEventListener("DOMContentLoaded", function () {
    const numberOfPizzas = 10;

    for (let i = 1; i <= numberOfPizzas; i++) {
        const pizza = document.createElement("img");
        pizza.classList.add("pizza");
        pizza.src = "/public/images/others/logo.png";
        pizza.style.left = getRandomInt(10, 90) + "vw";
        pizza.style.top = getRandomInt(10, 90) + "vh";
        pizza.style.animationName = `move-pizza-${i}`;
        document.body.appendChild(pizza);

        const keyframes = `@keyframes move-pizza-${i} {
        0% { transform: translate(0, 0); }
        25% { transform: translate(${getRandomInt(-150, 150)}px, ${getRandomInt(-150, 150)}px); }
        50% { transform: translate(${getRandomInt(-150, 150)}px, 0); }
        75% { transform: translate(${getRandomInt(-150, 150)}px, ${getRandomInt(-150, 150)}px); }
        100% { transform: translate(0, 0); }
      }`;

        const style = document.createElement("style");
        style.position = 'relative';
        style.width = '50px';
        style.height = '50px';
        style.textContent = keyframes;
        document.head.appendChild(style);
    }
});