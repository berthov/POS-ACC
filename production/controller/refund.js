$(document).ready(function(){

    event.preventDefault();
    var idGlobal;

    $('.btnrefund').on("click", function(){
        idGlobal = $(this).attr('data-id');

    })

  $('.refunddata').on("click", function() {
    $.ajax({
        type:'post',
        url:"controller/refund_invoice.php", 
        data:{
            'id':idGlobal
        },
        success:function(response){
            if (response == 'Invoice already Refunded') {
                toastr.error('Invoice already Refunded');
            }
            else{
                window.location.reload();
            }
        }
    })
  });
});