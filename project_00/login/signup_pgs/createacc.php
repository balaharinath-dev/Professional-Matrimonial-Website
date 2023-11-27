<?php
session_start();
$username=$_SESSION["signunamenew"];
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $dbhostname="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="practise_login";
    $conn=mysqli_connect($dbhostname,$dbusername,$dbpassword,$dbname);
    if(!$conn){
        die("Connection failed:".mysqli_connect_error());
    }
    $sql="INSERT INTO `login`(`username`, `password`, `firstname`, `midname`, `lastname`, `gender`, `bloodgroup`, `dob`, `age`, `martialstatus`, `religion`, `community`, `caste`, `mobcode`, `mobno`, `instaid`, `doorno`, `street`, `area`, `city`, `pincode`, `state`, `country`, `nationality`, `native`, `school`, `highestqualification`, `college`, `job`, `annualincome`, `fathersname`, `mothersname`, `siblingno`, `smoking`, `hobbies`, `dietarypref`, `partneragerange`, `partnerageend`, `partnereduucation`, `partnerjob`, `partneranincome`, `partnerincomeend`, `otherpref`, `horoscope`, `abouturself`,`photo`,`photoType`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $jsonData=$_POST["jsonData"];
    $data=json_decode($jsonData);
    $password=$data->passwordFinal;
    $hashedPassword = password_hash($password,PASSWORD_BCRYPT,['cost' => 12]);
    $imageDataURI=$data->photoDataFinal;
    $stmt=mysqli_prepare($conn,$sql);
    if(!$stmt){
        die("Statement preparation failed:".mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt,"ssssssssissssssssssssssssssssississsiissiisssss",$username,$hashedPassword,$data->fnameFinal,$data->mnameFinal,$data->lnameFinal,$data->genderFinal,$data->bloodgrpFinal,$data->dateFinal,$data->ageFinal,$data->martialstatusFinal,$data->religionFinal,$data->communityFinal,$data->casteFinal,$data->mobcodeFinal,$data->mobnoFinal,$data->instaFinal,$data->doorFinal,$data->streetFinal,$data->areaFinal,$data->cityFinal,$data->pincodeFinal,$data->stateFinal,$data->countryFinal,$data->nationalityFinal,$data->nativeFinal,$data->schoolFinal,$data->highqualFinal,$data->collegeFinal,$data->jobFinal,$data->aincomeFinal,$data->fanameFinal,$data->monameFinal,$data->siblingsFinal,$data->sdFinal,$data->hobbyFinal,$data->dietFinal,$data->pagestartFinal,$data->pageendFinal,$data->peducateFinal,$data->pjobFinal,$data->pincstartFinal,$data->pincendFinal,$data->prefFinal,$data->horoscopeFinal,$data->yourselfFinal,$imageDataURI,$data->photoTypeFinal);
    if(mysqli_stmt_execute($stmt)){
        echo "success";
    };
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>