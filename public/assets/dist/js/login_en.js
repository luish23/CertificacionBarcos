$( document ).ready(function() {
    if ($("#data").val().length > 0) {
        $("#msg").append('<div id="msg" class="info-box bg-danger"><span class="info-box-icon"><i class="fas fa-times"></i></span><div class="info-box-content">'+$("#data").val()+'</div></div>');
    } 
});