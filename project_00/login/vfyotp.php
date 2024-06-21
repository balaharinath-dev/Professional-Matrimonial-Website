<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(isset($_POST["userotp"])&&isset($_POST["otpval"])){
        if($_POST["userotp"]==$_POST["otpval"]){
            echo "success";
        }
        else{
            echo "invalid";
        }
    }
}
?>