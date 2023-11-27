<?php
session_start();
if(isset($_COOKIE["logunamenew"])||isset($_SESSION["logunamenew"])){
    header("Location:/project_00/login/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/project_00/icons8-chatbot-32.ico" type="image/x-icon">
    <title>User authorization</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fpword.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Mooli&family=Yatra+One&display=swap');</style>
</head>
<body>
    <div class="container pt-3 pb-3 px-md-5 px-3" style="flex-grow:1">
        <div class="row m-0 justify-content-center align-items-center">
            <div class="col-lg-7 col-md-10 col-sm-12 d-block underlay" id="underlay-2">
                <form method="post" id="signform">
                    <div class="row mycontainer-fluid pt-3 pb-2 px-sm-5 px-3">
                        <div class="d-block text-center mb-2">
                            <img height="70px" width="70px" src="/project_00/svg/Default_128k_resolution_1_eccc354f-f5cb-4d1f-a28a-1522f05c3cae_0.svg">
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-xl-4 mb-lg-4 mb-md-4 mb-sm-3 mb-3">
                            <h1 class="smhead mt-0">User authorization</h1>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-floating mb-xl-4 mb-lg-3 mb-md-3 mb-sm-3 mb-3" id="unamediv">
                            <input type="text" class="form-control" id="signuname" name="signuname" placeholder="Username">
                            <label for="signuname" class="form-floating-label ms-xl-2 ms-lg-2 ms-md-2 ms-sm-2 ms-2">Username</label>
                            <div class="invalid-feedback" id="signunamediv"></div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-group mb-xl-5 mb-lg-5 mb-md-5 mb-sm-4 mb-4" id="otpdiv">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-8 col-8 pe-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP...">
                                        <button type="submit" class="btn mynormbtn" id="getotp" value="getotp">Send OTP</button>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-4 col-4 d-none text-end ps-0" id="vfyotpdiv">    
                                    <button class="btn myclrbtn verifyotpbtn btn-sm" type="submit" id="verifyotp" value="verifyotp">Verify OTP</button> 
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mt-2 ps-3 d-block" id="otpinfo"></div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mt-1 d-block valid-feedback text-end pe-3 w-50" id="otptimer"></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mt-0 mb-4 d-none valid-feedback ps-3 w-50" id="finalmsg"></div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 text-end">
                            <a href="/project_00/login/index.php" role="button" class="btn mynormbtn float-start">Back</a>
                            <button class="btn myclrbtn mybtn" type="reset">Clear</button>
                            <button class="btn mynormbtn mybtn ms-xl-2 ms-lg-2 ms-md-1 ms-sm-1 ms-1" type="submit" id="signin" value="signin" disabled>Next</button>
                        </div>
                        <div class="col-12 px-2 mb-5 d-none list-group" id="userdiv">
                            <div class="list-group-item list-group-item-action active px-0">
                                <div class="row m-0 d-flex justify-content-center">
                                    <div class="col-sm-2 col-2 px-0 d-flex align-items-center" style="height: 45px; width: 45px">
                                        <img id="imagediv" src="https://img.icons8.com/color/50/checked--v1.png" style="border-radius: 100%;" class="img-fluid">
                                    </div>
                                    <div class="col-sm-8 col-7 ps-2 px-1 d-flex align-items-center">    
                                        <b><span id="namediv"></span></b>          
                                    </div>
                                    <div class="col-sm-2 col-2 px-1 d-flex align-items-center justify-content-end">
                                        <img src="https://img.icons8.com/color/30/checked--v1.png">
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="fpword.js"></script>
</body>
</html>