$(document).ready(function(){
    $("#dialog").hide();
});

$(function () {
    $('.deleteObject').click(function () {
       // var $that = $(this);
        var data = $(this).data('id');
        $("#delete-obj").attr("data-id", data);
        $("#dialog").css('display', 'block');
        $("#dialog").fadeIn();
        
    });

});
$(function () {
    $('#delete-obj').on('click',function () {
        var data = $(this).data('id');
        ajaxRequest (data);
    });
});

$(function () {
    $('.closed').on('click',function () {
        $("#dialog").fadeOut();
    });
    });
function closeDialog(){
    $("#dialog").fadeOut();
}
