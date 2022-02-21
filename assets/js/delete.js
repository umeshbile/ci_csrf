/*
Ajax for delete
*/
$(function(){
    $(document).on('click','.delete-data',function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var position = $(this).data('position');
        var email = $(this).data('email');
        var token = $(this).data('token');
        
        $("#dtoken").val(token);
        $("#deleteid").val(id);
        
        $(".model-title").html('delete');
        $("#confirmation").html('Want to delete '+name+ ' ?');
        $("#delete-info").modal('show');

        $("#delete-form").on('submit',function(){
            $.ajax({
                url: base_url + 'Curd/delete',
                type: 'POST',
                data: $(this).serialize(),
                cache: false,
                success: function(data){
                    var result = JSON.parse(data);
                    if(result.message == 'success'){
                        alert('testing');
                       $('#dtoken').val(result.token);
                       $('#token').val(result.token);
                       $('delete-info').modal('hide');
                       $('#users_info').dataTable().fndestroy();
                       getData();
                       scrollTop();
                       notification('Successfully deleted','success','top','right');
                       
                       
                    }else{
                        alert();
                        notification('failed to delete','danger','top','right');
                    }
                }
            });
        });
    });
});