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
        chat: [ { message: 'Welcome to the Chat!!', user: 'default', time: new Date().toLocaleTimeString('en-US', {hour: 'numeric', minute: '2-digit'})} ],
        text: '',
        showModal: true,
        user: ''
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
            var time = new Date();
            this.chat.push({message: this.text, user: this.user, time: time.toLocaleTimeString('en-US', {hour: 'numeric', minute: '2-digit'})});
            this.text = '';
        }
    }
});

function addName(username){
    app.user = username;
};