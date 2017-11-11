<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exam</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link href=<?php echo base_url("assets/bootstrap/css/bootstrap.min.css"); ?> rel='stylesheet' type='text/css' />
         <link href=<?php echo base_url("bootstrap/css/bootstrap.css"); ?> rel='stylesheet' type='text/css' />
        <link href=<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?> rel='stylesheet' type='text/css' />
        <link href=<?php echo base_url("assets/css/form-elements.css"); ?> rel='stylesheet' type='text/css' />
        <link href=<?php echo base_url("assets/css/style.css"); ?> rel='stylesheet' type='text/css' />
<!--        <link rel="shortcut icon" href=<?php //echo base_url("assets/ico/fevicon.png"); ?> >-->

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>ParkInfinia</strong> </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>ParkInfinia</h3>
                                    <p>Enter your username and password to log on:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="" method="post" id="login_form" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="button" id="login_button" class="btn">Sign in!</button>
  
                                     <span id="msg"></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>

        <script type="text/javascript" src=<?php echo base_url("assets/js/jquery-1.11.1.min.js"); ?>></script>
        <script type="text/javascript" src=<?php echo base_url("assets/bootstrap/js/bootstrap.min.js"); ?>></script>
        <script type="text/javascript" src=<?php echo base_url("assets/js/jquery.backstretch.min.js"); ?>></script>
        <script type="text/javascript" src=<?php echo base_url("assets/js/scripts.js"); ?>></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#login_button").click(function() {

                    var wrong = "Wrong credentials";
                    var check = "Fill the details";
                    var username = $("#form-username").val();
                    var password = $("#form-password").val();  
                     
                    if (jQuery.trim(username).length > 0 && jQuery.trim(password).length > 0){   
                        //alert(password);                
                        $.ajax({
                            url: "<?php echo site_url('Login/LoginCheck'); ?>",
                                     //base_url("index.php/Login/login_check"); 
                            type: "POST",
                            data: $('#login_form').serialize(),
                            cache: false,
                            beforeSend: function()
                            { console.log('going');},
                            success: function(response) {  
                                 alert(response);
                               if (response == -1) {
                                   $("#msg").html("You are not allowed to access this page");

                                } else if (response == 0) {
                                   $("#msg").html("Invalid Username Password");
                                }
                                else if (response == 1) {
                                    window.location = "<?php echo site_url('/Dashboard'); ?>";
                                }
                            }
                        });
                    }else {
                       $("#msg").html("Enter Username And Password");
                    }
                });


            });
        </script>
<script>
$(document).keyup(function (e) {
    if ($(".input1:focus") && (e.keyCode === 13)) {
        var wrong = "Wrong credentials";
                    var check = "Fill the details";
                    var username = $("#form-username").val();
                    var password = $("#form-password").val();  
                     
                    if (jQuery.trim(username).length > 0 && jQuery.trim(password).length > 0){   
                        //alert(password);                
                        $.ajax({
                            url: "<?php echo site_url('Login/LoginCheck'); ?>", 
                            type: "POST",
                            data: $('#login_form').serialize(),
                            cache: false,
                            beforeSend: function()
                            { console.log('going');},
                            success: function(response) {  
                                 // alert(response);
                               if (response == -1) {
                                   $("#msg").html("You are not allowed to access");

                                } else if (response == 0) {
                                   $("#msg").html("Invalid Username Password");
                                }
                                else if (response == 1) {
                                    window.location = "<?php echo site_url('/Dashboard'); ?>";
                                }
                            }
                        });
                    }else {
                       $("#msg").html("Enter Username And Password");
                    }
    }
 });

</script>



    </body>
</html>