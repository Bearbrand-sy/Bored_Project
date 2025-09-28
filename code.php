<?php
session_start();
include('dbcon.php');

function sendemail_verify($name, $email, $verify_token){

}

    if(isset($_POST[register.php]))
        {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $verify_token = md5(rand());
            //check email exist or not
            
            $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
            $check_email_query_run = mysql_query($con, $check_email_query);
    
            if(mysql_num_rows($check_email_query_run) >0){
                $_SESSION['status'] = 'Email is already Exist';
                header("location: register.php");
            }else {
                //insert user

                $query = "INSERT INTO users (name, phone, email, password, verify_token	) VALUES ('$name','$phone','$email','$password','$verify_token')";
                $query_run = mysql_query($con, $query);

                if($query_run){
                    sendemail_verify("$name", "$email", "$verify_token");
                     $_SESSION['status'] = 'Registration Succesfull! Please verify your Email address';
                header("location: register.php");
                }else{
                    $_SESSION['status'] = 'Registration failed!';
                header("location: register.php");
                }
            }
        }


?>