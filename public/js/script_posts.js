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
                const jsonData = {
                    data: {
                        first_name: this.user_first_name,
                        last_name: this.user_last_name,
                        email: this.user_email,
                        avatar: this.user_avatar
                    },
                    support: {
                        text: this.userText
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
