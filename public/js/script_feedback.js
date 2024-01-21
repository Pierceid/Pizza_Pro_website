const container = document.getElementById('post-container');
const btn_send = document.getElementById('btn-send');
const btn_discard = document.getElementById('btn-discard');
const btn_load = document.getElementById('btn-load');
const btn_clear = document.getElementById('btn-clear');

let [user_first_name, user_last_name] = document.getElementById('user-name').innerText.split(' ');
user_last_name = user_last_name || '';
let user_email = document.getElementById('user-email').innerText;
let user_avatar = document.getElementById('user-image-path').innerText;
let counter = 1;

btn_send.addEventListener("click", function () {
    const user_text = document.getElementById('user-text').value;
    const jsonData = {
        data: {
            first_name: user_first_name,
            last_name: user_last_name,
            email: user_email,
            avatar: user_avatar
        },
        support: {
            text: user_text
        }
    };

    try {
        renderHtml(jsonData);
    } catch (error) {
        console.error('Error parsing API response:', error);
    }
});

btn_discard.addEventListener("click", function () {
    clear();
});

btn_load.addEventListener("click", function () {
    const request = new XMLHttpRequest();
    request.open('GET', 'https://reqres.in/api/users/' + counter);
    request.onload = function () {
        try {
            const jsonData = JSON.parse(request.responseText);
            renderHtml(jsonData);
        } catch (error) {
            console.error('Error parsing API response:', error);
        }
    };
    request.send();
    counter++;
    if (counter > 12) {
        btn_load.classList.add("hidden");
    }
});

btn_clear.addEventListener("click", function () {
    Array.from(container.getElementsByClassName('post')).forEach(post => {
        post.remove();
    });
});

function clear() {
    document.getElementById('option-1').checked = true;
    document.getElementById('user-text').value = '';
    document.getElementById('checkbox').checked = true;
}

function renderHtml(jsonData) {
    let html = "<div class='post'><div class='header'><div class='user-info'>";
    html += "<h6 class='user-name'>" + jsonData.data.first_name + " " + jsonData.data.last_name + "</h6>";
    html += "<h6 class='user-email'>contact: " + jsonData.data.email + "</h6></div>";
    html += "<img src='" + jsonData.data.avatar + "' alt='' </img></div>";
    html += "<div class='divider'></div>";
    html += "<h6 class='body'>" + jsonData.support.text + "</h6></div>";
    container.insertAdjacentHTML('afterbegin', html);
}
