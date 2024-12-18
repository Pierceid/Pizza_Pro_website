document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.carousel-container');
    const images = document.querySelectorAll('.carousel-item')
    const next = document.querySelector('.carousel-control-next')
    const prev = document.querySelector('.carousel-control-prev')
    let counter = 0, interval;

    next.addEventListener('click', slideNext);
    prev.addEventListener('click', slidePrev);

    function slideNext() {
        images[counter].style.animation = 'next1 0.4s ease-in-out forwards';
        if (counter >= images.length - 1) {
            counter = 0;
        } else {
            counter++;
        }
        images[counter].style.animation = 'next2 0.4s ease-in-out forwards';
    }

    function slidePrev() {
        images[counter].style.animation = 'prev1 0.4s ease-in-out forwards';
        if (counter <= 0) {
            counter = images.length - 1;
        } else {
            counter--;
        }
        images[counter].style.animation = 'prev2 0.4s ease-in-out forwards';
    }

    function autoSliding() {
        interval = setInterval(timer, 1400);

        function timer() {
            slideNext();
        }
    }

    autoSliding();
    container.addEventListener('mouseover', function () {
        clearInterval(interval);
    });

    container.addEventListener('mouseout', autoSliding);
});

function openModal(title, description, image) {
    document.getElementById('modal-image').src = image;
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-description').textContent = description;
    document.getElementById('overlay').style.display = 'flex';
}

function closeModal() {
    document.getElementById('overlay').style.display = 'none';
}
