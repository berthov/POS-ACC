$(document).ready(function(){

    var idGlobal;

    $('.changeStatus').change(function(){
        
        var mode= $(this).prop('checked');
        idGlobal = $(this).attr('data-id');
        value = $(this).attr('data-value');

            $.ajax({
                type:'post',
                url:"controller/dodelete.php", 
                data:{'id':idGlobal, 'mode' :mode},
                success:function(response){
                    if (response != 'ok') {
                        console.log("error");
                    }
                }
            })
    });
});