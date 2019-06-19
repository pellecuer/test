//event handler
$(document).ready(function() {
    $(".edit-for").on("mouseenter", function(){
        $(this).attr('contenteditable', 'true');
    });

    $(".edit-for").on("mouseleave", function(){
        $(this).attr('contenteditable', 'false');
    });

    $(".edit-for").on("keypress", function(){
        $(this).text('');
    });
});
