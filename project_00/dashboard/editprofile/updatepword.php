<?php
session_start();
$username=$_SESSION["logunamenew"];
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $dbhostname="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="practise_login";
    $conn=mysqli_connect($dbhostname,$dbusername,$dbpassword,$dbname);
    if(!$conn){
        die("Connection failed:".mysqli_connect_error());
    }
    $sql="UPDATE `login` SET `password`=? WHERE `login`.`username`=?";
    $password=$_POST["password"];
    $hashedpassword = password_hash($password,PASSWORD_BCRYPT,['cost' => 12]);
    $stmt=mysqli_prepare($conn,$sql);
    if(!$stmt){
        die("Statement preparation failed:".mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt,"ss",$hashedpassword,$username);
    if(mysqli_stmt_execute($stmt)){
        echo "success";
    };
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>