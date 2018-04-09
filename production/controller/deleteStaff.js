$(document).ready(function(){

    event.preventDefault();
    var idGlobal;
    var currentRow;

    $('.btndelete').on("click", function(){
        idGlobal = $(this).attr('data-id');
        currentRow = $(this).closest('tr');

    })

  $('.deletedata').on("click", function() {
    $.ajax({
        type:'post',
        url:"controller/dodelete.php", 
        data:{
            'action':'deleteStaff',
            'id':idGlobal
        },
        success:function(response){
            if (response == 'ok') {
                currentRow.fadeOut(800,function(){
                    currentRow.remove();
                })
            } else {
              console.log("error");
            }
        }
    })
  });
});