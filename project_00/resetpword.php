<?php
session_start();
if(!isset($_COOKIE["resetpassword"])&&!isset($_SESSION["resetpassword"])){
    header("Location:/project_00/login/login.php");
    exit;
}
$resetusername=$_SESSION["resetpassword"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons8-chatbot-32.ico" type="image/x-icon">
    <title>Reset password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login/forgotpword/fpword.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Mooli&family=Yatra+One&display=swap');</style>
</head>
<body>
    <div class="container py-3 px-md-5 px-sm-3 px-3">
        <div class="row m-0 justify-content-center align-items-center">
            <div class="col-lg-8 col-md-9 col-12 px-0">
                <form id="pwordform">
                    <div class="row m-0 mycontainer-fluid my-2 my-md-5 pt-3 pb-5 px-sm-5 p-3">
                        <div class="d-block text-center mb-2">
                            <img height="70px" width="70px" src="svg/Default_128k_resolution_1_eccc354f-f5cb-4d1f-a28a-1522f05c3cae_0.svg">
                        </div>
                        <div class="col-lg-8 col-10 p-0 px-sm-1 px-1 d-flex mb-sm-1 mb-2 justify-content-start align-items-center">
                            <span class="signhead"><b>Reset password</b></span>                        
                        </div>
                        <div class="col-lg-4 col-2 p-0 px-sm-1 px-1 d-flex mb-sm-2 mb-sm-1 mb-2 justify-content-end align-items-center">
                                <button class="btn cnlbtn mybtn d-lg-block d-none" type="button">Cancel</button>
                                <button class="btn cnlbtn mybtn btn-sm d-lg-none d-block" type="button">Cancel</button>
                        </div>
                        <div class="col-12 p-0 px-md-3 px-sm-1 px-3 d-flex mb-5 mt-0 justify-content-center align-items-center d-block">
                            <span class="account px-2 py-1 ms-md-2 ms-1 mt-xl-2 mt-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Account isn't created yet">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">&#10003;</span>
                                <i><?php echo $resetusername; ?></i>
                            </span>
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
    <script src="login/forgotpword/fpword.js"></script>
</body>
</html>