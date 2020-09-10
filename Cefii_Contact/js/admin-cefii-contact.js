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
                var nbrIcon = $("#wp-admin-bar-cefii-contact .ab-label");
                var nbr = parseInt(nbrIcon.text());
                nbr--;
                nbrIcon.text(nbr);
            },
            error: function(err){
                $('#result').html("error serveur ");
                console.log(err);
            }
            
        });
    }
});