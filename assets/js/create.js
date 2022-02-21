/*
   Ajax for Create
*/
$(function(){
$(document).on('submit','#add-info-form',function(e){
    $.ajax({
        url: base_url + 'curd/store',
        type: "POST",
        data: $(this).serialize(),
        cache: false,
        success: function(data){
            console.log(data);
            var result =  JSON.parse(data);
            var nameErr = result.nameErr;
            var positionErr = result.positionErr;
            var emailErr =result.emailErr;
            if(result.message == 'success'){
                $('input:hidden[name="token"]').val(result.token);
                removeClassIsValid('input');
                removeClassIsInvalid('input');
                scrollTop();
                notification('successfully added data','success','top','right');
                $("input:text").val('');
                $("#users_info").dataTable().fnDestroy();
                getData();
            }else{
                $('input:hidden[name="token"]').val(result.token);
                if(nameErr == ""){
                    removeClassIsInvalid("#name");
                    addClassIsValid("#name");
                    $("#invalid-name").html("");
                }else{
                    addClassIsInvalid("#name");
                    $("#invalid-name").html(nameErr);
                }
                if(positionErr == ""){
                    removeClassIsInvalid("#position");
                    addClassIsValid("#position");
                    $("#invalid-position").html("");
                }else{
                    addClassIsInvalid("#position");
                    $("#invalid-position").html(positionErr);
                }
                if(emailErr == ""){
                    removeClassIsInvalid("#email");
                    addClassIsValid("#email");
                    $("#invalid-email").html("");
                }else{
                    addClassIsInvalid("#email");
                    $("#invalid-email").html(emailErr);
                }

            }
        }
    });
    e.preventDefault();
    
});
});