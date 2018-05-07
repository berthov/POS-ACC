$(document).ready(function(){

    var idGlobal;

    $('.changeInventoryStatus').change(function(){
        console.log("item status changed");
        var mode= $(this).prop('checked');
        idGlobal = $(this).attr('data-id');
        value = $(this).attr('data-value');

            $.ajax({
                type:'post',
                url:"controller/deleteinventory.php", 
                data:{'id':idGlobal, 'mode' :mode},
                success:function(response){
                    if (response != 'ok') {
                        console.log("error");
                    }
                    else{
                        toastr.success('Status Changed');
                    }
                }
            })
    });

    $('.changeOutletStatus').change(function(){
        console.log("outlet status changed");
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
                    else{
                        toastr.success('Status Changed');
                    }
                }
            })
    });

    
});