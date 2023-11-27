<?php
session_start();
if(!isset($_COOKIE["logunamenew"])&&!isset($_SESSION["logunamenew"])){
    header("Location:/project_00/login/login.php");
    exit;
}
$webusername=$_SESSION["logunamenew"];
$dbhostname="localhost";
$dbusername="root";
$dbpassword="";
$dbname="practise_login";
$conn=mysqli_connect($dbhostname,$dbusername,$dbpassword,$dbname);
if(!$conn){
    die("Connection failed:".mysqli_connect_error());
}
$sql="SELECT * FROM `login` WHERE `username`=?;";
$stmt=mysqli_prepare($conn,$sql);
if(!$stmt){
    die("Statement preparation failed:".mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt,"s",$webusername);
if(mysqli_stmt_execute($stmt)){
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $colsfid, $colusername, $colpassword, $colfirstname, $colmidname, $collastname, $colgender,
    $colbloodgroup, $coldob, $colage, $colmartialstatus, $colreligion, $colcommunity, $colcaste, $colmobcode, $colmobno,
    $colinstaid, $coldoorno, $colstreet, $colarea, $colcity, $colpincode, $colstate, $colcountry, $colnationality,
    $colnative, $colschool, $colhighestqualification, $colcollege, $coljob, $colannualincome, $colfathersname,
    $colmothersname, $colsiblingno, $colsmoking, $colhobbies, $coldietarypref, $colpartneragerange,
    $colpartnerageend, $colpartnereduucation, $colpartnerjob, $colpartneranincome, $colpartnerincomeend,
    $colotherpref, $colhoroscope, $colabouturself, $colphoto, $colphototype);
    if(mysqli_stmt_num_rows($stmt)>0){
        mysqli_stmt_fetch($stmt);
        $storedsfid = $colsfid;
        $storedusername = $colusername;
        $storedpassword = $colpassword;
        $storedfirstname = $colfirstname;
        $storedmidname = $colmidname;
        $storedlastname = $collastname;
        $storedgender = $colgender;
        $storedbloodgroup = str_replace(['p', 'n'], ['+', '-'], $colbloodgroup);
        $storeddob = $coldob;
        $storedage = $colage;
        $storedmartialstatus = $colmartialstatus;
        $storedreligion = $colreligion;
        $storedcommunity = $colcommunity;
        $storedcaste = $colcaste;
        $storedmobcode = trim($colmobcode);
        $storedmobno = $colmobno;
        $storedinstaid = $colinstaid;
        $storeddoorno = $coldoorno;
        $storedstreet = $colstreet;
        $storedarea = $colarea;
        $storedcity = $colcity;
        $storedpincode = $colpincode;
        $storedstate = $colstate;
        $storedcountry = $colcountry;
        $storednationality = $colnationality;
        $storednative = $colnative;
        $storedschool = $colschool;
        $storedhighestqualification = $colhighestqualification;
        $storedcollege = $colcollege;
        $storedjob = $coljob;
        $storedannualincome = $colannualincome;
        $storedfathersname = $colfathersname;
        $storedmothersname = $colmothersname;
        $storedsiblingno = $colsiblingno;
        $storedsmoking = $colsmoking;
        $storedhobbies = $colhobbies;
        $storeddietarypref = $coldietarypref;
        $storedpartneragerange = $colpartneragerange;
        $storedpartnerageend = $colpartnerageend;
        $storedpartnereduucation = $colpartnereduucation;
        $storedpartnerjob = $colpartnerjob;
        $storedpartneranincome = $colpartneranincome;
        $storedpartnerincomeend = $colpartnerincomeend;
        $storedotherpref = $colotherpref;
        $storedhoroscope = $colhoroscope;
        $storedabouturself = $colabouturself;
        $storedphoto = $colphoto;
        $storedphototype = $colphototype;
        $name;
        if($storedmidname==""){
            $name=$storedfirstname." ".$storedlastname;
        }
        else{
            $name=$storedfirstname." ".$storedmidname." ".$storedlastname; 
        }
        $streetaddress;
        if($storedstreet==""){
            $streetaddress=$storedarea;
        }   
        else{
            $streetaddress=$storedstreet.", ".$storedarea;
        }
    }
}
else{
    die("Statement preparation failed:".mysqli_error($conn));
}
mysqli_stmt_free_result($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<?php
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
    mysqli_stmt_bind_result($stmt, $realcolphoto, $realcolphototype);
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/project_00/icons8-chatbot-32.ico" type="image/x-icon">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
                            <a href="intro.php" class="list-group-item list-group-item-action active" aria-current="true">Home</a>
                            <a href="about.php" class="list-group-item list-group-item-action">About us</a>
                            <a href="search.php" class="list-group-item list-group-item-action">Search</a>
                        </div>
                        <hr class="my-3 mx-0">
                        <div class="list-group">
                            <a href="editprofile/editprofile.php" class="list-group-item list-group-item-action">Edit Profile</a>
                        </div>
                    </div>
                </div>
            <!--offcanvas-->
            </div>
        </div>
    </div>
    <div class="container-fluid p-3" style="flex-grow:1">
        <div class="row h-100 m-0 justify-content-center">
            <div class="col-12 p-0">
                <div class="row h-100 m-0">
                    <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 col-12 p-1 d-flex flex-column">
                        <div class="card" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-sm-6 col-12">
                                    <img src="<?php echo $photoUrl ?>" class="img-fluid myrounded" alt="...">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3 mt-1"><b><?php echo $name ?></b></h6>
                                        <div class="row m-0">
                                            <div class="col-12 p-0"><p class="card-text mb-2"><b>Safari-ID:</b> <?php echo $storedsfid ?></p></div>
                                            <div class="col-12 p-0"><p class="card-text mb-2"><b>Profession:</b> <?php echo $storedjob ?></p></div>
                                            <div class="col-12 p-0"><p class="card-text mb-2"><b>Martial Status:</b> <?php echo $storedmartialstatus ?></p></div>
                                            <div class="col-12 p-0"><p class="card-text mb-2"><b>Age:</b> <?php echo $storedage ?></p></div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-6 col-md-4 col-sm-12 col-12 p-0 d-flex flex-column">
                        <div class="row m-0" style="flex-grow:1">
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-6 col-12 p-1">
                                <div class="card h-100">
                                    <div class="row g-0">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4"><b>Personal Information</b><svg class="ms-1 mb-1" fill="orange" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18" viewBox="0 0 26 26"><path d="M 16.5625 15.898438 C 16.402344 15.847656 15.398438 15.394531 16.027344 13.484375 L 16.019531 13.484375 C 17.65625 11.800781 18.90625 9.085938 18.90625 6.414063 C 18.90625 2.308594 16.175781 0.15625 13 0.15625 C 9.824219 0.15625 7.109375 2.308594 7.109375 6.414063 C 7.109375 9.097656 8.351563 11.820313 10 13.503906 C 10.640625 15.1875 9.492188 15.8125 9.253906 15.898438 C 5.929688 17.101563 2.03125 19.292969 2.03125 21.457031 C 2.03125 22.039063 2.03125 21.6875 2.03125 22.269531 C 2.03125 25.214844 7.742188 25.886719 13.03125 25.886719 C 18.328125 25.886719 23.96875 25.214844 23.96875 22.269531 C 23.96875 21.6875 23.96875 22.039063 23.96875 21.457031 C 23.96875 19.230469 20.050781 17.054688 16.5625 15.898438 Z"></path></svg></h5>
                                                <div class="row m-0">
                                                    <div class="col-xl-5 col-lg-5 px-1 p-0"><p class="card-text mb-2"><b>Blood Group:</b> <?php echo $storedbloodgroup ?></p></div>
                                                    <div class="col-xl-7 col-lg-7 px-1 p-0"><p class="card-text mb-2"><b>Date of Birth:</b> <?php echo $storeddob ?></p></div>
                                                    <div class="col-xl-5 col-lg-5 px-1 p-0"><p class="card-text mb-2"><b>Gender:</b> <?php echo $storedgender ?></p></div>
                                                    <div class="col-xl-7 col-lg-7 px-1 p-0"><p class="card-text mb-2"><b>Religion:</b> <?php echo $storedreligion." - ".$storedcommunity ?></p></div>
                                                    <div class="col-xl-12 col-lg-12 px-1 p-0"><p class="card-text mb-2"><b>Caste:</b> <?php echo $storedcaste ?></p></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-sm-6 col-12 d-xl-block d-lg-block d-md-none d-sm-block d-block p-1">
                                <div class="card h-100">
                                    <div class="row g-0">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4"><b>Contact Details</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/ios-filled/50/shake-phone.png" alt="shake-phone"/></h5>
                                                <div class="row m-0">
                                                    <div class="col-12 col-12 px-1 p-0"><p class="card-text mb-2"><b>Email ID:</b> <?php echo $storedusername ?></p></div>                                                    
                                                    <div class="col-12 col-12 px-1 p-0"><p class="card-text mb-2"><b>Instagram ID:</b> <?php echo $storedinstaid ?></p></div>                                                    
                                                    <div class="col-12 col-12 px-1 p-0"><p class="card-text mb-2"><b>Mobile number:</b> <?php echo "+".$storedmobcode."-".$storedmobno ?></p></div>                                                    
                                                </div>                                                                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6 col-12 d-xl-block d-lg-none d-md-none d-sm-block d-block p-1">
                                <div class="card h-100">
                                    <div class="row g-0">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4"><b>Educational Qualifications</b><img class="ms-2 mb-1" width="20" height="20" src="https://img.icons8.com/ios-filled/50/20C965/graduation-cap.png" alt="graduation-cap"/></h5>
                                                <div class="row m-0">
                                                    <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>School:</b> <?php echo $storedschool ?></p></div>
                                                    <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>College:</b> <?php echo $storedcollege ?></p></div>
                                                    <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Highest Qualification:</b> <?php echo $storedhighestqualification ?></p></div>
                                                </div>        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6 col-12 d-xl-block d-lg-none d-md-none d-sm-block d-block p-1">
                                <div class="card h-100">
                                    <div class="row g-0">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4"><b>Family & Income</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/fluency/48/family.png" alt="family"/></h5>
                                                <div class="row m-0">
                                                    <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Father:</b> <?php echo $storedfathersname ?></p></div>
                                                    <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Mother:</b> <?php echo $storedmothersname ?></p></div>
                                                    <div class="col-xl-5 col-lg-5 p-0 px-1"><p class="card-text mb-2"><b>No. of siblings:</b> <?php echo $storedsiblingno ?></p></div>
                                                    <div class="col-xl-7 col-lg-7 p-0 px-1"><p class="card-text mb-2"><b>Annual Income:</b> &#8377;<?php echo $storedannualincome ?></p></div>
                                                </div>                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-xl-none d-lg-none d-md-block d-sm-none d-none p-1 d-flex flex-column">
                        <div class="card h-100" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4"><b>Contact Details</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/ios-filled/50/shake-phone.png" alt="shake-phone"/></h5>
                                        <div class="row m-0">
                                            <div class="col-12 col-12 px-1 p-0"><p class="card-text mb-2"><b>Email ID:</b> <?php echo $storedusername ?></p></div>                                                                                       
                                            <div class="col-12 col-12 px-1 p-0"><p class="card-text mb-2"><b>Instagram ID:</b> <?php echo $storedinstaid ?></p></div>                                                                                        
                                            <div class="col-12 col-12 px-1 p-0"><p class="card-text mb-2"><b>Mobile number:</b> <?php echo "+".$storedmobcode."-".$storedmobno ?></p></div>                                        
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 d-xl-none d-lg-block d-md-block d-sm-none d-none p-1 d-flex flex-column">
                        <div class="card h-100" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4"><b>Educational Qualifications</b><img class="ms-2 mb-1" width="20" height="30" src="https://img.icons8.com/ios-filled/50/20C965/graduation-cap.png" alt="graduation-cap"/></h5>
                                        <div class="row m-0">
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>School:</b> <?php echo $storedschool ?></p></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>College:</b> <?php echo $storedcollege ?></p></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Highest Qualification:</b> <?php echo $storedhighestqualification ?></p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 d-xl-none d-lg-block d-md-block d-sm-none d-none p-1 d-flex flex-column">
                        <div class="card h-100" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-12">
                                    <div class="card-body">
                                    <h5 class="card-title mb-4"><b>Family & Income</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/fluency/48/family.png" alt="family"/></h5>
                                        <div class="row m-0">
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Father:</b> <?php echo $storedfathersname ?></p></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Mother:</b> <?php echo $storedmothersname?></p></div>
                                            <div class="col-xl-5 col-lg-5 p-0 px-1"><p class="card-text mb-2"><b>No. of siblings:</b> <?php echo $storedsiblingno ?></p></div>
                                            <div class="col-xl-7 col-lg-7 p-0 px-1"><p class="card-text mb-2"><b>Annual Income:</b> &#8377;<?php echo $storedannualincome ?>
                                        </p></div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 p-1 d-flex flex-column">
                        <div class="card" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4"><b>Residential Address</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/sf-regular-filled/48/9B3EE8/home-page.png" alt="home-page"/></h5>
                                        <div class="row m-0">
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><?php echo $storeddoorno."," ?></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><?php echo $streetaddress."," ?></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><?php echo $storedcity." - ".$storedpincode."," ?></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><?php echo $storedstate.", ".$storedcountry ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 p-1 d-flex flex-column">
                        <div class="card" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4"><b>Origin & Lifestyle</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/ios-filled/50/A72B2B/country.png" alt="country"/></h5>
                                        <div class="row m-0">
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Native:</b> <?php echo $storednative ?></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Nationality:</b> <?php echo $storednationality ?></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Dietary preferances:</b> <?php echo $storeddietarypref ?></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Smoking & Drinking:</b> <?php echo $storedsmoking ?></div>                                                                            
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Horoscope:</b> <?php echo $storedhoroscope ?></div>                                                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 p-1 d-flex flex-column">
                        <div class="card" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4"><b>Partner Preferences</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/color-glass/48/filled-heart.png" alt="filled-heart"/></h5>
                                        <div class="row m-0">
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Age:</b> <?php echo $storedpartneragerange." to ".$storedpartnerageend ?></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Education:</b> <?php echo $storedpartnereduucation ?></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Profession:</b> <?php echo $storedpartnerjob ?></div>
                                            <div class="col-12 p-0 px-1"><p class="card-text mb-2"><b>Annual Income:</b> &#8377;<?php echo $storedpartneranincome." to " ?>&#8377;<?php echo $storedpartnerincomeend ?></div>                                                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 p-1 d-flex flex-column">
                        <div class="card" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Interests</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/ios-filled/50/2BA78D/drawing.png" alt="drawing"/></h5>
                                        <p class="card-text"><?php echo $storedhobbies ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 p-1 d-flex flex-column">
                        <div class="card" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Whom do I like?</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/ios-filled/48/B57029/thinking-bubble.png" alt="thinking-bubble"/></h5>
                                        <p class="card-text"><?php echo $storedotherpref ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 p-1 d-flex flex-column">
                        <div class="card" style="flex-grow:1">
                            <div class="row h-100 g-0">
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Whom am I?</b><img class="ms-1 mb-1" width="20" height="20" src="https://img.icons8.com/flat-round/64/D32573/question-mark.png" alt="question-mark"/></h5>
                                        <p class="card-text"><?php echo $storedabouturself ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>