<?php
class Dbh{
    protected $host;
    protected $user;
    protected $password;
    protected $dbname;
    protected $dbh;
    protected function connect(){
        $this->host="localhost";
        $this->user="root";
        $this->password="";
        $this->dbname="zuriphp";
        $this->dbh = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
if (!$this->dbh){
    echo "connection failed";
}
      return $this->dbh; 
}
}
   
?>


