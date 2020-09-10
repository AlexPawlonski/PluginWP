jQuery(document).ready(function ($) {
    $('#Cefii_Contact_submit').click(function(){
        var name = $('#Cefii_Contact_name').val().trim();
        var phone = $('#Cefii_Contact_phone').val().trim();

        if(name == "" || phone == ""){
            $('#result').html('<span style="color:red;">Une erreur est survenue, veuillez réessayer.</span>');
        }else{
            if(!testphone(phone)){
                $('#result').html('<span style="color:red;">Une erreur est survenue, veuillez réessayer.</span>');          
            }else{
                ajaxContact(name, phone, $);
            }
        }
    });

    function ajaxContact(name, phone, $){
        $.ajax({
            type: "POST",
            url: cefiicontact.ajaxurl,
            dataType: "json",
            data: {
                action: cefiicontact.action,
                nonce: cefiicontact.nonce,
                name: name,
                phone: phone
            },
            success: function(data){
                $('#result').html(data);
                $('#Cefii_Contact_name').val("");
                $('#Cefii_Contact_phone').val("");
            },
            error: function(err){
                $('#result').html("error serveur ");
                console.log(err);
            }
            
        });
    }
    

    function testphone($input){
        var expReg = /^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/; 
        if(expReg.test($input)){
            return true;
        }else{
            return false;
        }
    }
});