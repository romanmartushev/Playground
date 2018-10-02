/**
 * Created by Roman on 1/4/18.
 */
new Vue({
    el:'#root',
    data:{
        success: '',
        error:''
    },
    methods: {
        addMember: function(){
            var self = this;
            $.ajax({
                method:"GET",
                type:"GET",
                url:"/add-new-member",
                data:{
                    name: $("#InputName").val(),
                    birthday: $("#InputBirthday").val(),
                    phoneNumber: $("#InputPhoneNumber").val(),
                    email: $("#InputEmail").val()
                },
                success: function(data){
                    if(data["success"]){
                        $("#InputName").val('');
                        $("#InputBirthday").val('');
                        $("#InputPhoneNumber").val('');
                        $("#InputEmail").val('');
                        self.success = data["success"];
                        setTimeout(function(){
                            self.success = '';
                        },5000);
                    }else{
                        self.error = data["error"];
                        setTimeout(function(){
                            self.error = '';
                        },5000);
                    }
                }
            })
        }

    }
});