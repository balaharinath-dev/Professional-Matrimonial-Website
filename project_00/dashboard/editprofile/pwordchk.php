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
    $sql="SELECT `password` FROM `login` WHERE `username`=?;";
    $stmt=mysqli_prepare($conn,$sql);
    if(!$stmt){
        die("Statement preparation failed:".mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt,"s",$username);
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt,$colpassword);
        if(mysqli_stmt_num_rows($stmt)>0){
            mysqli_stmt_fetch($stmt);
            $storedpassword=$colpassword;
            if(password_verify($_POST["pword"],$storedpassword)){
                echo "success";
            }
            else{
                echo "invalid";
            }
        }
        else{
            echo "usernamenotfound";
        }
    }
    else{
        die("Statement preparation failed:".mysqli_error($conn));
    }
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}