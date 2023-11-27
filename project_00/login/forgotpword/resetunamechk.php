<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $dbhostname="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="practise_login";
    $conn=mysqli_connect($dbhostname,$dbusername,$dbpassword,$dbname);
    if(!$conn){
        die("Connection failed:".mysqli_connect_error());
    }
    $sql="SELECT `username` FROM `login` WHERE `username`=?;";
    $stmt=mysqli_prepare($conn,$sql);
    if(!$stmt){
        die("Statement preparation failed:".mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt,"s",$_POST["signunamenew"]);
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt)>0){
            echo "found";
        }
        else{
            echo "notfound";
        }
    }
}
?>