/**
 * Created by Roman on 1/4/18.
 */
new Vue({
    el:'#root',
    data:{
        success: null,
        error: null
    },
    methods: {
        updateMember: function(){
            var self = this;
            $.ajax({
                method:"GET",
                type:"GET",
                url:"/update-a-member",
                data:{
                    name: $('#familyMemberSelector').find("option:selected").val(),
                    mother: $('#Mother').find("option:selected").val(),
                    father: $('#Father').find("option:selected").val(),
                    spouse: $('#Spouse').find("option:selected").val(),
                    phoneNumber: $("#InputPhoneNumber").val(),
                    address: $("#InputAddress").val(),
                    email: $("#InputEmail").val()
                },
                success: function(data){
                    console.log(data);
                    if(data["success"]){
                        $("#familyMemberSelector").val('default');
                        $('#Mother').val('default');
                        $('#Father').val('default');
                        $('#Spouse').val('default');
                        $("#InputPhoneNumber").val('');
                        $("#InputAddress").val('');
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