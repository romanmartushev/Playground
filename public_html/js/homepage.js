/**
 * Created by Roman on 1/4/18.
 */
function headerSizeChange(){
    $("#mainHeading").width($("#treeImg").width());
}
headerSizeChange();
$(window).resize(function(){headerSizeChange(); animatedImgSizeChange();});