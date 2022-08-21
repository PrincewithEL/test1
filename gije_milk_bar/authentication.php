<?php
require_once "dbconnection.inc.php";

session_start();

if(isset($_POST['login'])){

    $id = $_POST['email'];
    $password = $_POST['password'];
    $module = $_POST['mod'];    
    $a = "Customer";
    $d = "Service Representative";
    $u = "Manager";

if ($module == $u){
         $sql = "SELECT * FROM `staff` WHERE `Email_Address`='$id'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);

            $pass = $row['Password'];

if(md5($password) == $pass){

                $_SESSION['manname'] = $row['Administrator_ID'];
                $_SESSION['Email'] = $row['Email_Address'];
                echo "Login Succesful.";
                header("Location: index.php");
            }else{
                echo "Incorrect Password.";
            }
        }else{
            echo "Manager does not exist.";
        }
}else if ($module == $d){
         $sql = "SELECT * FROM `staff` WHERE `Email_Address`='$id'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);

            $pass = $row['Password'];

if(md5($password) == $pass){

                $_SESSION['srname'] = $row['Doctor_ID'];
                $_SESSION['Email1'] = $row['Email_Address'];
                echo "Login Succesful.";
                header("Location: index1.php");
            }else{
                echo "Incorrect Password.";
            }
        }else{
            echo "Service Representative does not exist.";
        }
}else if ($module == $a){
         $sql = "SELECT * FROM `customer` WHERE `Email_Address`='$id'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);

            $pass = $row['Password'];

if(md5($password) == $pass){

                $_SESSION['custname'] = $row['User_ID'];
                $_SESSION['Email2'] = $row['Email_Address'];
                echo "Login Succesful.";
                header("Location: index2.php");
            }else{
                echo "Incorrect Password.";
            }
        }else{
            echo "Customer does not exist.";
        }
}else{
    echo "An error occured. Kindly chose a valid module.";
}
            }

           
?>
