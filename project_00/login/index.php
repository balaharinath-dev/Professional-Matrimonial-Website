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
    <title>Safari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Mooli&display=swap');</style>
</head>
<body>
    <div class="container mx-xl-5 my-xl-4 px-xl-5 py-xl-5 mx-lg-5 my-lg-3 px-lg-5 py-lg-4 mx-md-1 my-md-4 px-md-1 py-md-4 mx-sm-5 my-sm-4 px-sm-0 py-sm-0 mx-4 my-5 px-0 py-0" id="excont">
        <div class="row mx-xl-4 my-xl-5 px-xl-3 py-xl-0 mx-lg-4 my-lg-4 px-xl-3 py-xl-0 mx-md-0 my-md-0 px-md-0 py-md-4 mx-sm-0 my-sm-0 px-sm-0 py-sm-0 mx-0 my-0 px-0 py-0 justify-content-between">
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 d-xl-block d-lg-block d-md-block d-sm-block d-block underlay pt-xl-0 pt-lg-0 pt-md-0 pt-sm-2 pt-2" id="underlay-1">
                <div class="d-xl-none d-lg-none d-md-none d-sm-block d-block text-center">
                    <img height="100px" width="100px" src="/project_00/svg/Default_128k_resolution_1_eccc354f-f5cb-4d1f-a28a-1522f05c3cae_0.svg">
                </div>
                <form method="post" id="logform">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-xl-4 mb-lg-4 mb-md-4 mb-sm-2 mb-2">
                            <h1 class="smhead mt-0">Login</h1>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-floating mb-xl-4 mb-lg-4 mb-md-3 mb-sm-3 mb-3">
                            <input type="text" class="form-control" id="loguname" name="loguname" placeholder="Username">
                            <label for="loguname" class="form-floating-label ms-xl-2 ms-lg-2 ms-md-2 ms-sm-2 ms-2">Username</label>
                            <div class="invalid-feedback" id="logunamediv"></div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-floating mb-xl-3 mb-lg-4 mb-md-4 mb-sm-3 mb-3">
                            <input type="password" class="form-control" id="logpword" name="logpword" placeholder="Password">
                            <label for="logpword" class="form-floating-label ms-xl-2 ms-lg-2 ms-md-2 ms-sm-2 ms-2">Password</label>
                            <div class="invalid-feedback" id="logpworddiv"></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 form-group mb-xl-4 mb-lg-4 mb-md-4 mb-sm-4 mb-4">
                            <input type="checkbox" class="form-check-input chkbxreducer mt-2 mt-sm-1" id="logcheck">
                            <label class="textreducer form-label" for="logcheck">Show password</label>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-end mb-xl-4 mb-lg-4 mb-md-4 mb-4">
                            <a class="textreducer" href="/project_00/login/forgotpword/forgotpword.php">Forgot password?</a>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-end mb-xl-2 mb-lg-2 mb-md-2 mb-sm-2 mb-2">
                            <button class="btn myclrbtn mybtn" type="reset">Clear</button>
                            <button class="btn mynormbtn mybtn ms-xl-2 ms-lg-2 ms-md-1 ms-sm-1 ms-1" type="submit" id="login">Login</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 d-xl-block d-lg-block d-md-block d-sm-none d-none underlay pt-xl-0 pt-lg-0 pt-md-0 pt-sm-2 pt-2" id="underlay-2">
                <div class="d-xl-none d-lg-none d-md-none d-sm-block d-block text-center">
                    <img height="100px" width="100px" src="/project_00/svg/Default_128k_resolution_1_eccc354f-f5cb-4d1f-a28a-1522f05c3cae_0.svg">
                </div>
                <form method="post" id="signform">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-xl-4 mb-lg-4 mb-md-4 mb-sm-3 mb-3">
                            <h1 class="smhead mt-0">Sign up</h1>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-floating mb-xl-4 mb-lg-3 mb-md-3 mb-sm-3 mb-3" id="unamediv">
                            <input type="text" class="form-control" id="signuname" name="signuname" placeholder="Username">
                            <label for="signuname" class="form-floating-label ms-xl-2 ms-lg-2 ms-md-2 ms-sm-2 ms-2">Username</label>
                            <div class="invalid-feedback" id="signunamediv"></div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-group mb-xl-5 mb-lg-5 mb-md-5 mb-sm-4 mb-4" id="otpdiv">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-8 col-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm otpinpbox" id="otp" name="otp" placeholder="Enter OTP...">
                                        <button type="submit" class="btn mynormbtn btn-sm" id="getotp" value="getotp">Send OTP</button>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-4 col-4 d-none" id="vfyotpdiv">
                                    <button class="btn myclrbtn verifyotpbtn" type="submit" id="verifyotp" value="verifyotp">Verify OTP</button> 
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mt-2 ps-3 d-block" id="otpinfo"></div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mt-1 d-block valid-feedback text-end pe-3 w-50" id="otptimer"></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mt-0 mb-4 d-none valid-feedback ps-3 w-50" id="finalmsg"></div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-end mb-xl-2 mb-lg-2 mb-md-2 mb-sm-2 mb-2">
                            <button class="btn myclrbtn mybtn" type="reset">Clear</button>
                            <button class="btn mynormbtn mybtn ms-xl-2 ms-lg-2 ms-md-1 ms-sm-1 ms-1" type="submit" id="signin" value="signin" disabled>Sign up</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="overlay text-center p-xl-0 p-lg-0 d-xl-block d-lg-block d-md-block d-sm-none d-none" id="overlay" style="color: #343a40;">
                <div class="row m-xl-0 p-xl-0 m-lg-0 p-lg-0 m-md-0 p-md-0 overlay-ins">
                    <div class="col-xl-12 m-xl-0 p-xl-0 m-lg-0 p-lg-0 m-md-0 p-md-0 overlay-1" id="overlay-1">
                        <img height="100px" width="100px" src="/project_00/svg/Default_128k_resolution_1_eccc354f-f5cb-4d1f-a28a-1522f05c3cae_0.svg">
                        <h1 class="mb-xl-0 mb-lg-0 mb-md-0 myshadow deshead">Welcome back!</h1>
                        <p class="m-xl-0 m-lg-0 m-md-0 myshadow desdesc">Login to continue your journey...</p>
                        <p class="mb-xl-2 mb-lg-0 mb-md-0 myshadow desques">Don't have an account?</p>
                        <button type="click" class="btn btn-outline-dark text-center m-xl-0 m-lg-0 m-md-0 desbtn" id="signslide">Sign up</button>
                    </div>
                    <div class="col-xl-12 m-xl-0 p-xl-0 m-lg-0 p-lg-0 m-md-0 p-md-0 overlay-2" id="overlay-2">
                    <img height="100px" width="100px" src="/project_00/svg/Default_128k_resolution_1_eccc354f-f5cb-4d1f-a28a-1522f05c3cae_0.svg">
                        <h1 class="mb-xl-0 mb-lg-0 mb-md-0 myshadow deshead">Hello mate!</h1>
                        <p class="m-xl-0 m-lg-0 m-md-0 myshadow desdesc">Sign up to start your journey...</p>                        
                        <p class="mb-xl-2 mb-lg-0 mb-md-0 myshadow desques">Already a User?</p>
                        <button type="click" class="btn btn-outline-dark text-center m-xl-0 m-lg-0 m-md-0 desbtn" id="logslide">Login</button>
                    </div>
                </div>
            </div>
            <div class="text-center d-xl-none d-lg-none d-md-none d-sm-block d-block my-sm-3 my-3" id="signsmdiv" style="color: #343a40;">
                <p class="mb-sm-2 mb-2 myshadow">Don't have an account?</p>
                <button type="click" class="btn btn-outline-dark mybtn" id="signsmbtn">Sign in</button>
            </div>
            <div class="text-center d-xl-none d-lg-none d-md-none d-sm-none d-none my-sm-3 my-3" id="logsmdiv" style="color: #343a40;">
                <p class="mb-sm-2 mb-2 myshadow">Already a User?</p>
                <button type="click" class="btn btn-outline-dark mybtn" id="logsmbtn">Login</button>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>