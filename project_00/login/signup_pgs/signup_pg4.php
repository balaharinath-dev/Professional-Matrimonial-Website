<?php
session_start();
if(!isset($_COOKIE["signunamenew"])&&!isset($_SESSION["signunamenew"])){
    header("Location:/project_00/login/login.php");
    exit;
}
$accusername=$_SESSION["signunamenew"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/project_00/icons8-chatbot-32.ico" type="image/x-icon">
    <title>Create account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="account.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Mooli&display=swap');</style>
</head>
<body>
    <div class="container-fluid px-md-5 px-sm-3 px-1 pt-3 pb-5 mx-sm-5 mx-3 my-5">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="row m-0">
                    <div class="d-block text-center mb-2">
                        <img height="70px" width="70px" src="/project_00/svg/Default_128k_resolution_1_eccc354f-f5cb-4d1f-a28a-1522f05c3cae_0.svg">
                    </div>  
                    <div class="col-lg-8 col-10 p-0 px-md-3 px-sm-1 px-3 d-flex mb-sm-5 mb-1 align-items-center">
                        <span class="signhead"><b>Create account</b></span>
                        <span class="account px-2 py-1 ms-md-2 ms-1 mt-xl-2 mt-1 d-sm-block d-none" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Account isn't created yet">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">?</span>
                            <i><?php echo $accusername ?></i>
                        </span>                        
                    </div>
                    <div class="col-lg-4 col-2 p-0 px-md-3 px-sm-1 px-3 d-flex mb-sm-5 mb-1 justify-content-end align-items-center">
                        <form action="signout.php" id="cnlform">
                            <button class="btn cnlbtn mybtn d-lg-block d-none" type="submit">Cancel</button>
                            <button class="btn cnlbtn mybtn btn-sm d-lg-none d-block" type="submit">Cancel</button>
                        </form>
                    </div>
                    <div class="col-12 p-0 px-md-3 px-sm-1 px-3 d-flex mb-5 mt-5 justify-content-center align-items-center d-sm-none d-block">
                        <span class="account px-2 py-1 ms-md-2 ms-1 mt-xl-2 mt-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Account isn't created yet">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">?</span>
                            <i><?php echo $accusername ?></i>
                        </span>
                    </div>
                    <div class="col-12 p-0">
                        <div class="row m-0 d-flex justify-content-center align-items-center">
                            <div class="col-12 w-75 p-0 mb-5 position-relative">
                                <div class="progress w-100" role="progressbar" aria-label="Example 4px high" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                    <div class="progress-bar" id="progressbar4" style="width: 75%;">
                                        <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 30px; font-size: 11px;">1</span>                                
                                        <span class="position-absolute top-50 start-25 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 30px; font-size: 11px;">2</span>                                
                                        <span class="position-absolute top-50 start-50 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 30px; font-size: 11px;">3</span>                                
                                        <span class="position-absolute top-50 start-75 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" id="pill4" style="height: 30px; width: 30px; font-size: 11px;">4</span>                                
                                        <span class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 30px; font-size: 11px;">&#10003;</span>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="row m-0 mt-3">
                            <div class="col-12 p-0 px-2 mb-2"><h4><b>Hobbies & Interests</b></h4></div>
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
                            <div class="col-lg-4 col-md-12 p-0 px-2 mb-3">
                                <textarea style="padding: 10px;" class="form-control" placeholder="Hobbies" name="hobby" id="hobby" cols="30" rows="5"></textarea>
                                <div class="valid-feedback d-block" id="hobbydiv"></div>
                            </div>                         
                            <div class="col-6 p-0 px-2 mb-3 d-flex justify-content-start align-items-end" style="flex-grow: 1;">
                                <a href="signup_pg3.php" role="button" class="btn mybtn d-lg-block d-none prev4" value="prev4">Previous</a>
                                <a href="signup_pg3.php" role="button" class="btn btn-sm mybtn d-lg-none d-block prev4" value="prev4">Previous</a>
                            </div>                          
                            <div class="col-6 p-0 px-2 mb-3 d-flex justify-content-end align-items-end" style="flex-grow: 1;">
                                <button type="reset" class="btn myclrbtn me-2 d-lg-block d-none">Clear</button>
                                <button type="button" class="btn mybtn d-lg-block d-none next4">Next</button>
                                <button type="reset" class="btn btn-sm myclrbtn me-2 d-lg-none d-block">Clear</button>
                                <button type="button" class="btn btn-sm mybtn d-lg-none d-block next4">Next</button>
                            </div>                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="account.js"></script>
    <script>
        const formFields=['sd', 'diet', 'hobby'];
        formFields.forEach(function(fieldId){
            const field=document.getElementById(fieldId);
            if(localStorage.getItem(fieldId)){
                field.value = localStorage.getItem(fieldId);
            }
        });
        $(document).ready(function(){
            $("#progressbar4").addClass("baranimation0to75");
            setTimeout(()=>{
                $("#pill4").addClass("pillanimation0to75");
            },800);
        });
    </script>
</body>
</html>