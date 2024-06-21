<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $_SESSION["resetpassword"]=$_POST["resetpassword"];
    setcookie("resetpassword",$_POST["resetpassword"],time()+3600,"/");
    echo "success";
    exit;
}
else{
    echo "invalid";
}
?>