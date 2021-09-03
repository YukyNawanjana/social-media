<?php
    require 'config/config.php';
    require 'includes/form_handlers/register_handler.php';
    require 'includes/form_handlers/login_handler.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Social</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="assets/js/register.js"></script>
    
</head>
<body>
<?php  

        if(isset($_POST['register_button'])) {
            echo '
            <script>

            $(document).ready(function() {
                $("#first").hide();
                $("#second").show();
            });

            </script>

            ';
        }


        ?>

    <!-- New UI -->
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-lg-6">
                <h2>Sosic Media helps you connect and share with the people in your life.</h2>
            </div>
            <div class="col-lg-6">

                <div id="first">
                    <div class="card p-5">
                        <h1 class="text-center">Sign In</h1>
                        <form action="register.php" method="POST">
                            <div class="form-group">
                                <label for="">Email address</label>
                                <input type="email" class="form-control" name="log_email" placeholder="Email Address" value="<?php if(isset($_SESSION['log_email'])){ echo $_SESSION['log_email'];}?>" required> 
                            </div>
                            <br>
                            <input type="password" name="log_password" placeholder="Password" required>
                            <br>
                            <?php if(in_array("Email or Password was incorect<br>", $error_array)) echo "Email or Password was incorect<br>";?>
                            <input type="submit" name="login_button" value="Log In">
                            <br>
                            <a href="#" id="signup" class="signup">Need and account register</a>
                        </form>
                    </div>
                </div>
            

                <div id="second">
                   <div class="card">
                   <form action="register.php" method="POST">
                        <input type="text" name="reg_fname" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])){ echo $_SESSION['reg_fname'];}?>" required>
                        <br>
                        <?php if(in_array("Your First name must be between 2 and 25 characters<br>", $error_array)) echo "Your First name must be between 2 and 25 characters<br>";?>

                        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])){ echo $_SESSION['reg_lname'];}?>" required>
                        <br>
                        <?php if(in_array("Your Last name must be between 2 and 25 characters<br>", $error_array)) echo "Your Last name must be between 2 and 25 characters<br>";?>

                        <input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])){ echo $_SESSION['reg_email'];}?>" required>
                        <br> 
                        <input type="email" name="reg_email2" placeholder="Confim Email" value="<?php if(isset($_SESSION['reg_email2'])){ echo $_SESSION['reg_email2'];}?>" required>
                        <br>
                        <?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
                            else if(in_array("Invalid email Format<br>", $error_array)) echo "Invalid email Format<br>";
                            else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>";?>
                        
                        <input type="password" name="reg_password" placeholder="password" required>
                        <br>
                        <input type="password" name="reg_password2" placeholder=" Confim password" required>
                        <br>
                        <?php if(in_array("Your Password must be between 5 and 30 characters<br>", $error_array)) echo "Your Password must be between 5 and 30 characters<br>";
                            else if(in_array("Your password can only contain English characters or numbers<br>", $error_array)) echo "Your password can only contain English characters or numbers<br>";
                            else if(in_array("your Password don't match<br>", $error_array)) echo "your Password don't match<br>";?>

                        <input type="submit" name="register_button" value="register">
                        <br>
                        <?php if(in_array("<span style='color: #14c000;'>You're all set! Goahead and login</span><br>", $error_array)) echo "<span style='color: #14c000;'>You're all set! Goahead and login</span><br>";?>
                        <a href="#" id="signin" class="signin">Already have an account? Sign in here</a>
                    </form>
                   </div>
                </div>

            </div>
        </div>
    </div>
    <!-- New UI End -->

</body>
</html>