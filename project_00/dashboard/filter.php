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
    <title>Filtered Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>@import url('https://fonts.googleapis.com/css2?family=Mooli&family=Yatra+One&display=swap');</style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
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
                            <a href="intro.php" class="list-group-item list-group-item-action" aria-current="true">Home</a>
                            <a href="about.php" class="list-group-item list-group-item-action">About us</a>
                            <a href="search.php" class="list-group-item list-group-item-action">Search</a>                        
                        </div>
                        <hr class="my-3 mx-0">
                        <div class="list-group">
                            <button class="list-group-item list-group-item-action" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Filter results</button>
                            <a href="search.php" class="removebtn list-group-item list-group-item-action">Remove filters</a>
                        </div>
                    </div>
                </div>
            <!--offcanvas-->
            <!-- filter offcanvas -->
            <form id="filterform">
                <div class="offcanvas offcanvas-bottom f-canvas" data-bs-scroll="true" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                    <div class="offcanvas-header mt-2 pb-0">
                        <div class="row m-0 w-100 d-flex justify-content-between align-items-center">
                            <div class="col-6 p-0 d-flex justify-content-start align-items-center">
                                <h4 class="fhead mt-1"><b>Filter your result</b></h4>
                            </div>
                            <div class="col-6 p-0 d-flex justify-content-end">
                                <button type="reset" id="clearbutton" class="btn myclrbtn me-2 fbtn fbtntxt">Clear</button>
                                <button type="submit" class="btn mybtn fbtn fbtntxt" id="filterapply">Apply filters</button>
                            </div>
                            <div class="col-12 p-0">
                                <hr class="mt-3 m-0">
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-body pt-0">                        
                        <div class="row mt-3 m-0 d-flex justify-content-center">
                            <div class="col-12 p-0">
                                <div class="row m-0">
                                    <div class="col-lg-4 col-sm-6 p-0 px-2 mb-3">
                                        <div class="form-group">
                                            <label for="filterid" class="form-label"><b>Safari-ID:</b></label>
                                            <input type="number" class="form-control mb-1" id="filterid" name="filterid" placeholder="If ID is used other filters doesn't work" value="">                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 p-0 px-2 mb-3">
                                        <div class="form-group">
                                            <label for="filterreligion" class="form-label"><b>Religion:</b></label>
                                            <select class="form-select" id="filterreligion">
                                                <option selected value="">Select a religion</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Muslim">Muslim</option>
                                                <option value="Christian">Christian</option>
                                                <option value="Sikhism">Sikhism</option>
                                                <option value="Buddhism">Buddhism</option>
                                                <option value="Jainism">Jainism</option>
                                            </select>                                                
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 p-0 px-2 mb-3">
                                        <div class="form-group">
                                            <label for="filtercommunity" class="form-label"><b>Community:</b></label>
                                            <select class="form-select" id="filtercommunity">
                                                <option selected value="">Select a community</option>
                                                <option value="OC">OC</option>
                                                <option value="FC">FC</option>
                                                <option value="BC">BC</option>
                                                <option value="MBC">MBC</option>
                                                <option value="SC">SC</option>
                                                <option value="ST">ST</option>
                                            </select>                                                
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 p-0 px-2 mb-3">
                                        <div class="form-group">
                                            <label for="filtercaste" class="form-label"><b>Caste:</b></label>
                                            <select class="form-select" id="filtercaste">
                                                <option selected value="">Select a caste</option>
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
                                    </div>
                                    <div class="col-lg-4 col-sm-6 p-0 px-2 mb-3">
                                        <div class="form-group">
                                            <label for="filternationality" class="form-label"><b>Nationality:</b></label>
                                            <select class="form-select" id="filternationality">
                                                <option selected value="">Select a nationality</option>
                                                <option value="Indian">Indian</option>
                                                <option value="Foreign">Foreign</option>
                                            </select>                                                
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 p-0 px-2 mb-3">
                                        <div class="form-group">
                                            <label for="filterhoroscope" class="form-label"><b>Horoscope:</b></label>
                                            <select class="form-select" id="filterhoroscope">
                                                <option selected value="">Select a horoscope</option>
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
                                    </div>
                                    <div class="col-lg-4 col-sm-6 p-0 px-2 mb-1">
                                        <div class="form-group">
                                            <div class="row m-0">
                                                <div class="col-12 p-0">
                                                    <label for="filterage" class="form-label"><b>Prefered partner's age range:</b></label>
                                                </div>                                                    
                                                <div class="col-6 p-0 text-start">
                                                    <p class="m-0 smtxt">20</p>
                                                </div>
                                                <div class="col-6 p-0 text-end">
                                                    <p class="m-0 smtxt">40</p>
                                                </div>
                                                <div class="col-12 p-0">
                                                    <input type="range" class="form-range-control w-100" id="filteragestart" name="filteragestart" min="20" max="40" value="25">
                                                </div>
                                                <div class="col-6 p-0 text-start">
                                                    <p class="m-0 smtxt">20</p>
                                                </div>
                                                <div class="col-6 p-0 text-end">
                                                    <p class="m-0 smtxt">40</p>
                                                </div>
                                                <div class="col-12 p-0">
                                                    <input type="range" class="form-range-control w-100" id="filterageend" name="filterageend" min="20" max="40" value="35">
                                                </div>
                                                <div class="col-12 p-0 d-flex justify-content-end" id="agediv">
                                                    <p class="m-0 mb-1" id="startage"><b>25</b></p><p class="m-0 mt-1 mx-1" style="font-size:10px;"><b>to</b></p><p class="m-0 mb-1" id="endage"><b>35</b></p><p class="m-0 ms-1" style="font-size:12px; margin-top: 2px !important;"><b>years old</b></p>
                                                </div>                       
                                            </div>                                                                                               
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 p-0 px-2 mb-1">
                                        <div class="form-group">
                                            <div class="row m-0">
                                                <div class="col-12 p-0">
                                                    <label for="filterincome" class="form-label"><b>Prefered partner's income range:</b></label>
                                                </div>
                                                <div class="col-6 p-0 text-start">
                                                    <p class="m-0 smtxt">100000</p>
                                                </div>
                                                <div class="col-6 p-0 text-end">
                                                    <p class="m-0 smtxt">5000000</p>
                                                </div>
                                                <div class="col-12 p-0">
                                                    <input type="range" class="form-range-control w-100" id="filterincomestart" name="filteincomestart" min="100000" max="5000000" value="400000" step="100000">
                                                </div>                                                   
                                                <div class="col-6 p-0 text-start">
                                                    <p class="m-0 smtxt">100000</p>
                                                </div>
                                                <div class="col-6 p-0 text-end">
                                                    <p class="m-0 smtxt">5000000</p>
                                                </div>
                                                <div class="col-12 p-0">
                                                    <input type="range" class="form-range-control w-100" id="filterincomeend" name="filteincomeend" min="100000" max="5000000" value="1200000" step="100000">
                                                </div>
                                                <div class="col-12 p-0 d-flex justify-content-end" id="incomediv">
                                                    <p class="m-0 mb-1 me-1"><b>&#8377;</b></p><p class="m-0 mb-1" id="startincome"><b>400000</b></p><p class="m-0 mt-1 mx-1" id="to" style="font-size:10px;"><b>to</b></p><p class="m-0 mb-1 me-1" id="startincome"><b>&#8377;</b></p><p class="m-0 mb-1" id="endincome"><b>1200000</b></p>
                                                </div>
                                            </div>                                                                                               
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 p-0 px-2 mb-3">
                                        <div class="form-group">
                                            <label for="filtergender" class="form-label"><b>Gender:</b></label>
                                            <select class="form-select" id="filtergender">
                                                <option selected value="">Select a gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                      
                    </div>
                </div>
            </form>
            <!-- filter offcanvas -->
            </div>
        </div>
    </div>
    <div class="container-fluid p-3" style="flex-grow:1">
    <div class="row h-100 m-0 justify-content-center">
        <div class="col-12 p-0">
            <div class="row h-100 m-0" id="searchdiv">
                <?php
                $sfid = $_GET['sfid'];
                $religion = $_GET['religion'];
                $community = $_GET['community'];
                $caste = $_GET['caste'];
                $nationality = $_GET['nationality'];
                $horoscope = $_GET['horoscope'];
                $gender = $_GET['gender'];
                $incstart = $_GET['incstart'];
                $incend = $_GET['incend'];
                $agestart = $_GET['agestart'];
                $ageend = $_GET['ageend'];
                //conn
                $dbhostname="localhost";
                $dbusername="root";
                $dbpassword="";
                $dbname="practise_login";
                $conn=mysqli_connect($dbhostname,$dbusername,$dbpassword,$dbname);
                if(!$conn){
                    die("Connection failed:".mysqli_connect_error());
                }
                $sql="SELECT `sfid`,`firstname`,`midname`,`lastname`,`job`,`martialstatus`,`age`,`photo` ,`photoType` FROM `login` WHERE 1";
                if($sfid==""){
                    if ($religion !== '') {
                        $sql .= " AND `religion` = '$religion'";
                    }
                    if ($community !== '') {
                        $sql .= " AND `community` = '$community'";
                    }
                    if ($caste !== '') {
                        $sql .= " AND `caste` = '$caste'";
                    }
                    if ($nationality !== '') {
                        $sql .= " AND `nationality` = '$nationality'";
                    }
                    if ($gender !== '') {
                        $sql .= " AND `gender` = '$gender'";
                    }
                    if ($incstart !== '') {
                        $sql .= " AND `annualincome` >= '$incstart'";
                    }
                    if ($incend !== '') {
                        $sql .= " AND `annualincome` <= '$incend'";
                    }
                    if ($agestart !== '') {
                        $sql .= " AND `age` >= '$agestart'";
                    }
                    if ($ageend !== '') {
                        $sql .= " AND `age` <= '$ageend'";
                    }
                }
                else{
                    $sql .= " AND `sfid` = '$sfid'";
                    $variables = [
                        'religion','community','caste','nationality','horoscope','gender'];
                    foreach($variables as $variable){
                        ${$variable} = "";
                    }
                };
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                }
                if($result){
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                            $storedsfid = $row['sfid'];
                            $storedfirstname = $row['firstname'];
                            $storedmidname = $row['midname'];
                            $storedlastname = $row['lastname'];
                            $storedage = $row['age'];
                            $storedmartialstatus = $row['martialstatus'];
                            $storedjob = $row['job'];
                            $bfrimageData = $row['photo'];
                            $imageType = $row['photoType'];
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
                                                        <div class="col-12 p-0"><p class="card-text mb-4" style="color: #ff1493;"><b>Interests:</b> 0</p></div>
                                                        <div class="col-12 p-0">
                                                            <div class="row p-0 m-0">
                                                                <div class="col-12 mb-0 p-0 px-2"><p class="card-text mb-2"><button id="check'.$storedsfid.'" type="button" class="btn chkbtn btn-sm mybtn px-1 w-100">Check in</button></div>
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
                        echo '
                            <div class="col-12 p-3 d-flex flex-column">
                                <div class="card" style="flex-grow:1">
                                    <div class="row h-100 g-0">
                                        <div class="col-12 p-3 position-relative d-flex justify-content-center">
                                            <b>No Results Found!</b>
                                        </div>
                                    </div>
                                </div>
                            </div>'; 
                    }
                    
                }
                else{
                    die("Statement preparation failed:".mysqli_error($conn));
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="script.js"></script>
    <script>
        $(document).ready(function(){
            $("#clearbutton").click(function(){
                $("#incomediv").html("<p class='m-0 mb-1 me-1'><b>&#8377;</b></p><p class='m-0 mb-1' id='startincome'><b>400000</b></p><p class='m-0 mt-1 mx-1' id='to' style='font-size:10px;'><b>to</b></p><p class='m-0 mb-1 me-1' id='startincome'><b>&#8377;</b></p><p class='m-0 mb-1' id='endincome'><b>1200000</b></p>");
                $("#agediv").html("<p class='m-0 mb-1' id='startage'><b>25</b></p><p class='m-0 mt-1 mx-1' style='font-size:10px;''><b>to</b></p><p class='m-0 mb-1' id='endage'><b>35</b></p><p class='m-0 ms-1' style='font-size:12px; margin-top: 2px !important;''><b>years old</b></p>");
                $("#incomediv,#agediv").removeClass("invalid-feedback");
                $("#incomediv,#agediv").removeClass("justify-content-start");
                $("#incomediv,#agediv").addClass("justify-content-end");
                document.getElementById("filterapply").disabled=false;
            });
            $("#filterid").val("<?php echo $sfid?>");
            $("#filterreligion").val("<?php echo $religion?>");
            $("#filtercommunity").val("<?php echo $community?>");
            $("#filtercaste").val("<?php echo $caste?>");
            $("#filterhoroscope").val("<?php echo $horoscope?>");
            $("#filterincomestart").val("<?php echo $incstart?>");
            $("#filterincomeend").val("<?php echo $incend?>");
            $("#filteragestart").val("<?php echo $agestart?>");
            $("#filterageend").val("<?php echo $ageend?>");
            $("#filtergender").val("<?php echo $gender?>");
        });
    </script>
</body>
</html>