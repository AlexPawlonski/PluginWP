jQuery(document).ready(function($){
    
    $("#b-map").click(function () { 
        var titre = $('#Cm-title').val()
        var latitude = $('#Cm-latitude').val()
        var longitude = $('#Cm-longitude').val()
        var verif = true;
        if(titre == ""){
            $('#Cm-title-error').css({
                'display' : 'block'
            });
            verif = false;
        }else{
            $('#Cm-title-error').css({
                'display' : 'none'
            });
        }
        if(latitude == "" || isNaN(latitude) == true){
            $('#Cm-latitude-error').css({
                'display' : 'block'
            });
            verif = true;
        }else{
            $('#Cm-latitude-error').css({
                'display' : 'none'
            });
        }

        if(longitude == "" || isNaN(longitude) == true){
            $('#Cm-longitude-error').css({
                'display' : 'block'
            });
            verif = true;
        }else{
            $('#Cm-longitude-error').css({
                'display' : 'none'
            });
        }
        if (verif) {
            $('#formMap').submit();
        }
    });

    $("#supr-map").click(function(){
        
        if (confirm(textJs.confirmation)) {
        $('#formMapDelete').submit();

        }
    });

    $('#shortCode').click( function() {
        this.select();
        document.execCommand('copy');
        $('#copier').css({
            'display' : 'block'
        })
    });
    
})