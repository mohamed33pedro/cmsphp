tinymce.init({
    selector:'textarea',
    plugins: "link"
});


$(document).ready(function() {  
    $('#selectAllBoxes').click(function(event) {
        if(this.checked) {
            $('.checkboxes').each(function() {
                this.checked = true;    
            });    
        } else {
            $('.checkboxes').each(function() {
                this.checked = false;    
            });
        }
    });
    
    
//    var divBox = "<div id='load-screen'><div id='loading'></div></div>";
//    
//    $('body').prepend(divBox);
    
//    $('#load-screen').delay(700).fadeOut(600, function() {
//        $(this).remove();
//    });
    function loadUsersOnline() {
        $.get("functions.php?onlineusers=result", function(data){
            $(".users-online").text(data);
        });
    }

    setInterval(function(){
        loadUsersOnline();
    },500);
    
});



