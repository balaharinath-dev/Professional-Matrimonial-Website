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
                                <div class="progress w-100" role="progressbar" aria-label="Example 4px high" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                    <div class="progress-bar" id="progressbar1">
                                        <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" id="pill1" style="height: 30px; width: 30px; font-size: 11px;">1</span>                                
                                        <span class="position-absolute top-50 start-25 translate-middle badge rounded-pill bg-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 30px; font-size: 11px;">2</span>                                
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
                            <div class="col-12 p-0 px-2 mb-md-2 mb-4"><h4><b>Personal details</b></h4></div>
                            <div class="col-12 p-0 mb-3 d-flex justify-content-center">
                                <div style="height: 100px; width: 100px; border-radius:50%; border: 1px solid black;" class="d-flex justify-content-center align-items-center">
                                    <svg id="svg" class="d-block" xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="bi bi-person-bounding-box" viewBox="0 0 16 16"><path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>
                                    <img src="" id="disimg" class="d-none img-fluid w-100 h-100" style="border-radius:50%;">
                                </div>
                            </div>
                            <div class="col-12 p-0 mb-5 d-flex justify-content-center">
                                <div class="form-group">
                                    <input class="form-control" type="file" id="photo" name="photo">
                                    <div class="invalid-feedback d-block" style="overflow-x: hidden;" id="photodiv"></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="fname" name="fname" placeholder="First Name">
                                    <label class="form-floating-label" for="fname">First Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="fnamediv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="mname" name="mname" placeholder="Middle Name">
                                    <label class="form-floating-label" for="mname">Middle Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="mnamediv"></div>
                            </div> 
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name">
                                    <label class="form-floating-label" for="lname">Last Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="lnamediv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="faname" name="faname" placeholder="Father's Name">
                                    <label class="form-floating-label" for="faname">Father's Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="fanamediv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="moname" name="moname" placeholder="Mother's Name">
                                    <label class="form-floating-label" for="moname">Mother's Name</label>
                                </div>
                                <div class="valid-feedback d-block" id="monamediv"></div>
                            </div> 
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-floating">
                                    <input class="form-control" type="number" id="siblings" name="siblings" placeholder="Number of Siblings">
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
                                <div class="valid-feedback d-block" id="martial-statusdiv"></div>
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
                                    <input class="form-control" type="number" id="age" name="age" placeholder="Age">
                                    <label class="form-floating-label" for="age">Age</label>
                                </div>
                                <div class="valid-feedback d-block" id="agediv"></div>
                            </div>                            
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3">
                                <div class="form-group">
                                    <div class="row m-0 border p-3 rounded" id="maindate" style="background-color: white;">
                                        <div class="col-xl-7 col-md-6 p-0 d-flex align-items-center"><label for="date" class="form-label mb-0">Date of Birth</label></div>
                                        <div class="col-xl-5 col-md-6 p-0 dateinp"><input class="form-control border border-0 p-0 datetext" type="date" value="date" id="date"></div>
                                    </div>
                                </div>
                                <div class="valid-feedback d-block" id="datediv"></div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-0 px-2 mb-3" style="flex-grow: 1;">
                                <textarea style="padding: 10px;" class="form-control" name="yourself" id="yourself" cols="30" rows="5" placeholder="About yourself"></textarea>
                                <div class="valid-feedback d-block" id="yourselfdiv"></div>
                            </div>                         
                            <div class="col-xl-8 p-0 px-2 mb-3 d-flex justify-content-end align-items-end" style="flex-grow: 1;">
                                <button type="reset" class="btn myclrbtn me-2 d-lg-block d-none">Clear</button>
                                <button type="button" class="btn mybtn d-lg-block d-none next1">Next</button>
                                <button type="reset" class="btn btn-sm myclrbtn me-2 d-lg-none d-block">Clear</button>
                                <button type="button" class="btn btn-sm mybtn d-lg-none d-block next1">Next</button>
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
        const formFields=['photo','fname', 'mname', 'lname', 'faname', 'moname', 'siblings', 'horoscope','martialstatus', 'bloodgrp', 'religion', 'community', 'caste','gender', 'age', 'date', 'yourself'];
        formFields.forEach(function(fieldId){
            var field=document.getElementById(fieldId);
            if(localStorage.getItem(fieldId)){
                if(fieldId=='photo'){
                    const storedPhoto = JSON.parse(localStorage.getItem('photo'));
                    const storedPhotoData = localStorage.getItem('photoData');
                    const storedPhotoType = localStorage.getItem('photoType');
                    var svg=document.getElementById('svg');
                    var disimg=document.getElementById('disimg');
                    disimg.src=storedPhotoType+','+storedPhotoData;    
                    svg.classList.remove("d-block");
                    svg.classList.add("d-none");
                    disimg.classList.remove("d-none");
                    disimg.classList.add("d-block");
                    var photodiv=document.getElementById("photodiv")
                    photodiv.innerHTML="<span style='color:black'><b>File chosen</b>: "+storedPhoto.name+"</span>";                    
                }
                else{
                    field.value = localStorage.getItem(fieldId);
                }
            }
        });
        $(document).ready(function(){
            $(".myclrbtn").click(function(){
                $("#disimg").addClass("d-none");
                $("#disimg").removeClass("d-block");
                $("#svg").removeClass("d-none");
                $("#svg").addClass("d-block");
            });
            $("#progressbar1").addClass("baranimation100to0");
            setTimeout(()=>{
                $("#pill1").addClass("pillanimation100to0");
            },800);
        });
    </script>
</body>
</html>