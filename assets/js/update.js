/*
 Ajax for update
*/

$(function(){
    $(document).on('click','.edit-data', function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var position = $(this).data('position');
        var email = $(this).data('email');

        $("#add-info-form").attr('id','update_info_form');
        $("#id").val(id);
        $("#name").val(name);
        $("#position").val(position);
        $("#email").val(email);

        $("#update_info_form").on('submit',function(e){
            $.ajax({
                url: base_url + 'Curd/update',
                type: 'POST',
                data: $(this).serialize(),
                cache: false,
                success: function(data){
                    var result = JSON.parse(data);
                    var nameErr = result.nameErr;
                    var positionErr = result.positonErr;
                    var emailErr = result.emailErr;

                    if(result.message == 'success'){
                   $("#update_info_form").attr('id','add-info-form'); 
                   $('input:hidden[name="token"]').val(result.token);
                   $('input:hidden[name="id"]').val("");
    
                   removeClassIsValid('input');
                   removeClassIsInvalid('input');
                   scrollTop();
                   notification('successfully updated data','success','top','right');

                   $("input:text").val('');
                   $("#users_info").dataTable().fnDestroy();
                   getData();
                   
                   
                    }else{
                        $('input:hidden[name="token"]').val(result.token);
                        if(nameErr == ""){
                            removeClassIsInvalid("#name");
                            removeClassIsValid("#name");
                            $("#invalid-name").html("");
                        }else{
                            addClassIsInvalid("#name");
                            $("invalid-name").html(nameErr);
                        }

                        if(positionErr == ""){
                            removeClassIsInvalid("#position");
                            removeClassIsValid("#position");
                            $("#invalid-position").html("");
                        }else{
                            addClassIsInvalid("#position");
                            $("invalid-position").html(positionErr);
                        }

                        if(emailErr == ""){
                            removeClassIsInvalid("#email");
                            removeClassIsValid("#email");
                            $("#invalid-email").html("");
                        }else{
                            addClassIsInvalid("#email");
                            $("invalid-email").html(emailErr);
                        }

                    }

                }

             
            });
            e.preventDefault();
        });

    });
});