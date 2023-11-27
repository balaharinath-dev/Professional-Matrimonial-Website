<?php
$webusername=$_SESSION["logunamenew"];
$dbhostname="localhost";
$dbusername="root";
$dbpassword="";
$dbname="practise_login";
$conn=mysqli_connect($dbhostname,$dbusername,$dbpassword,$dbname);
if(!$conn){
    die("Connection failed:".mysqli_connect_error());
}
$sql="SELECT `sfid`,`firstname`,`midname`,`lastname`,`job`,`martialstatus`,`age`,`photo` ,`photoType` FROM `login` WHERE `username` != ? ;";
$stmtnew=mysqli_prepare($conn,$sql);
if(!$stmtnew){
    die("Statement preparation failed:".mysqli_error($conn));
}
mysqli_stmt_bind_param($stmtnew,"s",$webusername);
if(mysqli_stmt_execute($stmtnew)){
    mysqli_stmt_store_result($stmtnew);
    mysqli_stmt_bind_result($stmtnew, $colsfid, $colfirstname, $colmidname, $collastname, $coljob, $colmartialstatus, $colage, $realcolphoto, $realcolphototype);
    while(mysqli_stmt_fetch($stmtnew)){
        $sqlnxt="SELECT COUNT(`interestedin`) FROM `interest` WHERE `interestedin`=?;";
        $stmtnxt=mysqli_prepare($conn,$sqlnxt);
        if(!$stmtnxt){
            die("Statement preparation failed:".mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmtnxt,"s",$sfid);
        if(mysqli_stmt_execute($stmtnxt)){
            mysqli_stmt_store_result($stmtnxt);
            mysqli_stmt_bind_result($stmtnxt,$count);
            if(mysqli_stmt_fetch($stmtnxt)){
                $storedinterest=$count;
            }
        }
        $storedsfid = $colsfid;
        $storedfirstname = $colfirstname;
        $storedmidname = $colmidname;
        $storedlastname = $collastname;
        $storedage = $colage;
        $storedmartialstatus = $colmartialstatus;
        $storedjob = $coljob;
        $bfrimageData = $realcolphoto;
        $imageType = $realcolphototype;
        $formattedimgdata=str_replace('-', '+', $bfrimageData);
        if($bfrimageData){
            $photoUrl = $imageType.','.$formattedimgdata;
        }else{
            echo "Invalid image format.";
        }
        $name;
        if($storedmidname==""){
            $name=$storedfirstname." ".$storedlastname;
        }
        else{
            $name=$storedfirstname." ".$storedmidname." ".$storedlastname; 
        }
        echo '
            <div class="col-xl-3 col-md-4 col-sm-6 col-12 p-1 d-flex flex-column">
                <div class="card" style="flex-grow:1">
                    <div class="row h-100 g-0">
                        <div class="col-12 position-relative">
                            <img src="' . $photoUrl . '" class="img-fluid rounded-top" alt="...">
                            <div class="vignette d-flex justify-content-center align-items-end">
                                <div class="d-flex justify-content-center align-items-end">
                                    <p style="font-size: 22px; font-weight: bold;">' .$name. '</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <div class="row m-0">
                                    <div class="col-12 p-0"><p class="card-text mb-2"><b>Safari-ID:</b> ' .$storedsfid. '</p></div>
                                    <div class="col-12 p-0"><p class="card-text mb-2"><b>Martial Status:</b> ' .$storedmartialstatus. '</p></div>
                                    <div class="col-12 p-0"><p class="card-text mb-2"><b>Age:</b> ' .$storedage. '</p></div>
                                    <div class="col-12 p-0"><p class="card-text mb-4" style="color: #ff1493;"><b>Interests:</b> <span id ="interestdiv'.$storedsfid.'">'.$storedinterest.'</span</p></div>
                                    <div class="col-12 p-0">
                                        <div class="row p-0 m-0">
                                            <div class="col-12 mb-0 p-0 px-2"><button id="check'.$storedsfid.'" type="button" class="btn chkbtn btn-sm mybtn px-1 w-100">Check in</button></div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
}
else{
    die("Statement preparation failed:".mysqli_error($conn));
}
mysqli_stmt_free_result($stmtnew);
mysqli_stmt_close($stmtnew);
?>