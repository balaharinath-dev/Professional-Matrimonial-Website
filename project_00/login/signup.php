<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $_SESSION["signunamenew"]=$_POST["signunamenew"];
    setcookie("signunamenew",$_POST["signunamenew"],time()+3600000,"/");
    echo "success";
    exit;
}
else{
    echo "invalid";
}
?>
