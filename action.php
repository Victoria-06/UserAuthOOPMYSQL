<?php

require 'classes/Dbh.php';
require 'classes/UserAuth.php';
require 'classes/Route.php';
if(isset($_POST['register'])){
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmpassword = $_POST['confirmpassword'];
                $gender = $_POST['gender'];
                $country = $_POST['country'];
        

$route = new formController($fullname, $email, $password, $confirmPassword, 
$country, $gender);
$route->handleForm();
}
 if(isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $route = new loginController($email.$password);
            $route->handlelogin();
 }
    if(isset($_POST['reset'])){
            $email =$_POST ['email'];
            $password = $_POST ['password'];
            $route = new updateController ($email, $password);
            $route->handlereset();
    
    }
    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $route = new deleteController($id);
        $route->handledelete();
        

    }
if(isset($_POST['all'])){
    $route = new getAllController();
            $route->getAlluser();

}


// if(isset($_GET['logout'])){
//     session_destroy();
//     unset($_SESSION['uname']);
//     header('location:forms/login.php');
//}
if(isset($_POST['logout'])){
    $route= new logoutController();
    $route->handlelogout();
}

