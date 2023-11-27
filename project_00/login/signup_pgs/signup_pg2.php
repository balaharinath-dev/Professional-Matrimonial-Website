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
                                <div class="progress w-100" role="progressbar" aria-label="Example 4px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                    <div class="progress-bar" id="progressbar2" style="width: 25%">  
                                        <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 30px; font-size: 11px;">1</span>                                
                                        <span class="position-absolute top-50 start-25 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" id="pill2" style="height: 30px; width: 30px; font-size: 11px;">2</span>                                
                                        <span class="position-absolute top-50 start-50 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 30px; font-size: 11px;">3</span>                                
                                        <span class="position-absolute top-50 start-75 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 30px; font-size: 11px;">4</span>                                
                                        <span class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 30px; font-size: 11px;">&#10003;</span>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="row m-0 mt-3">
                            <div class="col-12 p-0 px-2 mb-2"><h4><b>Contact details</b></h4></div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="door" name="door" placeholder="Door number">
                                    <label class="form-floating-label" for="door">Door number</label>
                                </div>
                                <div class="valid-feedback d-block" id="doordiv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="street" name="street" placeholder="Street name">
                                    <label class="form-floating-label" for="street">Street name</label>
                                </div>
                                <div class="valid-feedback d-block" id="streetdiv"></div>
                            </div> 
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="area" name="area" placeholder="Area Name">
                                    <label class="form-floating-label" for="area">Area Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="areadiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="city" name="city" placeholder="City">
                                    <label class="form-floating-label" for="city">City</label>
                                </div>
                                <div class="valid-feedback d-block" id="citydiv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="number" id="pincode" name="pincode" placeholder="Pincode">
                                    <label class="form-floating-label" for="pincode">Pincode</label>
                                </div>
                                <div class="valid-feedback d-block" id="pincodediv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="native" name="native" placeholder="Native">
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
                                    <input class="form-control" type="text" id="insta" name="insta" placeholder="Instagram ID">
                                    <label class="form-floating-label" for="insta">Instagram ID</label>
                                </div>
                                <div class="valid-feedback d-block" id="instadiv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
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
                                        <input type="text" class="form-control" id="mobno" name="mobno" placeholder="Mobile number">
                                        <label for="mobno" class="form-floating-label">Mobile number</label>
                                    </div>
                                </div>
                                <div class="valid-feedback d-block" id="mobnodiv"></div>
                            </div>
                            <div class="col-md-6 d-lg-none d-md-block d-none"></div>                   
                            <div class="col-6 p-0 px-2 mb-3 d-flex justify-content-start align-items-end" style="flex-grow: 1;">
                                <a href="signup_pg1.php" role="button" class="btn mybtn d-lg-block d-none prev2" value="prev2">Previous</a>
                                <a href="signup_pg1.php" role="button" class="btn btn-sm mybtn d-lg-none d-block prev2" value="prev2">Previous</a>
                            </div>                          
                            <div class="col-6 p-0 px-2 mb-3 d-flex justify-content-end align-items-end" style="flex-grow: 1;">
                                <button type="reset" class="btn myclrbtn me-2 d-lg-block d-none">Clear</button>
                                <button type="button" class="btn mybtn d-lg-block d-none next2">Next</button>
                                <button type="reset" class="btn btn-sm myclrbtn me-2 d-lg-none d-block">Clear</button>
                                <button type="button" class="btn btn-sm mybtn d-lg-none d-block next2">Next</button>
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
        const formFields=['door', 'street', 'area', 'city', 'pincode', 'native', 'state','country', 'nationality', 'insta', 'mobcode', 'mobno'];
        formFields.forEach(function(fieldId){
            const field=document.getElementById(fieldId);
            if(localStorage.getItem(fieldId)){
                field.value = localStorage.getItem(fieldId);
            }
        });
        $(document).ready(function(){
            $("#progressbar2").addClass("baranimation0to25");
            setTimeout(()=>{
                $("#pill2").addClass("pillanimation0to25");
            },800);
        });
    </script>
</body>
</html>