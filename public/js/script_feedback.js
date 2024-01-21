document.addEventListener('DOMContentLoaded', function () {
    new Vue({
        el: '#app',
        data: {
            posts: [],
            selectedOption: 'option1',
            userText: '',
            isChecked: true,
            counter: 1
        },
        methods: {
            loadData() {
                const request = new XMLHttpRequest();
                request.open('GET', 'https://reqres.in/api/users/' + this.counter);
                request.onload = () => {
                    try {
                        const jsonData = JSON.parse(request.responseText);
                        this.renderHtml(jsonData);
                    } catch (error) {
                        console.error('Error parsing API response:', error);
                    }
                };
                request.send();
                this.counter++;
                if (this.counter > 12) {
                    document.getElementById('btn-load').classList.add("hidden");
                }
            },
            clearData() {
                this.posts = [];
            },
            sendData() {
                let [first_name, last_name] = document.getElementById('user-name').innerText.split(' ');
                last_name = last_name || '';
                let user_email = document.getElementById('user-email').innerText;
                let user_avatar = document.getElementById('user-image-path').innerText;
                let user_text = document.getElementById('user-text').value;
                const jsonData = {
                    data: {
                        first_name: first_name,
                        last_name: last_name,
                        email: user_email,
                        avatar: user_avatar
                    },
                    support: {
                        text: user_text
                    }
                };
                try {
                    this.renderHtml(jsonData);
                } catch (error) {
                    console.error('Error parsing API response:', error);
                }
                this.clear();
            },
            discardData() {
                this.clear();
            },
            clear() {
                this.selectedOption = 'option1';
                this.userText = '';
                this.isChecked = true;
            },
            renderHtml(jsonData) {
                this.posts.unshift({
                    data: {
                        first_name: jsonData.data.first_name,
                        last_name: jsonData.data.last_name,
                        email: jsonData.data.email,
                        avatar: jsonData.data.avatar
                    },
                    support: {
                        text: jsonData.support.text
                    }
                });
            }
        }
    });
});
