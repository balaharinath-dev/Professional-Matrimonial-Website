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
        $storedbloodgroup = str_replace(['+', '-'], ['p', 'n'], $colbloodgroup);
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
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <div class="offcanvas overflow-y-auto offcanvas-start s-canvas" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
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
                            <a href="editprofile.php" class="list-group-item list-group-item-action active">Edit Profile</a>
                        </div>
                        <hr class="my-3 mx-0">
                        <div>
                            <button class="btn mydropbtn dropdown-toggle" id="dropbtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">Navigate to </button>
                            <ul class="dropdown-menu p-0 rounded" style="z-index: 500;">
                                <div id="list-example" class="list-group rounded">
                                    <li class="close"><a class="px-2 list-group-item dropdown-item list-group-item-action" href="#list-item-1">Personal details</a></li>
                                    <li class="close"><a class="px-2 list-group-item dropdown-item list-group-item-action" href="#list-item-2">Contact details</a></li>
                                    <li class="close"><a class="px-2 list-group-item dropdown-item list-group-item-action" href="#list-item-3">Education & Profession</a></li>
                                    <li class="close"><a class="px-2 list-group-item dropdown-item list-group-item-action" href="#list-item-4">Hobbies & Interests</a></li>
                                    <li class="close"><a class="px-2 list-group-item dropdown-item list-group-item-action" href="#list-item-5">Partner Preference</a></li>
                                </div>
                            </ul>
                        </div>                              
                    </div>
                </div>
            <!--offcanvas-->
            </div>
        </div>
    </div>
    <div class="container-fluid p-sm-4 p-3" style="flex-grow:1">
        <div class="row m-0">
            <div class="col-12 mycontainer-fluid p-sm-3 p-1 py-4">
                <div class="row m-0">
                    <div class="col-12 p-0 px-3 d-flex mb-sm-2 mb-sm-1 mb-2 justify-content-start align-items-center">
                        <span class="signhead"><b>Edit profile </b></span>                        
                    </div> 
                    <form id="editprof">
                        <div class="row m-0 mt-3 scrollspy-example" tabindex="0" data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true">
                            <div class="col-12 p-0 px-2 mb-md-2 mb-4"><h4 id="list-item-1"><b>Personal details</b></h4></div>
                            <div class="col-12 p-0 mb-3 d-flex justify-content-center">
                                <div style="height: 100px; width: 100px; border-radius:50%; border: 1px solid black;" class="d-flex justify-content-center align-items-center">
                                    <img src="<?php echo $photoUrl ?>" id="disimg" class="img-fluid w-100 h-100" style="border-radius:50%;">
                                </div>
                            </div>
                            <div class="col-12 p-0 px-2 mb-3 d-flex justify-content-center">
                                <div class="form-group">
                                    <input class="form-control" type="file" id="photo" name="photo">
                                    <div class="invalid-feedback d-block" style="overflow-x: hidden;" id="photodiv"></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo $storedfirstname; ?>">
                                    <label class="form-floating-label" for="fname">First Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="fnamediv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="mname" name="mname" placeholder="Middle Name"  value="<?php echo $storedmidname; ?>">
                                    <label class="form-floating-label" for="mname">Middle Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="mnamediv"></div>
                            </div> 
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name"  value="<?php echo $storedlastname; ?>">
                                    <label class="form-floating-label" for="lname">Last Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="lnamediv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="faname" name="faname" placeholder="Father's Name" value="<?php echo $storedfathersname; ?>">
                                    <label class="form-floating-label" for="faname">Father's Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="fanamediv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="moname" name="moname" placeholder="Mother's Name" value="<?php echo $storedmothersname; ?>">
                                    <label class="form-floating-label" for="moname">Mother's Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="monamediv"></div>
                            </div> 
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="number" id="siblings" name="siblings" placeholder="Number of Siblings" value="<?php echo $storedsiblingno; ?>">
                                    <label class="form-floating-label" for="siblings">Number of Siblings</label>
                                </div>
                                <div class="valid-feedback d-block" id="siblingsdiv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select class="form-select" id="horoscope" name="horoscope">
                                        <option selected value="">Horoscope</option>
                                        <option value="Aries (Mesham)">Aries (Mesham)</option>
                                        <option value="Taurus (Rishabam)">Taurus (Rishabam)</option>
                                        <option value="Gemini (Mithunam)">Gemini (Mithunam)</option>
                                        <option value="Cancer (Katakam)">Cancer (Katakam)</option>
                                        <option value="Leo (Simham)">Leo (Simham)</option>
                                        <option value="Virgo (Kanni)">Virgo (Kanni)</option>
                                        <option value="Libra (Thulam)">Libra (Thulam)</option>
                                        <option value="Scorpio (Vrischikam)">Scorpio (Vrischikam)</option>
                                        <option value="Sagittarius (Dhanusu)">Sagittarius (Dhanusu)</option>
                                        <option value="Capricorn (Makaram)">Capricorn (Makaram)</option>
                                        <option value="Aquarius (Kumbham)">Aquarius (Kumbham)</option>
                                        <option value="Pisces (Meenam)">Pisces (Meenam)</option>
                                    </select>                                                
                                </div>
                                <div class="valid-feedback d-block" id="horoscopediv"></div>
                            </div>                           
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select class="form-select" id="martialstatus" name="martialstatus">
                                        <option selected value="">Martial Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Complicated">Complicated</option>
                                    </select>
                                </div>
                                <div class="valid-feedback d-block" id="martialstatusdiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select name="bloodgrp" id="bloodgrp" class="form-select">
                                        <option selected value="">Bloodgroup</option>
                                        <option value="Apve">A+ve</option>
                                        <option value="Anve">A-ve</option>
                                        <option value="Bpve">B+ve</option>
                                        <option value="Bnve">B-ve</option>
                                        <option value="ABpve">AB+ve</option>
                                        <option value="ABnve">AB-ve</option>
                                        <option value="Opve">O+ve</option>
                                        <option value="Onve">O-ve</option>
                                    </select>
                                </div>
                                <div class="valid-feedback d-block" id="bloodgrpdiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select class="form-select" id="religion">
                                        <option selected value="">Religion</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Muslim">Muslim</option>
                                        <option value="Christian">Christian</option>
                                        <option value="Sikhism">Sikhism</option>
                                        <option value="Buddhism">Buddhism</option>
                                        <option value="Jainism">Jainism</option>
                                    </select>                                                
                                </div>
                                <div class="valid-feedback d-block" id="religiondiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select class="form-select" id="community">
                                        <option selected value="">Community</option>
                                        <option value="OC">OC</option>
                                        <option value="FC">FC</option>
                                        <option value="BC">BC</option>
                                        <option value="MBC">MBC</option>
                                        <option value="SC">SC</option>
                                        <option value="ST">ST</option>
                                    </select>                                                
                                </div>
                                <div class="valid-feedback d-block" id="communitydiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select class="form-select" id="caste">
                                        <option selected value="">Caste</option>
                                        <option value="Adi dravidar">Adi Dravidar</option>
                                        <option value="Pillai">Pillai</option>
                                        <option value="Gounder">Gounder</option>
                                        <option value="Vellalar">Vellalar</option>
                                        <option value="Nadar">Nadar</option>
                                        <option value="Thevar">Thevar</option>
                                        <option value="Chettiar">Chettiar</option>
                                        <option value="Mudaliar">Mudaliar</option>
                                        <option value="Iyengar">Iyengar</option>
                                        <option value="Iyer">Iyer</option>
                                        <option value="Kongu vellala gounder">Kongu Vellala Gounder</option>
                                        <option value="Vanniyar">Vanniyar</option>
                                        <option value="Naicker">Naicker</option>
                                        <option value="Kallar">Kallar</option>
                                        <option value="Arunthathiyar">Arunthathiyar</option>
                                        <option value="Maravar">Maravar</option>
                                        <option value="Boyer">Boyer</option>
                                        <option value="Kammalar">Kammalar</option>
                                        <option value="Mukkulathor">Mukkulathor</option>
                                        <option value="Velama">Velama</option>
                                    </select>                                                
                                </div>
                                <div class="valid-feedback d-block" id="castediv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select class="form-select" id="gender">
                                        <option selected value="">Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="valid-feedback d-block" id="genderdiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="number" id="age" name="age" placeholder="Age" value="<?php echo $storedage; ?>">
                                    <label class="form-floating-label" for="age">Age</label>
                                </div>
                                <div class="valid-feedback d-block" id="agediv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <div class="row m-0 border p-3 rounded" id="maindate" style="background-color: white;">
                                        <div class="col-xl-7 col-md-6 p-0 d-flex align-items-center"><label for="date" class="form-label mb-0">Date of Birth</label></div>
                                        <div class="col-xl-5 col-md-6 p-0 dateinp"><input class="form-control border border-0 p-0 datetext" type="date" value="<?php echo $storeddob; ?>" id="date"></div>
                                    </div>
                                </div>
                                <div class="valid-feedback d-block" id="datediv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-5" style="flex-grow: 1;">
                                <textarea style="padding: 10px;" class="form-control" name="yourself" id="yourself" cols="30" rows="5" placeholder="About yourself"></textarea>
                                <div class="valid-feedback d-block" id="yourselfdiv"></div>
                            </div>
                            <hr class="mt-1 mb-5 mx-0">
                            <div class="col-12 p-0 px-2 mb-2"><h4 id="list-item-2"><b>Contact details</b></h4></div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="door" name="door" placeholder="Door number" value="<?php echo $storeddoorno; ?>">
                                    <label class="form-floating-label" for="door">Door number</label>
                                </div>
                                <div class="valid-feedback d-block" id="doordiv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="street" name="street" placeholder="Street name" value="<?php echo $storedstreet; ?>">
                                    <label class="form-floating-label" for="street">Street name</label>
                                </div>
                                <div class="valid-feedback d-block" id="streetdiv"></div>
                            </div> 
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="area" name="area" placeholder="Area Name" value="<?php echo $storedarea; ?>">
                                    <label class="form-floating-label" for="area">Area Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="areadiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="city" name="city" placeholder="City" value="<?php echo $storedcity; ?>">
                                    <label class="form-floating-label" for="city">City</label>
                                </div>
                                <div class="valid-feedback d-block" id="citydiv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="number" id="pincode" name="pincode" placeholder="Pincode" value="<?php echo $storedpincode; ?>">
                                    <label class="form-floating-label" for="pincode">Pincode</label>
                                </div>
                                <div class="valid-feedback d-block" id="pincodediv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="native" name="native" placeholder="Native" value="<?php echo $storednative; ?>">
                                    <label class="form-floating-label" for="native">Native</label>
                                </div>
                                <div class="valid-feedback d-block" id="nativediv"></div>
                            </div>                           
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select class="form-select" id="state" name="state">
                                        <option selected value="">State</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                                        <option value="Lakshadweep">Lakshadweep</option>
                                        <option value="Delhi (National Capital Territory of Delhi)">Delhi (National Capital Territory of Delhi)</option>
                                        <option value="Puducherry">Puducherry</option>
                                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                        <option value="Ladakh">Ladakh</option>
                                        <option value="Foreign state">Foreign state</option>
                                    </select>                                                
                                </div>
                                <div class="valid-feedback d-block" id="statediv"></div>
                            </div>                           
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select class="form-select" id="country" name="country">
                                        <option selected value="">Country</option>
                                        <option value="India">India</option>
                                        <option value="Foreign">Foreign</option>
                                    </select>
                                </div>
                                <div class="valid-feedback d-block" id="countrydiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <select class="form-select" id="nationality" name="nationality">
                                        <option selected value="">Nationality</option>
                                        <option value="Indian">Indian</option>
                                        <option value="Foreigner">Foreigner</option>
                                    </select>
                                </div>
                                <div class="valid-feedback d-block" id="nationalitydiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="insta" name="insta" placeholder="Instagram ID" value="<?php echo $storedinstaid; ?>">
                                    <label class="form-floating-label" for="insta">Instagram ID</label>
                                </div>
                                <div class="valid-feedback d-block" id="instadiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-5">
                                <div class="input-group">
                                    <select class="form-select mobcode" id="mobcode" name="mobcode">
                                        <option selected value="+91">+91</option>
                                        <option value="+1">+1</option>
                                        <option value="+44">+44</option>
                                        <option value="+86">+86</option>
                                        <option value="+49">+49</option>
                                        <option value="+33">+33</option>
                                        <option value="+81">+81</option>
                                        <option value="+7">+7</option>
                                        <option value="+61">+61</option>
                                        <option value="+55">+55</option>
                                    </select>
                                    <div class="form-floating" style="width: 60% !important;">
                                        <input type="text" class="form-control" id="mobno" name="mobno" placeholder="Mobile number" value="<?php echo $storedmobno; ?>">
                                        <label for="mobno" class="form-floating-label">Mobile number</label>
                                    </div>
                                </div>
                                <div class="valid-feedback d-block" id="mobnodiv"></div>
                            </div>
                            <hr class="mt-1 mb-5 mx-0">
                            <div class="col-12 p-0 px-2 mb-2"><h4 id="list-item-3"><b>Education & Profession</b></h4></div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="school" name="school" placeholder="School Name" value="<?php echo $storedschool; ?>">
                                    <label class="form-floating-label" for="school">School Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="schooldiv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="college" name="college" placeholder="College name" value="<?php echo $storedcollege; ?>">
                                    <label class="form-floating-label" for="college">College name</label>
                                </div>
                                <div class="valid-feedback d-block" id="collegediv"></div>
                            </div> 
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="highqual" name="highqual" placeholder="Highest Qualification" value="<?php echo $storedhighestqualification; ?>">
                                    <label class="form-floating-label" for="highqual">Highest Qualification</label>
                                </div>
                                <div class="valid-feedback d-block" id="highqualdiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="job" name="job" placeholder="Profession" value="<?php echo $storedjob; ?>">
                                    <label class="form-floating-label" for="job">Profession</label>
                                </div>
                                <div class="valid-feedback d-block" id="jobdiv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-5">
                                <div class="input-group">
                                    <label style="font-size: 22px;" class="input-group-text px-3" for="aincome">&#8377;</label>
                                    <div class="form-floating">
                                        <input class="form-control" type="number" id="aincome" name="aincome" placeholder="Annual Income" value="<?php echo $storedannualincome; ?>">
                                        <label class="form-floating-label" for="aincome">Annual Income</label>
                                    </div>
                                </div>
                                <div class="valid-feedback d-block" id="aincomediv"></div>                                
                            </div>
                            <hr class="mt-1 mb-5 mx-0">
                            <div class="col-12 p-0 px-2 mb-2"><h4 id="list-item-4"><b>Hobbies & Interests</b></h4></div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <select class="form-select" id="sd" name="sd">
                                    <option value="" selected>Smoking & Drinking</option>
                                    <option value="Often">Often</option>
                                    <option value="Weekly once">Weekly once</option>
                                    <option value="Monthly once">Monthly once</option>
                                    <option value="Scarcely">Scarcely</option>
                                    <option value="-NIL-">-NIL-</option>
                                </select>
                                <div class="valid-feedback d-block" id="sddiv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <select class="form-select" id="diet" name="diet">
                                    <option value="" selected>Dietary Preference</option>
                                    <option value="Vegetarian">Vegetarian</option>
                                    <option value="Vegan">Vegan</option>
                                    <option value="Pescatarian">Pescatarian</option>
                                    <option value="Gluten-free">Gluten-Free</option>
                                    <option value="Keto">Keto</option>
                                    <option value="-NIL-">-NIL-</option>
                                </select>
                                <div class="valid-feedback d-block" id="dietdiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-12 p-0 px-2 mb-5">
                                <textarea style="padding: 10px;" class="form-control" placeholder="Hobbies" name="hobby" id="hobby" cols="30" rows="5"></textarea>
                                <div class="valid-feedback d-block" id="hobbydiv"></div>
                            </div>
                            <hr class="mt-1 mb-5 mx-0">
                            <div class="col-12 p-0 px-2 mb-2"><h4 id="list-item-5"><b>Partner Preference</b></h4></div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="pjob" name="pjob" placeholder="Partner's Profession" value="<?php echo $storedpartnerjob; ?>">
                                    <label class="form-floating-label" for="pjob">Partner's Profession</label>
                                </div>
                                <div class="valid-feedback d-block" id="pjobdiv"></div>
                            </div>                          
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="peducate" name="peducate" placeholder="Partner's Education" value="<?php echo $storedpartnereduucation; ?>">
                                    <label class="form-floating-label" for="peducate">Partner's Education</label>
                                </div>
                                <div class="valid-feedback d-block" id="peducatediv"></div>
                            </div>
                            <div class="col-lg-4 col-md-12 p-0 px-2 mb-3">
                                <textarea class="form-control pt-3 pb-3" placeholder="Other prefernces" name="pref" id="pref" cols="30" rows="5"></textarea>
                                <div class="valid-feedback d-block" id="prefdiv"></div>
                            </div> 
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                  <div class="form-group">
                                    <label for="pincome" class="form-label">Partner Income range</label>
                                    <div class="input-group">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="pincstart" name="pincstart" placeholder="&#8377;" value="<?php echo $storedpartneranincome; ?>">
                                            <label class="form-floating-label" for="pincstart">&#8377;</label>
                                        </div>
                                        <label for="pincome" class="input-group-text">to</label>
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="pincend" name="pincend" placeholder="&#8377;" value="<?php echo $storedpartnerincomeend; ?>">
                                            <label class="form-floating-label" for="pincend">&#8377;</label>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="valid-feedback d-block" id="pincdiv"></div>                            
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-5">
                                  <div class="form-group">
                                    <label for="page" class="form-label">Partner Age range</label>
                                    <div class="input-group">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="pagestart" name="pagestart" placeholder="From" value="<?php echo $storedpartneragerange; ?>">
                                            <label class="form-floating-label" for="pagestart">From</label>
                                        </div>
                                        <label for="page" class="input-group-text">yrs</label>
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="pageend" name="pageend" placeholder="To" value="<?php echo $storedpartnerageend; ?>">
                                            <label class="form-floating-label" for="pageend">To</label>
                                        </div>
                                        <label for="page" class="input-group-text">yrs</label>
                                    </div>
                                  </div>
                                  <div class="valid-feedback d-block" id="pagediv"></div>                            
                            </div>
                            <div class="col-6 p-0 px-2 mb-3 d-flex justify-content-start align-items-center" style="flex-grow: 1;">
                                <a href="changepword.php" role="button" class="btn mybtn d-lg-block d-none prev5" value="prev5">Change Password</a>
                                <a href="changepword.php" role="button" class="btn btn-sm mybtn d-lg-none chpwordbtn d-block prev5 px-sm-2 px-1" value="prev5">Change Password</a>
                            </div>                          
                            <div class="col-6 p-0 px-2 mb-3 d-flex justify-content-end align-items-end" style="flex-grow: 1;">
                                <button type="submit" class="btn mybtn d-lg-block d-none next5">Update Profile</button>
                                <button type="submit" class="btn btn-sm mybtn d-lg-none d-block next5">Update Profile</button>  
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3 d-none">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header p-2">
                <img src="<?php echo $photoUrl; ?>" class="me-2" style="border-radius: 50%;" alt="...">
                <strong class="me-auto">Profile updated successfully</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="editprofile.js"></script>
    <script>
        $(document).ready(()=>{
            $("#horoscope").val("<?php echo $storedhoroscope; ?>");
            $("#martialstatus").val("<?php echo $storedmartialstatus; ?>");
            $("#bloodgrp").val("<?php echo $storedbloodgroup; ?>");
            $("#religion").val("<?php echo $storedreligion; ?>");
            $("#community").val("<?php echo $storedcommunity; ?>");
            $("#caste").val("<?php echo $storedcaste; ?>");
            $("#gender").val("<?php echo $storedgender; ?>");
            $("#state").val("<?php echo $storedstate; ?>");
            $("#country").val("<?php echo $storedcountry; ?>");
            $("#nationality").val("<?php echo $storednationality; ?>");
            $("#mobcode").val("<?php echo '+'.$storedmobcode; ?>");
            $("#yourself").val("<?php echo $storedabouturself; ?>");
            $("#sd").val("<?php echo $storedsmoking; ?>");
            $("#diet").val("<?php echo $storeddietarypref; ?>");
            $("#hobby").val("<?php echo $storedhobbies; ?>");
            $("#pref").val("<?php echo $storedotherpref; ?>");
        });
    </script>
</body>
</html> 