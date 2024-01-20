const container = document.getElementById('container');
const button = document.getElementById('button');
let counter = 1;
button.addEventListener("click", function () {
    const request = new XMLHttpRequest();
    request.open('GET', 'https://reqres.in/api/users/' + counter);
    request.onload = function () {
        const jsonData = JSON.parse(request.responseText);
        renderHtml(jsonData);
    };
    request.send();
    counter++;
    if (counter > 10) {
        button.classList.add("hide-me");
    }
});

function renderHtml(jsonData) {
    const isAdmin = Math.random() <= 0.2 ? 1 : 0;
    let link = '\'<?= $link->url(\'user.edit\', [\'name\' => $user[\'name\'], \'editId\' => $user[\'id\'], \'option\' => 4]) ?>\'';
    let html = "";
    html += "<tr><td>" + jsonData.data.id + "</td>";
    html += "<td>" + jsonData.data.first_name  + "</td>";
    html += "<td>" + jsonData.data.email  + "</td>";
    html += "<td>" + isAdmin  + "</td>";
    html += "<td>" +
        "<button type=\"button\" class=\"btn btn-primary\">" +
        "<a href="+ link +">Edit</a>" +
        "</button></td><tr>"

    container.insertAdjacentHTML('beforeend', html);
}
