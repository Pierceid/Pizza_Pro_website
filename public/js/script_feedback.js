const container = document.getElementById('container');
const button = document.getElementById('button');
button.addEventListener("click", function () {
    const request = new XMLHttpRequest();
    request.open('POST', 'https://reqres.in/api/users');
    request.onload = function () {
        const data = JSON.parse(request.responseText);
        console.log(data[0]);
    };
    request.send();
});

function renderHtml(data) {
    let html = data;
    for (let i = 0; i < data.length; i++) {
        html += "<p>" + data[i];
    }
    container.insertAdjacentHTML('beforeend', html);
}
