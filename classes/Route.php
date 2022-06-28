<?php
class formController extends UserAuth{
    public $fullname;
    public $email;
    public $password;
    public $confirmPassword;
    public $country;
    public $gender;

function __construct($fullname, $email, $password, $confirmpassword, 
$country, $gender) {
    $this->name = $fullname;
    $this->email = $email;
    $this->password = $password;
    $this->confirmpassword = $confirmpassword;
    $this->country = $country;
    $this->gender = $gender;
}

function handleForm () {
    switch(true) {
        case isset($_POST['register']):
            //unpack all data for registering
            $this->fullname = $_POST['fullnames'];
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
            $this->confirmPassword = $_POST['confirmPassword'];
            $this->gender = $_POST['gender'];
            $this->country = $_POST['country'];
            $this->register($this->fullname, $this->email, $this->password, 
            $this->confirmPassword, $this->country, $this->gender);
            break;
    
        case isset($_POST['login']):
            //unpack all data for login
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
            $this->login($this->email, $this->password);
            break;
        case isset($_GET['logout']):
            //unpack all data for logout
            $this->email = $_POST['email'];
            $this->logout($this->email);
            break;
        case isset($_POST['delete']):
            //unpack all data for deleting
            $this->email = $_POST['email'];
            $this->deleteUser($this->email);
            break;
        case isset($_POST['reset']):
            //unpack all data for updating password
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
            $this->updateUser($this->email, $this->password);
            break;
        case isset($_POST['all']):
            //unpack all data for getting all users
            $this->getAllUsers();
            break;
        default:
            echo 'No form was submitted';
            break;
    }
}

}
class loginController extends UserAuth{
    protected $email;
    protected $password;
    function handlelogin() {
        if(isset($_POST['login'])){
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
        $this->login($this->email, $this->password);
}
    }
}

class getAllController extends UserAuth{
    public function getAlluser(){
        $this->getAllUsers();
    }
}
class deleteController extends UserAuth{
    public $id;
    public function handledelete(){
        $this->id=$_POST['id'];
    $this->deleteUser($this->id);

    }
}

class updateController extends UserAuth{
    public $email;
    public $password;
   function handlereset(){
    if(isset($_POST['reset'])){
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
    $this->updateUser($this->email, $this->password);
    }
   }
    
}

class logoutController extends UserAuth{
    public function handlelogout(){
        // if(isset($_GET['logout'])){
        //     session_destroy();
        //     unset($_SESSION['uname']);
        //     header('location:forms/login.php');
        // }
    $this->logout();
    }
}





