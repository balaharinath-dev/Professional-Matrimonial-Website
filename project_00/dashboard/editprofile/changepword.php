<?php
session_start();
if(!isset($_COOKIE["logunamenew"])&&!isset($_SESSION["logunamenew"])){
    header("Location:/project_00/login/login.php");
    exit;
}
$webusername=$_SESSION["logunamenew"];
$dbhostname = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "practise_login";
$conn = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT `photo`,`photoType` FROM `login` WHERE `username`=?;";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("Statement preparation failed: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "s", $webusername);
if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $realcolphoto,$realcolphototype);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_fetch($stmt);
        $bfrimageData = $realcolphoto;
        $imageType = $realcolphototype;
        $formattedimgdata=str_replace('-', '+', $bfrimageData);
        if ($bfrimageData) {
            $photoUrl = $imageType.','.$formattedimgdata;
        } else {
            echo "Invalid image format.";
        }
    } else {
        echo "No photo found.";
    }
}
mysqli_stmt_free_result($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<?php
$dbhostname="localhost";
$dbusername="root";
$dbpassword="";
$dbname="practise_login";
$conn=mysqli_connect($dbhostname,$dbusername,$dbpassword,$dbname);
if(!$conn){
    die("Connection failed:".mysqli_connect_error());
}
$sql="SELECT `username`,`firstname`,`midname`,`lastname` FROM `login` WHERE `username`=?;";
$stmt=mysqli_prepare($conn,$sql);
if(!$stmt){
    die("Statement preparation failed:".mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt,"s",$webusername);
if(mysqli_stmt_execute($stmt)){
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt,$colusername,$colfirstname, $colmidname, $collastname);
    if(mysqli_stmt_num_rows($stmt)>0){
        mysqli_stmt_fetch($stmt);
        $storedusername = $colusername;
        $storedfirstname = $colfirstname;
        $storedlastname = $collastname; 
        $storedmidname = $colmidname;        
    }
}
else{
    die("Statement preparation failed:".mysqli_error($conn));
}
$name;
if($storedmidname==""){
    $name=$storedfirstname." ".$storedlastname;
}
else{
    $name=$storedfirstname." ".$storedmidname." ".$storedlastname; 
}
mysqli_stmt_free_result($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/project_00/icons8-chatbot-32.ico" type="image/x-icon">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="editprofile.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Mooli&family=Yatra+One&display=swap');</style>
</head>
<body>
    <div class="container-fluid p-0 sticky-top">
        <div class="row m-0 justify-content-center">
            <div class="col-12 p-0" style="background-color: #ebe4d1;">
                <div class="row m-0 p-1 justify-content-between">
                    <div class="col-4 p-2">
                        <button class="btn btn-lg p-0 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/></svg></button>
                    </div>
                    <div class="col-4 p-0 d-flex justify-content-center align-items-center">
                        <h3 class="logo p-2 pb-0 m-0">
                            <div class="row m-0">
                                <div class="col-4 px-0"><img height="40px" width="40px" src="/project_00/svg/mysvg.svg"></div>
                                <div class="col-8 px-0 d-flex justify-content-center align-items-center"><p class="p-0 m-0 mb-2 mb-sm-2 mb-md-1 mb-lg-1 mb-lg-1">Safari</p></div>
                            </div>
                        </h3>
                    </div>
                    <div class="col-4 p-2 pe-0 d-flex justify-content-end">
                        <div class="row m-0">
                            <div class="col-12 pe-2 d-flex justify-content-center">
                                <form action="/project_00/login/logout.php">
                                    <button type="submit" class="btn btn-sm mybtn mylogbtn">Log out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <!--offcanvas-->
                <div class="offcanvas offcanvas-start s-canvas" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header my-2 pb-0">
                        <div class="row m-0 d-flex align-items-center justify-content-start">
                            <div class="col-2 px-0">
                                <img src="<?php echo $photoUrl ?>" style="border-radius: 100%; border:1px solid rgba(0,0,0,0.5);" height="50px" width="50px" class="img-fluid" alt="...">
                            </div>
                            <div class="col-10 ps-2 pe-0">
                                <div class="row m-0">
                                    <div class="col-12 px-0">
                                        <h5 class="my-1"><b><?php echo $name ?></b></h5>
                                    </div>
                                    <div class="col-12 px-0">
                                        <h6 class="mb-0 overflow-hidden"><?php echo $storedusername ?></h6>
                                    </div>
                                </div>                               
                            </div>                           
                        </div>
                    </div>
                    <div class="offcanvas-body pt-0">                        
                        <hr class="my-3 mx-0">
                        <div class="list-group">
                            <a href="/project_00/dashboard/intro.php" class="list-group-item list-group-item-action" aria-current="true">Home</a>
                            <a href="editprofile.php" class="list-group-item list-group-item-action">Edit Profile</a>
                        </div>
                    </div>
                </div>
            <!--offcanvas-->
            </div>
        </div>
    </div>
    <div class="container py-3 px-md-5 px-sm-3 px-3" style="flex-grow:1">
        <div class="row m-0 justify-content-center align-items-center">
            <div class="col-lg-8 col-md-9 col-12 px-0">
                <form id="pwordform">
                    <div class="row m-0 mycontainer-fluid p-sm-5 p-3">
                        <div class="col-12 p-0 px-sm-3 px-1 d-flex mb-5 justify-content-start align-items-center">
                            <span class="signhead"><b>Change password </b></span>                   
                        </div>
                        <div class="col-12 p-0 px-2 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="password" id="opword" name="opword" placeholder="Enter old Password">
                                <label class="form-floating-label" for="opword">Enter old Password</label>
                            </div>
                            <div class="invalid-feedback d-block" id="opworddiv"></div>
                        </div> 
                        <div class="col-12 p-0 px-2 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="password" id="pword" name="pword" placeholder="Enter new Password">
                                <label class="form-floating-label" for="pword">Enter new Password</label>
                            </div>
                        </div> 
                        <div class="col-12 p-0 px-2 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="password" id="rpword" name="rpword" placeholder="Re-enter new Password">
                                <label class="form-floating-label" for="rpword">Re-enter new Password</label>
                            </div>
                            <div class="invalid-feedback d-block" id="rpworddiv"></div>
                        </div>
                        <div class="col-12 form-group mb-2 pe-3 text-end">
                            <input type="checkbox" class="form-check-input me-1" id="pwordcheck">
                            <label class="form-label" for="logcheck">Show passwords</label>
                        </div>
                        <div class="col-12 mb-4 px-2">
                            <div class="row m-0">
                                <div class="col-12 p-0 px-2 mb-2"><b>Password must have</b></div>
                                <div class="col-1 p-0 px-2" id="sign1">&#8226;</div>
                                <div class="col-11 p-0 px-2" id="desc1">An uppercase letter</div>
                                <div class="col-1 p-0 px-2" id="sign2">&#8226;</div>
                                <div class="col-11 p-0 px-2" id="desc2">A character (@,#,$,%,^,&,*)</div>
                                <div class="col-1 p-0 px-2" id="sign3">&#8226;</div>
                                <div class="col-11 p-0 px-2" id="desc3">A number</div>
                                <div class="col-1 p-0 px-2" id="sign4">&#8226;</div>
                                <div class="col-11 p-0 px-2" id="desc4">Minimum of 12 characters</div>
                            </div>
                        </div> 
                        <div class="col-12 mb-2 px-2 d-flex justify-content-end">
                            <button type="reset" class="btn myclrbtn btn-secondary me-2">Clear</button>
                            <button type="submit" class="btn mybtn btn-primary" id="pwordsub">Change password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="editprofile.js"></script>
</body>
</html>