$(document).ready(function(){

    event.preventDefault();


$(".btnrefund").click(function(event) { 

    invoice_id = $(this).attr('data-id');
    $("#modalrefund").modal("show"); 
    document.getElementById("demo").innerHTML = invoice_id; 
    $("#ref").attr("href", "controller/refund_invoice.php?invoice_id=" + invoice_id);

    //    $.ajax({
    //     type:'post',
    //     url:"controller/refund_invoice.php", 
    //      data:{
    //         'invoice_id':invoice_id
    //     },
    //     success:function(response){
    //         if (response == 'Invoice already Refunded') {
    //             toastr.error('Invoice already Refunded');
    //         }
    //         else{
    //             window.location.reload();
    //         }
    //     }
    // });

    });
});
