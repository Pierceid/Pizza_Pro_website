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

function increaseAmount() {
    $('#plus-btn').click(function () {
        $.ajax({
            type: 'POST',
            url: 'App/Helpers/adjuster.php',
            data: {
                amount: $("#amount-btn").val(),
                id: $("#pizza-id").val(),
                operation: "plus"
            },
            success: function (data) {
                $("#amount-btn").html(data);
            }
        });
    });
}

function reduceAmount() {
    $('#minus-btn').click(function () {
        $.ajax({
            type: 'POST',
            url: 'App/Helpers/adjuster.php',
            data: {
                amount: $("#amount-btn").val(),
                id: $("#pizza-id").val(),
                operation: "minus"
            },
            success: function (data) {
                $("#amount-btn").html(data);
            }
        });
    });
}


