/**
 * Created by Roman on 1/4/18.
 */
function headerSizeChange(){
    $("#mainHeading").width($("#treeImg").width());
}
headerSizeChange();
$(window).resize(function(){headerSizeChange()});

new Vue({
    el:'#root',
    data:{
        response: []
    },
    mounted: function(){
        var self = this;
        $.ajax({
            method:"GET",
            type:"GET",
            url:"/homepage-birthdays",
            success: function(data){
                self.response = data;
            }
        })
    }
});