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
                    if (response == 'ok') {
                        console.log(mode);
                        console.log(idGlobal);
                    } else {
                      console.log("error");
                    }
                }
            })


       /* if(value == "Inactive"){
            console.log("masuk function inactive");
            $.ajax({
                type:'post',
                url:"controller/dodelete.php", 
                data:{'action':'changeInactiveOutlet','id':idGlobal },
                success:function(response){
                    mode = false;
                    if (response == 'ok') {
                        console.log(idGlobal);
                    } else {
                      console.log("error");
                    }
                }
            })
        } else if(value == "Active"){
            console.log("masuk function active");
            $.ajax({
                type:'post',
                url:"controller/dodelete.php", 
                data:{'action':'changeActiveOutlet','id':idGlobal},
                success:function(response){
                    if (response == 'ok') {
                        console.log(idGlobal);
                    } else {
                      console.log("error");
                    }
                }
            })
        }*/
           
    });
});