$(document).ready(function(){

    event.preventDefault();
	$('.btnrefund').click(function(event) { 

	    invoice_id = $(this).attr('data-id');

	    // document.getElementById("demo").innerHTML = invoice_id; 
	    //$("#ref").attr("href", "controller/refund_invoice.php?invoice_id=" +invoice_id);


	  $('.refunddata').on("click", function() {
	    $.ajax({
	        type:'post',
	        url:'controller/refund_invoice.php',
	        data:{
	         'invoice_id':invoice_id
	        },
	        success:function(response) {
	          if(response=='success'){
	            window.location.href="../production/tables_invoice.php";
	          }
	          else{
	            toastr.error('Invoice Already Refunded');
	          }
	        }
	      });  
		});	
	});
});
