<?php
include_once 'Dbh.php';
session_start();

class UserAuth extends Dbh{
    //private static $db;

    // public function __construct(){
    //     $this->dbh ->connect();
    // }

    public function register($fullname, $email, $password, $confirmPassword, $country, $gender){
        $conn = $this->connect();
        if($this->confirmPasswordMatch($password, $confirmPassword) == true ){
            $sql = "INSERT INTO students (`full_names`, `email`, `password`, `country`, `gender`) VALUES ('$fullname','$email', '$password', '$country', '$gender')";
            if($conn->query($sql)){
                echo'<script>alert("User Successfully registered");
                window.location="forms/login.php";
                </script>';  
            } else{
                echo'<script>alert("Unable to registered");
                window.location="forms/register.php";
                </script>';
            }
        }else{
            echo'<script>alert("password does not match");
            window.location="forms/register.php";
            </script>';

        
    }
    }
    public function login($email, $password){
        $conn = $this->connect();
        $sql = "SELECT * FROM students WHERE email='$email' AND `password`='$password'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $data = mysqli_fetch_assoc($result);
            // $_SESSION['email'] = $email;
            if($data['email']==$email AND $data['password']==$password){
                $_SESSION['user']=$data['full_names'];
                echo'<script>alert("You are Welcome '.$_SESSION['user'].'");
                        window.location="dashboard.php";
                        </script>';  
                    }else{
                        echo'<script>alert("Invalid username or password");
                        window.location="forms/login.php";
                        </script>';
                    }
                    }else {
                        echo'<script>alert("User not found");
                                window.location="forms/register.php";
                                </script>';
                    }
        //     header("Location: ../dashboard.php");
        // } else {
        //     header("Location: forms/login.php");
        }
    

    public function getUser($username){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getAllUsers(){
        $conn = $this->connect();
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);
        echo"<html>
        <head>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
        </head>
        <body>
        <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
        <table class='table table-bordered' border='0.5' style='width: 80%; background-color: smoke; border-style: none'; >
        <tr style='height: 40px'>
            <thead class='thead-dark'> <th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th>
        </thead></tr>";
        if($result->num_rows > 0){
            while($data = mysqli_fetch_assoc($result)){
                //show data
                echo "<tr style='height: 20px'>".
                    "<td style='width: 50px; background: gray'>" . $data['id'] . "</td>
                    <td style='width: 150px'>" . $data['full_names'] .
                    "</td> <td style='width: 150px'>" . $data['email'] .
                    "</td> <td style='width: 150px'>" . $data['gender'] . 
                    "</td> <td style='width: 150px'>" . $data['country'] . 
                    "</td>
                    <td style='width: 150px'> 
                    <form action='action.php' method='post'>
                    <input type='hidden' name='id'" .
                     "value=" . $data['id'] . ">".
                    "<button class='btn btn-danger' type='submit', name='delete'> DELETE </button> </form> </td>".
                    "</tr>";
            }
            echo "</table></table></center></body></html>";
        }
    }

    public function deleteUser($id){
        $conn = $this->connect();
        $sql = "DELETE FROM students WHERE id = '$id'";
        if($conn->query($sql) == TRUE){
            $result = mysqli_query($conn, $sql);
            if ($result){
    
                echo'<script>alert("user deleted sucessfully");
                window.location="dashboard.php";
                </script>';  
            } else{
                echo'<script>alert("error deleting user");
                window.location="dashboard.php";
                </script>';
            }
        //     header("refresh:0.5; url=action.php?all");
        // } else {
        //     header("refresh:0.5; url=action.php?all=?message=Error");
        }
    }

    public function updateUser($email, $password){
        $conn = $this->connect();
        $sql = "UPDATE students SET password = '$password' WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        //if($result){

            //$data = mysqli_fetch_assoc($result);
            //$id = $data['id'];
            if($result){
                echo'<script>alert("new password assigned");
                window.location="dashboard.php";
                </script>';  
            } else{
                echo'<script>alert("error changing password");
                window.location="forms/login.php";
                </script>';
            }
        // }else{
        //     echo'<script>alert("user not recognised");
        //     window.location="forms/login.php";
        //     </script>';
        }
        
        //     header("Location: ../dashboard.php?update=success");
        // } else {
        //     header("Location: forms/resetpassword.php?error=1");
        // }
    

    public function getUserByUsername($username){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM students WHERE username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function logout(){
        session_unset();
        session_destroy();
        header("location:forms/login.php");
    }

    public function confirmPasswordMatch($password, $confirmPassword){
        if($password == $confirmPassword){
            return true;
        } else {
            return false;
        }
    }
}