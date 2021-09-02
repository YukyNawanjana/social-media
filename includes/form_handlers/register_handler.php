<?php

    // Declaring Variables to prevent errors
    $fname = ""; //First Name
    $lname = ""; //Last Name
    $em = ""; //email
    $em2 = "" ; //email 2
    $password = ""; //passwrod
    $password2 =""; //password2
    $date = ""; // Sign up date
    $error_array = array(); //Holds error messages

    if(isset($_POST['register_button'])){

        //Register form values

        //First Name
        $fname = strip_tags($_POST['reg_fname']);  //remove HTML tags
        $fname = str_replace(' ','', $fname);      // Remove Space
        $fname = ucfirst(strtolower($fname));       //Uppercae first letter
        $_SESSION['reg_fname'] = $fname; // Stores First name into session

        //Last Name
        $lname = strip_tags($_POST['reg_lname']);  //remove HTML tags
        $lname = str_replace(' ','', $lname);      // Remove Space
        $lname = ucfirst(strtolower($lname));       //Uppercae first letter
        $_SESSION['reg_lname'] = $lname; // Stores Last name into session

        //Email
        $em = strip_tags($_POST['reg_email']);  //remove HTML tags
        $em = str_replace(' ','', $em);      // Remove Space
        $em = ucfirst(strtolower($em));       //Uppercae first letter
        $_SESSION['reg_email'] = $em; // Stores Email into session

        // Confim Email2
        $em2 = strip_tags($_POST['reg_email2']);  //remove HTML tags
        $em2 = str_replace(' ','', $em2);      // Remove Space
        $em2 = ucfirst(strtolower($em2));       //Uppercae first letter
        $_SESSION['reg_email2'] = $em2; // Stores Email2into session 

        // password
        $password = strip_tags($_POST['reg_password']);  //remove HTML tags

        // password2
        $password2 = strip_tags($_POST['reg_password2']);  //remove HTML tags
    
        $date = date("Y-m-d");  //current date

        if($em == $em2){
            // check if email is in valid format
            if(filter_var($em, FILTER_VALIDATE_EMAIL)){

                $em = filter_var($em, FILTER_VALIDATE_EMAIL);

                // Check if Email already exists
                $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

                // count the number of rows returned
                $num_rows = mysqli_num_rows($e_check);

                if($num_rows > 0){
                    array_push($error_array, "Email already in use<br>");
                }

            }else{
                array_push($error_array, "Invalid email Format<br>");
            }
        }
        else{
            array_push($error_array, "Emails don't match<br>");
        }

        if(strlen($fname) > 25 || strlen($fname)< 2){
            array_push($error_array, "Your First name must be between 2 and 25 characters<br>");
        }

        if(strlen($lname) > 25 || strlen($lname)< 2){

            array_push($error_array, "Your Last name must be between 2 and 25 characters<br>");
        }

        if($password != $password2){

            array_push($error_array, "your Password don't match<br>");
        }else{
            if(preg_match('/[^A-Za-z0-9]/', $password)){

                array_push($error_array, "Your password can only contain English characters or numbers<br>");
            }
        }
        
        if(strlen($password) > 30 || strlen($password) < 5){
            array_push($error_array, "Your Password must be between 5 and 30 characters<br>");
        }

        if(empty($error_array)){
            $password = md5($password); //Encrypt password befor sending to database

            // Generate Username by concatinating first name and last name
            $username = strtolower($fname . "_" . $lname);
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

            $i = 0;
            // if username exist and number to username
            while(mysqli_num_rows($check_username_query) !=0){
                $i++;
                $username = $username. "_" . $i;
                $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
            }

            // Profile pictur assignment
            $rand = rand(1,2);
            if($rand == 1)
                $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
            elseif($rand == 2)
                $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";

        
            $query = mysqli_query($con, "INSERT INTO users VALUES('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");

            array_push($error_array, "<span style='color: #14c000;'>You're all set! Goahead and login</span><br>");

            // Clear Sesstion variables
            $_SESSION['reg_fname'] = "";
            $_SESSION['reg_lname'] = "";
            $_SESSION['reg_email'] = "";
            $_SESSION['reg_email2'] = "";
        }

    }

?>