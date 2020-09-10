jQuery(document).ready(function ($) {
    
    $('.delete').click(function(){
        var idphone = $(this).data("id");
        ajaxContactDelete(idphone, $)
    });

    function ajaxContactDelete(id, $){
        $.ajax({
            type: "POST",
            url: supprContact.ajaxurl,
            dataType: "json",
            data: {
                action: supprContact.action,
                nonce: supprContact.nonce,
                id
            },
            success: function(data){
                $('#message').html(data);
                $("#contact-" + id).fadeOut(300, function(){
                    $(this).remove();
                })
            },
            error: function(err){
                $('#result').html("error serveur ");
                console.log(err);
            }
            
        });
    }
});