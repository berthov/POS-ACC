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
    var inventory_item_id=$("#inventory_item_id").val();
    var counter=$("#counter").val();
    var qty=$("#qty").val();

      $.ajax({
        type:'post',
        url:'controller/doaddrecipe.php',
        data:{
            'recipe_name':recipe_name,
            'inventory_item_id':inventory_item_id,
            'qty':qty,
            'counter':counter
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

    $("#formregistergoods").submit(function(){
    event.preventDefault();

    var item_code=$("#item_code").val();
    var description=$("#description").val();
    var qty=$("#qty").val();
    var min=$("#min").val();
    var max=$("#max").val();
    var category=$("#category").val();
    
      $.ajax({
        type:'post',
        url:'controller/doaddnewgoods.php',
        data:{
            'item_code':item_code,
            'description':description,
            'qty':qty,
            'min':min,
            'max':max,
            'category':category
        },
        success:function(response){
          if(response=='Item already exist'){
            toastr.error('Item already exist');
          }
          else{
             window.location.href="../production/form_validation.php";
          }
        }
    });
  });

  $("#formcogs").submit(function(){
    event.preventDefault();

    var inventory_item_id=$("#inventory_item_id").val();
    var cogs=$("#cogs").val();
    var sales_price=$("#sales_price").val();
    var single_cal2=$("#single_cal2").val();
    
    
      $.ajax({
        type:'post',
        url:'controller/doaddcogs.php',
        data:{
            'cogs':cogs,
            'sales_price':sales_price,
            'inventory_item_id':inventory_item_id,
            'single_cal2':single_cal2
        },
        success:function(response){
          if(response=='At least COGS or Sales Price must be filled'){
            toastr.error('At least COGS or Sales Price must be filled');                     
          }
          else{
             window.location.href="../production/cogs.php";
          }
        }
    });
  });

  $("#formsupplier").submit(function(){
    event.preventDefault();

    var supplier_name=$("#supplier_name").val();
    var supplier_site=$("#supplier_site").val();
    var supplier_type=$("#supplier_type").val();
    var tax=$("#tax").val();
    
    
      $.ajax({
        type:'post',
        url:'controller/doaddsupplier.php',
        data:{
            'supplier_name':supplier_name,
            'supplier_site':supplier_site,
            'supplier_type':supplier_type,
            'tax':tax
        },
        success:function(response){
          if(response=='Supplier already exist'){
            toastr.error('Supplier already exist');                     
          }
          else{
             window.location.href="../production/form_supplier.php";
          }
        }
    });
  });

});