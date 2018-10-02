/**
 * Created by Roman on 1/4/18.
 */
new Vue({
    el:'#root',
    data:{
        errors: [],
        birthdays: [],
        welcome_message: 'Hello',
        timeout: 1000
    },
    methods: {
        welcome: function(){
            const vm = this;
            var message = ", My name is Roman. Welcome to my page! I hope you enjoy the things I have to show you." +
                " There are many things I am currently working on. This is the place I will post all my projects and apps." +
                " At the bottom of the page you will find contact information as well as links to projects. Enjoy!";
            var message_array = message.split('');
            message_array.forEach(function(letter){
                vm.addToWelcomeMessage(letter);
            });
        },
        addToWelcomeMessage: function(letter){
            const vm = this;
            var timeout = this.timeout;
            setTimeout(function(){
                vm.welcome_message = vm.welcome_message + letter;
            },timeout);
            this.timeout += 100;
        },
        checkBirthdays: function(){
            const vm = this;
            axios.get("/homepage-birthdays")
                .then(function (response) {
                    vm.birthdays = response.data;
                }).catch(function(e) {
                    vm.errors.push(e);
            });
        }
    },
    mounted: function(){
        this.welcome();
        this.checkBirthdays();
    }
});