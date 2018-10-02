Vue.component('modal', {
    template: '<div class="modal-mask">' +
    '                <div class="modal-wrapper container">' +
    '                    <div class="modal-container row row-flex row-flex-wrap">' +
    '                        <div class="col-sm-12 flex-col">' +
    '                           <div class="input-group"> ' +
    '                               <input type="text" class="form-control input-sm" placeholder="Type your name here..." id="username"/>' +
    '                                   <span class="input-group-btn"> ' +
    '                                     <button class="btn btn-warning btn-sm" id="btn-chat" onclick="addName($(\'#username\').val())" @click="$emit(\'close\')">Set Name</button>' +
    '                                  </span>' +
    '                           </div>' +
    '                       </div>' +
    '                    </div>' +
    '                </div>' +
    '            </div>'
});
const app = new Vue({
    el:'#root',
    data:{
        success: '',
        error:'',
        chat: [ { message: 'Welcome to the Chat!!', user: 'default', image: 'https://placehold.it/50/55C1E7/fff&text=D', time: new Date().toLocaleTimeString('en-US', {hour: 'numeric', minute: '2-digit'})} ],
        text: '',
        showModal: true,
        user: '',
        user_image: '',
        errors: [],
        allMessages: [],
        messageCounter: 0
    },
    watch: {
        'chat': function () {
            if(this.chat.length > 100){
                this.chat.shift();
            }
        }
    },
    methods: {
        addMessage: function () {
            var time = new Date().toLocaleTimeString('en-US', {hour: 'numeric', minute: '2-digit'});
            var message = {message: this.text, user: this.user, image: this.user_image, time: time};
            this.chat.push(message);
            axios.get("/chat/add?message="+this.text+"&user="+this.user+"&image="+this.user_image+"&time="+time)
                .then(function (response) {
                    console.log(response.data['success']);
                }).catch(function(e) {
                vm.errors.push(e);
            });
            this.text = '';
        },
        checkNewMessages: function () {
            const vm = this;
            axios.get("/chat/new")
                .then(function (response) {
                    if(response.data.length === 0){
                        vm.messageCounter = response.data.length;
                    }else{
                        for(var i = vm.messageCounter; i < response.data.length; i++){
                            if( vm.user !== response.data[i].user){
                                vm.chat.push(response.data[i]);
                            }
                        }
                        vm.messageCounter = response.data.length;
                    }
                }).catch(function(e) {
                    vm.errors.push(e);
            });
        }
    },
    mounted: function(){
        this.checkNewMessages();
    }
});

function addName(username){
    app.user = username;
    app.user_image = "https://placehold.it/50/55C1E7/fff&text=" + username.charAt(0).toUpperCase();
}

setInterval(function(){
    if(app.user !== ''){
        app.checkNewMessages();
    }
},5000);