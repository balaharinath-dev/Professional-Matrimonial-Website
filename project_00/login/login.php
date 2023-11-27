<?php
session_start();
if(!isset($_SESSION["logunamenew"])&&isset($_COOKIE["logunamenew"])){
    $logunamenew=$_COOKIE["logunamenew"];
    $_SESSION["logunamenew"]=$logunamenew;
}
if(isset($_SESSION["logunamenew"])){
    header("Location:/project_00/dashboard/intro.php");
    exit;
}
if(!isset($_SESSION["signunamenew"])&&isset($_COOKIE["signunamenew"])){
    $signunamenew=$_COOKIE["signunamenew"];
    $_SESSION["signunamenew"]=$signunamenew;
}
if(isset($_SESSION["signunamenew"])){
    header("Location:signup_pgs/signup_pg1.php");
    exit;
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $dbhostname="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="practise_login";
    $conn=mysqli_connect($dbhostname,$dbusername,$dbpassword,$dbname);
    if(!$conn){
        die("Connection failed:".mysqli_connect_error());
    }
    $sql="SELECT `username`,`password` FROM `login` WHERE `username`=?;";
    $stmt=mysqli_prepare($conn,$sql);
    if(!$stmt){
        die("Statement preparation failed:".mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt,"s",$_POST["logunamenew"]);
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt,$colusername,$colpassword);
        if(mysqli_stmt_num_rows($stmt)>0){
            mysqli_stmt_fetch($stmt);
            $storedusername=$colusername;
            $storedpassword=$colpassword;
            if(password_verify($_POST["logpwordnew"],$storedpassword)){
                $_SESSION["logunamenew"]=$_POST["logunamenew"];
                setcookie("logunamenew",$_POST["logunamenew"],time()+3600000,"/");
                echo "success";
                exit;
            }
            else{
                echo "invalidpassword";
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
else{
    header("Location:index.php");
    exit;
}   
?>