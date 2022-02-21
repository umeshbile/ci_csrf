function getData(){
    
    $("#users_info").dataTable({
        "ajax": base_url + 'curd/show',
        "deferRender": true,
        "stateSave": true,
        "ordering": false
    });
    
}

$(document).ready(function(){
    
    getData();
});
