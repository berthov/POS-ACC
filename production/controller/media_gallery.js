$(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
});

function validateValue() {

  var eachquantity;
  var quantity;
  var flag = 0;
  var description=[];
  var itemquantity=[];
  var desc ;
  var pricePerItem=[];
  var multiply;
  var sum = 0;
  var subtotal;
  var total;
  
  var $table = $( "<table></table>" );
  var $table1 = $( "<table></table>" );
  var $table2 = $( "<table></table>" );
  var $table3 = $( "<table></table>" );
  var $tableSubtotal = $( "<table></table>" );
  var $tableTotal = $( "<table></table>" );
  var discount;

  quantity = $('.input-number').val();
  $('.input-number').each(function(){
    eachquantity = parseInt(this.value);
    if(eachquantity != "0" ){
      flag++;
      description.push($(this).attr('data-description'));
      pricePerItem.push($(this).attr('data-price'));
      itemquantity.push(+eachquantity);
    }  

  })
  multiply = itemquantity.map(function(x, index) {
    var curMult = x * pricePerItem[index];
    sum += curMult;
    return curMult;
  });

  $(".afterTax").empty();
  $tableTotal.empty();

  if(flag == "0" ){
    $('.btn-primary').removeAttr('data-target','.bs-example-modal-sm');
    toastr.error('Please Input Value!'); 
  }else{
    for ( var i = 0; i < description.length; i++ ) {
      var desc = description[i];
      var quant = itemquantity[i];
      var price = multiply[i];
      var $column = $( "<tr></tr>" );
      var $column1 = $( "<tr></tr>" );
      var $column2 = $( "<tr></tr>" );
      $column.append( $( "<td></td>" ).html(desc) );
      $column1.append( $( "<td></td>" ).html(quant) );
      $column2.append( $( "<td></td>" ).html(price) );
      $table.append( $column );
      $table1.append( $column1 );
      $table2.append( $column2 );
    }

    $('.btn-primary').attr('data-target','.bs-example-modal-sm');
    $table.appendTo( $( ".description" ) );
    $table1.appendTo( $( ".quantity" ) );
    $table2.appendTo( $( ".itemprice" ) );
    var $column3 = $( "<tr></tr>" );
    $column3.append( $( "<td></td>" ).html(sum) );
    $table3.append( $column3 );
    $table3.appendTo( $( ".total" ) );

    subtotal = sum;
    var $columnSubtotal = $( "<tr></tr>" );
    $columnSubtotal.append( $( "<td></td>" ).html(subtotal) );
    $tableSubtotal.append( $columnSubtotal );
    $tableSubtotal.appendTo( $( ".disc" ) );

    total = subtotal;
    var $columnTotal = $( "<tr></tr>" );
    $columnTotal.append( $( "<td></td>" ).html(total) );
    $tableTotal.append( $columnTotal );
    $tableTotal.appendTo( $( ".afterTax" ) );

    flag = 0;

    if(discount == ''){
      $(".disc").empty();  
      $tableSubtotal.empty();
      subtotal = sum;
      var $columnSubtotal = $( "<tr></tr>" );
      $columnSubtotal.append( $( "<td></td>" ).html(subtotal) );
      $tableSubtotal.append( $columnSubtotal );
      $tableSubtotal.appendTo( $( ".disc" ) );
    } 
  }

  $(".discount, .tax_code").on('input', function() {
    $(".disc").empty();  
    $tableSubtotal.empty(); 
    var discount = 0;

    var subtotal = sum;
    discount = $('.discount').val();

    if(discount>sum){
      toastr.error("Discount is greater than price!");
      $(".afterTax").empty();  
      $tableTotal.empty();
      var btn = document.getElementById("submitModal"); btn.disabled = true;
    }else{
      var btn = document.getElementById("submitModal"); btn.disabled = false;
      subtotal = sum - discount;
    
      var $columnSubtotal = $( "<tr></tr>" );
      $columnSubtotal.append( $( "<td></td>" ).html(subtotal) );
      $tableSubtotal.append( $columnSubtotal );
      $tableSubtotal.appendTo( $( ".disc" ) );

        var tax = $('.tax_code').val();

        if(tax == "Yes"){
          $(".afterTax").empty();
          $tableTotal.empty();

          total = 0;
          total = subtotal*110/100;

          var $columnTotal = $( "<tr></tr>" );
          $columnTotal.append( $( "<td></td>" ).html(total) );
          $tableTotal.append( $columnTotal );
          $tableTotal.appendTo( $( ".afterTax" ) );

        } else {
          $(".afterTax").empty();
          $tableTotal.empty();

          total = 0;
          total = subtotal;

          var $columnTotal = $( "<tr></tr>" );
          $columnTotal.append( $( "<td></td>" ).html(total) );
          $tableTotal.append( $columnTotal );
          $tableTotal.appendTo( $( ".afterTax" ) );
        }
    }
  });

}

  $('body').on('hidden.bs.modal', '.modal', function () {
      $(".description").empty();
      $(".quantity").empty();
      $(".itemprice").empty();
      $(".total").empty();
      $(".disc").empty();
      $(".total").empty();
      $(".discount, .tax_code").unbind();
      $(this).find("input,textarea,select").val('').end();
      sum = 0;
  });


$(".modal").on("bs-example-modal-sm", function(){
    $(".modal-body").html("");
});

//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
  e.preventDefault();
  
  fieldName = $(this).attr('data-field');
  type      = $(this).attr('data-type');
  var input = $("input[name='"+fieldName+"']");
  var currentVal = parseInt(input.val());
  if (!isNaN(currentVal)) {
      if(type == 'minus') {
          
          if(currentVal > input.attr('min')) {
              input.val(currentVal - 1).change();
          } 
          if(parseInt(input.val()) == input.attr('min')) {
              $(this).attr('disabled', true);
          }

      } else if(type == 'plus') {

          if(currentVal < input.attr('max')) {
              input.val(currentVal + 1).change();
          }
          if(parseInt(input.val()) == input.attr('max')) {
            $(this).attr('disabled', true);
          } 

      }
  } else {
      input.val(0);
  }
});

$('.input-number').on('change', function() {
  var currentVal = $('.input-number').val();
  maxValue = $('.input-number').attr('max');
  minValue = $('.input-number').attr('min');

  if(currentVal < maxValue){
    $('.btn-number').attr('disabled', false);
  }
  if(currentVal > minValue){
    $('.btn-number').attr('disabled', false);
  }
  
});

$('.input-number').focusin(function(){
	$(this).data('oldValue', $(this).val());
});

$('.input-number').on('input', function() {
      
	minValue =  parseInt($(this).attr('min'));
	maxValue =  parseInt($(this).attr('max'));
	valueCurrent = parseInt($(this).val());
  
	name = $(this).attr('name');
	if(valueCurrent >= minValue) {
			 $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
	} else {
      toastr.error('Sorry, the minimum value was reached');
      $(this).val($(this).data('oldValue'));
      valueCurrent = 0;
	}
	if(valueCurrent <= maxValue) {
     	$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
  	} else {
      toastr.error('Sorry, the maximum value was reached');
      $(this).val($(this).data('oldValue'));
  	}

  valueCurrent = 0;
});

$(".input-number").keydown(function (e) {
   	// Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) || 
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
