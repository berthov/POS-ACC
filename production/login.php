<?php
include("controller/doconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="formLogin" >
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" id="username" placeholder="Username" name="username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required="" />
              </div>
              <div>
               <input class="btn btn-default" type = "submit" value = " Log in "/>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action = "controller/doregister.php" method = "POST">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" name="email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required="" />
              </div>
             <!--  <div>
                <input type="text" class="form-control" placeholder="Role" name="role" required="" />
              </div> -->
              <div>
                <input type="text" class="form-control" placeholder="Outlet" name="outlet" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default" name="reg_user">Register</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <script type="text/javascript">
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
                console.log(response);
                if(response=='success')
                {
                  window.location.href="../production/index.php";
                }
                else
                {
                  toastr.error('Wrong Password or Username!');
                }
              }
            });  
          }
        });

          // show when page load
          /*toastr.error('Page Loaded!');
          */
         
         

      });

    </script>
    
});
  </body>
</html>
