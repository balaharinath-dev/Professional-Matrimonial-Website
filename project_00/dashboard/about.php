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
    <title>About us</title>
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
                            <a href="intro.php" class="list-group-item list-group-item-action" aria-current="true">Home</a>
                            <a href="about.php" class="list-group-item list-group-item-action active">About us</a>
                            <a href="search.php" class="list-group-item list-group-item-action">Search</a>
                        </div>
                    </div>
                </div>
            <!--offcanvas-->
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row h-100 m-0 p-3 justify-content center">
            <div class="col-12 p-0">
                <div class="row m-0 align-items-strech">
                    <div class="col-lg-6 col-md-5 col-12 mb-xl-0 mb-lg-0 mb-md-0 mb-4 d-flex justify-content-center align-items-center p-0">
                        <div class="row m-0">
                            <div class="col-lg-12 p-0"><p class="desc1 m-0 d-flex justify-content-center align-items-center" style="font-family:'Yatra one' !important;"><b>Safari</b></p></div>
                            <div class="col-lg-12 p-0"><p class="desc2 m-0 mb-5 d-flex justify-content-center align-items-center">The professional matrimonial website</p></div>
                            <div class="col-lg-12 p-0"><p class="desc3 m-0 d-flex justify-content-center align-items-center">"Two hearts, two lives, one journey.</p></div>
                            <div class="col-lg-12 p-0"><p class="desc3 m-0 d-flex justify-content-center align-items-center">Together, we create a beautiful story</p></div>
                            <div class="col-lg-12 p-0"><p class="desc3 m-0 d-flex justify-content-center align-items-center">of love and togetherness.""</p></div>
                        </div>       
                    </div>
                    <div class="col-lg-6 col-md-7 col-12 p-0">
                        <div class="row m-0">
                            <div class="col-12 p-0">
                                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" style="border-radius: 10px;">
                                    <div class="carousel-item h-100 active">
                                        <img src="/project_00/img/paper-1100254_1920.jpg" class="d-block w-100 carousel-image" alt="...">
                                        <div class="carousel-caption myshadow">
                                            "Discover love, one click closer."
                                        </div>
                                    </div>
                                        <div class="carousel-item h-100">
                                        <img src="/project_00/img/close.jpg" class="d-block w-100 carousel-image" alt="...">
                                        <div class="carousel-caption myshadow">
                                            "From search to soulmates, our journey begins."
                                        </div>
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="/project_00/img/ring.jpg" class="d-block w-100 carousel-image" alt="...">
                                        <div class="carousel-caption myshadow">
                                            "Your happy ending is just the beginning of a beautiful journey together."
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 mt-3">
        <div class="row m-0 h-100 px-0 pb-3 justify-content-center">
            <div class="col-12 p-0">
                <div class="row m-0">
                    <div class="col-md-6 col-12 px-3 d-flex justify-content-center mb-3" style="flex-grow:1">
                        <div class="card abtcard p-0 h-100" style="max-width: 100%;">
                            <div class="row g-0 h-100">
                                <div class="col-lg-6 col-md-12 myh-75">
                                    <img src="/project_00/img/privacy.jpg" class="img-fluid rounded-lg-start rounded-md-top img-zoom" alt="...">
                                </div>
                                <div class="col-lg-6 col-md-12 myh-25">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Contacts privacy</b></h5>
                                        <p class="card-text">Your privacy is important to us. Your contact information is shared only when you accept a request, ensuring your control over who can reach out to you</p>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 px-3 d-flex justify-content-center mb-3" style="flex-grow:1">
                        <div class="card abtcard p-0 h-100" style="max-width: 100%;">
                            <div class="row g-0 h-100">
                                <div class="col-lg-6 col-md-12 myh-75">
                                    <img src="/project_00/img/success.jpg" class="img-fluid rounded-lg-start rounded-md-top img-zoom" alt="...">
                                </div>
                                <div class="col-lg-6 col-md-12 myh-25">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Success stories</b></h5>
                                        <p class="card-text">Share your beautiful journey with others. Our new feature allows you to post your success story on our matrimonial website, inspiring others with tales of love and togetherness</p>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 px-3 d-flex justify-content-center mb-3" style="flex-grow:1">
                        <div class="card abtcard p-0 h-100" style="max-width: 100%;">
                            <div class="row g-0 h-100">
                                <div class="col-lg-6 col-md-12 myh-75">
                                    <img src="/project_00/img/multireligional.jpg" class="img-fluid rounded-lg-start rounded-md-top img-zoom" alt="...">
                                </div>
                                <div class="col-lg-6 col-md-12 myh-25">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Multireligional</b></h5>
                                        <p class="card-text">Embrace love that transcends boundaries. Our matrimonial platform caters to diverse religions, fostering connections that honor tradition and celebrate unity</p>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 px-3 d-flex justify-content-center mb-md-3 mb-0" style="flex-grow:1">
                        <div class="card abtcard p-0 h-100" style="max-width: 100%;">
                            <div class="row g-0 h-100">
                                <div class="col-lg-6 col-md-12 myh-75">
                                    <img src="/project_00/img/professional.jpg" class="img-fluid rounded-lg-start rounded-md-top img-zoom" alt="...">
                                </div>
                                <div class="col-lg-6 col-md-12 myh-25">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Professionality</b></h5>
                                        <p class="card-text">A professional website should prioritize user-friendly design, offering a seamless and intuitive experience for visitors. It should provide up-to-date content, reflecting the latest trends and information.</p>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-3 pt-0 mt-md-0 mt-1">
        <div class="row m-0 justify-content-center">
            <div class="col-12 p-3" id="morediv">
                <h3 class="mt-0 mb-0"><b>More about Us...</b><img class="ms-2 mb-0" width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/about.png" alt="about"/></h3><br>
                <div style="text-align: justify;">
                    <p class="m-0" style="font-size:16px;">Welcome to <strong>Safari</strong>, where your journey to love begins. Founded by <em>Enzo Safari G K</em>, our platform was born out of a deep passion for fostering meaningful connections and a desire to help professionals find their life partners. Safari was established on the principles of trust, integrity, and privacy. Originating from <em>India</em>, Safari has grown to serve a global community of like-minded individuals, reflecting our dedication to inclusivity and belief in love's ability to transcend borders. Our mission is simple yet profound: to bring people together in meaningful relationships, leveraging cutting-edge technology and a team of dedicated professionals. Join us at <strong>Safari</strong> and embark on a transformative adventure in search of a lifelong connection; your perfect match is just a click away.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>