$(document).ready(function() {

  $("#formLogin").submit(function(){
  event.preventDefault();

    var username=$("#username").val();
    var password=$("#password").val();

    if(username!="" && password!=""){
       $.ajax({
        type:'post',
        url:'controller/dologin.php',
        data:{
         'username':username,
         'password':password
        },
        success:function(response) {
          if(response=='success'){
            window.location.href="../production/index.php";
          }
          else{
            toastr.error('Wrong Password or Username');
          }
        }
      });  
    }
  });

  $("#formRegister").submit(function(){
  event.preventDefault();

    var username=$("#usernameregister").val();
    var email=$("#email").val();
    var password=$("#passwordregister").val();
    var cpassword=$("#cpassword").val();
    var outlet=$("#outlet").val();

      $.ajax({
        type:'post',
        url:'controller/doregister.php',
        data:{
         'username':username,
         'password':password,
         'cpassword':cpassword,
         'email':email,
         'outlet':outlet
        },
        success:function(response){
          if(response=='password did not match'){
            toastr.error('Password did not match');
          }
          else if(response=='Username already exist'){
            toastr.error('Username already exist');
          }
          else if(response=='Email already exist'){
            toastr.error('Email already exist');
          }
          else{
            window.location.href="../production/login.php";
          }
        }
    });
  });
      
  $("#formRegisterStaff").submit(function(){
    event.preventDefault();

    var username=$("#usernamestaff").val();
    var role=$("#rolestaff").val();
    var email=$("#emailstaff").val();
    var password=$("#passwordstaff").val();
    var cpassword=$("#cpasswordstaff").val();
    var outlet=$("#outletstaff").val();

      $.ajax({
        type:'post',
        url:'controller/doregisterstaff.php',
        data:{
         'username':username,
         'role':role,
         'password':password,
         'cpassword':cpassword,
         'email':email,
         'outlet':outlet
        },
        success:function(response){
          if(response=='password did not match'){
            toastr.error('Password did not match');
          }
          else if(response=='Username already exist'){
            toastr.error('Username already exist');
          }
          else if(response=='Email already exist'){
            toastr.error('Email already exist');
          }
          else{
            window.location.href="../production/employees.php";
          }
        }
    });
  });

    $("#formregisterrecipe").submit(function(){
    event.preventDefault();

    var recipe_name=$("#recipe_name").val();
    var item_code=$("#item_code").val();
    var description=$("#description").val();
    var qty=$("#qty").val();

      $.ajax({
        type:'post',
        url:'controller/doaddrecipe.php',
        data:{
            'recipe_name':recipe_name,
            'item_code':item_code,
            'description':description,
            'qty':qty
        },
        success:function(response){
          if(response=='Recipe already exist'){
            toastr.error('Recipe already exist');
          }
          else{
            window.location.href="../production/recipe.php";
          }
        }
    });
  });
});