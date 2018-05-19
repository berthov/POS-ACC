$('.btnrefund').click(function(event) { 

    invoice_id = $(this).attr('data-id');
    $("#modalrefund").modal("show"); 
    // document.getElementById("demo").innerHTML = invoice_id; 
    $("#ref").attr("href", "controller/refund_invoice.php?invoice_id=" +invoice_id);

});
