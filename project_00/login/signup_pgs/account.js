//popover
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
const cnlform=document.getElementById("cnlform");
cnlform.addEventListener("submit",function(event){
    event.preventDefault();
    if(lstClear()){
        cnlform.submit();
    }
    function lstClear(){
        const formFields = ['photo','photoType','photoData','photoFlag','photoExists','fname', 'mname', 'lname', 'faname', 'moname', 'siblings', 'horoscope', 'martialstatus', 'bloodgrp', 'religion', 'community', 'caste', 'gender', 'age', 'date', 'yourself', 'door', 'street', 'area', 'city', 'pincode', 'native', 'state', 'country', 'nationality', 'insta', 'mobcode', 'mobno', 'school', 'college', 'highqual', 'job', 'aincome', 'sd', 'diet', 'hobby', 'pjob', 'peducate', 'pref', 'pincstart', 'pincend', 'pagestart', 'pageend'];
        formFields.forEach(function(fieldId){
            if(localStorage.getItem(fieldId)){
                localStorage.removeItem(fieldId);
            }
        });
        return true;
    }
});
//bar
$(document).ready(function(){
    $(".prev2").click(function(){
    });
});
$(document).ready(function(){
    $(".next1").click(function(){
        if(pgnext1()){
            const formFields=['photo','fname', 'mname', 'lname', 'faname', 'moname', 'siblings', 'horoscope','martialstatus', 'bloodgrp', 'religion', 'community', 'caste','gender', 'age', 'date', 'yourself'];
            formFields.forEach(function(fieldId){
                if(fieldId=="photo"){
                    localStorage.setItem('photoExists', true);
                    if(localStorage.getItem('photoFlag')==='false'&&localStorage.getItem('photoExists')==='true'){
                        var selectedFile=document.getElementById("photo").files[0];
                        const reader=new FileReader();
                        var imgdata;
                        reader.onload=function (e){
                            imgdata=e.target.result;
                            const splitdata = imgdata.split(',');
                            localStorage.setItem('photoType', splitdata[0]);
                            localStorage.setItem('photoData',splitdata[1]);
                            localStorage.setItem('photoFlag', true);
                        };            
                        reader.readAsDataURL(selectedFile);
                        localStorage.setItem('photo', JSON.stringify({
                            name: selectedFile.name,
                            type: selectedFile.type,
                        }));
                    }
                }
                else{
                    const field=document.getElementById(fieldId);
                    localStorage.setItem(fieldId,field.value);
                }
            });
            window.location.href="signup_pg2.php";
        }
    });
});
var isValid;
function pgnext1(){
    isValid=true;
    isValid=photoTester("photo","photodiv")&&isValid;
    isValid=nameTester("fname","fnamediv")&&isValid;
    isValid=mnameTester("mname","mnamediv")&&isValid;
    isValid=nameTester("lname","lnamediv")&&isValid;
    isValid=nameTester("faname","fanamediv")&&isValid;
    isValid=nameTester("moname","monamediv")&&isValid;
    isValid=sibNoTester("siblings","siblingsdiv")&&isValid;
    isValid=selectTester("horoscope","horoscopediv")&&isValid;
    isValid=selectTester("martial-status","martial-statusdiv")&&isValid;
    isValid=selectTester("bloodgrp","bloodgrpdiv")&&isValid;
    isValid=selectTester("religion","religiondiv")&&isValid;
    isValid=selectTester("community","communitydiv")&&isValid;
    isValid=selectTester("caste","castediv")&&isValid;
    isValid=selectTester("gender","genderdiv")&&isValid;
    isValid=ageTester("age","agediv")&&isValid;
    isValid=textAreaTester("yourself","yourselfdiv")&&isValid;
    isValid=dateTester("date","maindate","datediv")&&isValid;
    return isValid;
}
var fileType;
function photoTester(id,div) {
    const fileInput = document.getElementById(id);
    var divnew = document.getElementById(div);
    const allowedFileTypes = ["image/jpeg", "image/png", "image/jpg"];
    const maxFileSizeInBytes = 10 * 1024 * 1024;
    const selectedFile = fileInput.files[0];
    if(selectedFile){
        fileType = selectedFile.type;
        if(!fileType){
            var photoData=localStorage.getItem("photo");
            var actualData=JSON.parse(photoData);
            fileType=actualData.type;
        }
    }
    var photoFlag=localStorage.getItem('photoFlag');
    if (!selectedFile&&!photoFlag) {
        divnew.innerHTML = "Select a file for DP";
        fileInput.classList.remove("is-valid");
        fileInput.classList.add("is-invalid");
        return false;
    }
    else if(!selectedFile&&photoFlag){
        return true;
    }
    else{
        if (!allowedFileTypes.includes(fileType)) {
            divnew.innerHTML = "Select a valid file with .png, .jpg, .jpeg types";
            fileInput.classList.remove("is-valid");
            fileInput.classList.add("is-invalid");
            return false;
        } 
        else if (selectedFile.size > maxFileSizeInBytes) {
            divnew.innerHTML = "Select a file with a minimum size of 10MB";
            fileInput.classList.remove("is-valid");
            fileInput.classList.add("is-invalid");
            return false;
        } 
        else {
            divnew.innerHTML = "";
            fileInput.classList.remove("is-invalid");
            fileInput.classList.add("is-valid");
            return true;
        }
    }
}
//display
var svg=document.getElementById("svg");
var disimg=document.getElementById("disimg");
var imgInput=document.getElementById("photo");
if(imgInput){
    imgInput.addEventListener("input",function(){
        localStorage.setItem('photoFlag',false);
        document.getElementById("photodiv").innerHTML="";
        const selectedFile=imgInput.files[0];
        if(selectedFile){
            if(selectedFile.type.startsWith("image/")){
                const reader=new FileReader();
                reader.onload=function (e){
                    svg.classList.remove("d-block");
                    svg.classList.add("d-none");
                    disimg.classList.remove("d-none");
                    disimg.classList.add("d-block");
                    disimg.src=e.target.result;       
                };            
                reader.readAsDataURL(selectedFile);
            }
        }
    });
}
function nameTester(id,div){
    var idVal=$("#"+id).val().trim();
    var namereg=/^[A-Za-z\s]+$/;
    if(namereg.test(idVal)){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Enter a valid name");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
function mnameTester(id,div){
    if($("#"+id).val().trim()===""){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).removeClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        var idVal=$("#"+id).val().trim();
        var namereg=/^[A-Za-z\s]+$/;
        if(namereg.test(idVal)){
            $("#"+id).removeClass("is-invalid");
            $("#"+id).addClass("is-valid");
            $("#"+div).text("");
            return true;
        }
        else{
            $("#"+id).removeClass("is-valid");
            $("#"+id).addClass("is-invalid");
            $("#"+div).text("Enter a valid name");
            $("#"+div).removeClass("valid-feedback");
            $("#"+div).addClass("invalid-feedback");
            return false;
        }
    }
}
function sibNoTester(id,div){
    var idVal=$("#"+id).val().trim();
    var sibNoreg=/^\d+$/;
    if(sibNoreg.test(idVal)){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Enter a valid number");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
function ageTester(id,div){
    var idVal=$("#"+id).val().trim();
    var agereg=/^\d+$/;
    if(agereg.test(idVal)){
        const dobVal=new Date($("#date").val());
        const now=new Date();
        var milliTime=now-dobVal;
        var crtAge=milliTime/(1000 * 60 * 60 * 24 * 365.25);
        if($("#age").val().trim()==Math.floor(crtAge)){
            $("#"+id).removeClass("is-invalid");
            $("#"+id).addClass("is-valid");
            $("#"+div).text("");
            return true;
        }
        else{
            $("#"+id).removeClass("is-valid");
            $("#"+id).addClass("is-invalid");
            $("#"+div).text("Age and Date of Birth doesn't match");
            $("#"+div).removeClass("valid-feedback");
            $("#"+div).addClass("invalid-feedback");
            return false;
        }
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Enter a valid age");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
function selectTester(id,div){
    if($("#"+id).val()===""){
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Select an option");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
    else{
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
}
function textAreaTester(id,div){
    if($("#"+id).val().trim()===""){
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        if(id=="yourself"){
            $("#"+div).text("Please explain yourself");
        }
        if(id=="hobby"){
            $("#"+div).text("Please explain your hobbies");
        }
        if(id=="pref"){
            $("#"+div).text("Please explain your partner prefernces");
        }
        return false;
    }
    else{
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
}
function dateTester(id,mainid,div){
    if($("#"+id).val().trim()===""){
        $("#"+mainid).removeClass("border-success");
        $("#"+mainid).addClass("border-danger");
        $("#"+div).text("Enter a valid date");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
    else{
        $("#"+mainid).removeClass("border-danger");
        $("#"+mainid).addClass("border-success");
        $("#"+div).text("");
        return true;
    }
}
$(document).ready(function(){
    $(".prev3").click(function(){
    });
});
$(document).ready(function(){
    $(".next2").click(function(){
        if(pgnext2()){
            const formFields=['door', 'street', 'area', 'city', 'pincode', 'native', 'state','country', 'nationality', 'insta', 'mobcode', 'mobno'];
            formFields.forEach(function(fieldId){
                const field=document.getElementById(fieldId);
                localStorage.setItem(fieldId,field.value.trim());
            });
            window.location.href="signup_pg3.php";
        }
    });
});
var isValid2;
function pgnext2(){
    isValid2=true;
    isValid2=doorNoTester("door","doordiv")&&isValid2;
    isValid2=streetTester("street","streetdiv")&&isValid2;
    isValid2=addrTester("area","areadiv")&&isValid2;
    isValid2=addrTester("city","citydiv")&&isValid2;
    isValid2=pincodeTester("pincode","pincodediv")&&isValid2;
    isValid2=addrTester("native","nativediv")&&isValid2;
    isValid2=selectTester("state","statediv")&&isValid2;
    isValid2=selectTester("country","countrydiv")&&isValid2;
    isValid2=selectTester("nationality","nationalitydiv")&&isValid2;
    isValid2=instaTester("insta","instadiv")&&isValid2;
    isValid2=mobnoTester("mobno","mobnodiv")&&isValid2;
    return isValid2;
}
function doorNoTester(id,div){
    var idVal=$("#"+id).val().trim();
    var namereg=/^[a-zA-Z0-9\s\.\/]+$/;
    if(namereg.test(idVal)){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Enter a valid door number");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
function streetTester(id,div){
    if($("#"+id).val().trim()===""){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).removeClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        var idVal=$("#"+id).val().trim();
        var namereg=/^[A-Za-z0-9\s]+$/;
        if(namereg.test(idVal)){
            $("#"+id).removeClass("is-invalid");
            $("#"+id).addClass("is-valid");
            $("#"+div).text("");
            return true;
        }
        else{
            $("#"+id).removeClass("is-valid");
            $("#"+id).addClass("is-invalid");
            $("#"+div).text("Enter a valid street name");
            $("#"+div).removeClass("valid-feedback");
            $("#"+div).addClass("invalid-feedback");
            return false;
        }
    }
}
function addrTester(id,div){
    var idVal=$("#"+id).val().trim();
    var namereg=/^[a-zA-Z\s\,]+$/;
    if(namereg.test(idVal)){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        if(id==="area"){
            $("#"+div).text("Enter a valid area name");
        }
        if(id==="city"){
            $("#"+div).text("Enter a valid city name");
        }
        if(id==="native"){
            $("#"+div).text("Enter a valid native place");
        }
        return false;
    }
}
function pincodeTester(id,div){
    var idVal=$("#"+id).val().trim();
    var sibNoreg=/^\d{6}$/;
    if(sibNoreg.test(idVal)){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Enter a valid pincode");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
function instaTester(id,div){
    if($("#"+id).val().trim()===""){
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Enter a valid Instagram ID");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
    else{
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
}
function mobnoTester(id,div){
    if($("#"+id).val().trim().length==10){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Enter a valid mobile number");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
$(document).ready(function(){
    $(".prev4").click(function(){
    });
});
$(document).ready(function(){
    $(".next3").click(function(){
        if(pgnext3()){
            const formFields=['school', 'college', 'highqual', 'job', 'aincome'];
            formFields.forEach(function(fieldId){
                const field=document.getElementById(fieldId);
                localStorage.setItem(fieldId,field.value.trim());
            });
            window.location.href="signup_pg4.php";
        }
    });
});
var isValid3;
function pgnext3(){
    isValid3=true;
    isValid3=eduTester("school","schooldiv")&&isValid3;
    isValid3=eduTester("college","collegediv")&&isValid3;
    isValid3=degreeTester("highqual","highqualdiv")&&isValid3;
    isValid3=eduTester("job","jobdiv")&&isValid3;
    isValid3=incomeTester("aincome","aincomediv")&&isValid3;
    return isValid3;
}
function eduTester(id,div){
    var idVal=$("#"+id).val().trim();
    var namereg=/^[A-Za-z0-9\-./' ]+$/;
    if(namereg.test(idVal)){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        if(id=="school"){
            $("#"+div).text("Enter a valid school name");
        }
        if(id=="college"){
            $("#"+div).text("Enter a valid college name");
        }
        if(id=="job"){
            $("#"+div).text("Enter a valid profession");
        }
        return false;
    }
}
function degreeTester(id,div){
    var idVal=$("#"+id).val().trim();
    var namereg=/^[a-zA-Z\s\.]+$/;
    if(namereg.test(idVal)){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Enter a valid qualification");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
function incomeTester(id,div){
    var idVal=$("#"+id).val().trim();
    var namereg=/^[0-9,\.]+$/;
    if(namereg.test(idVal)){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).text("Enter a valid amount");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
$(document).ready(function(){
    $(".prev5").click(function(){
    });
});
$(document).ready(function(){
    $(".next4").click(function(){
        if(pgnext4()){
            const formFields=['sd', 'diet', 'hobby'];
            formFields.forEach(function(fieldId){
                const field=document.getElementById(fieldId);
                localStorage.setItem(fieldId,field.value.trim());
            });
            window.location.href="signup_pg5.php";
        }
    });
});
var isValid4;
function pgnext4(){
    isValid4=true;
    isValid4=selectTester("sd","sddiv")&&isValid4;
    isValid4=selectTester("diet","dietdiv")&&isValid4;
    isValid4=textAreaTester("hobby","hobbydiv")&&isValid4;
    return isValid4;
}
$(document).ready(function(){
    $(".next5").click(function(){
        if(pgnext5()){
            $("#exampleModal").modal('show');
            const formFields=['pjob', 'peducate', 'pref','pincstart','pincend','pagestart','pageend'];
            formFields.forEach(function(fieldId){
                const field=document.getElementById(fieldId);
                localStorage.setItem(fieldId,field.value.trim());
            });
        }
    });
});
var isValid5;
function pgnext5(){
    isValid5=true;
    isValid5=partnerTester("pjob","pjobdiv")&&isValid5;
    isValid5=partnerTester("peducate","peducatediv")&&isValid5;
    isValid5=textAreaTester("pref","prefdiv")&&isValid5;
    isValid5=incomeranTester("pincstart","pincend","pincdiv")&&isValid5;
    isValid5=ageranTester("pagestart","pageend","pagediv")&&isValid5;
    return isValid5;
}
function partnerTester(id,div){
    var idVal=$("#"+id).val().trim();
    var namereg=/^[A-Za-z0-9\-./' ]+$/;
    if(namereg.test(idVal)){
        $("#"+id).removeClass("is-invalid");
        $("#"+id).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id).removeClass("is-valid");
        $("#"+id).addClass("is-invalid");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        if(id=="pjob"){
            $("#"+div).text("Enter a valid partner job");
        }
        if(id=="peducate"){
            $("#"+div).text("Enter a valid partner education");
        }
        return false;
    }
}
function incomeranTester(id1,id2,div){
    var idVal1=$("#"+id1).val().trim();
    var idVal2=$("#"+id2).val().trim();
    var namereg=/^\d+$/;
    if(namereg.test(idVal1)&&namereg.test(idVal2)&&(parseInt(idVal1)<parseInt(idVal2))){
        $("#"+id1).removeClass("is-invalid");
        $("#"+id1).addClass("is-valid");
        $("#"+id2).removeClass("is-invalid");
        $("#"+id2).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id1).removeClass("is-valid");
        $("#"+id1).addClass("is-invalid");
        $("#"+id2).addClass("is-invalid");
        $("#"+id2).addClass("is-invalid");
        $("#"+div).text("Enter a valid income range");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
function ageranTester(id1,id2,div){
    var idVal1=$("#"+id1).val().trim();
    var idVal2=$("#"+id2).val().trim();
    var namereg=/^\d+$/;
    if(namereg.test(idVal1)&&namereg.test(idVal2)&&(idVal1<idVal2)){
        $("#"+id1).removeClass("is-invalid");
        $("#"+id1).addClass("is-valid");
        $("#"+id2).removeClass("is-invalid");
        $("#"+id2).addClass("is-valid");
        $("#"+div).text("");
        return true;
    }
    else{
        $("#"+id1).removeClass("is-valid");
        $("#"+id1).addClass("is-invalid");
        $("#"+id2).addClass("is-invalid");
        $("#"+id2).addClass("is-invalid");
        $("#"+div).text("Enter a valid age range");
        $("#"+div).removeClass("valid-feedback");
        $("#"+div).addClass("invalid-feedback");
        return false;
    }
}
var pwordcheck=document.getElementById("pwordcheck");
if(pwordcheck){
    pwordcheck.addEventListener("change",()=>{
        var pword=document.getElementById("pword");
        var rpword=document.getElementById("rpword");
        if(pwordcheck.checked){
            pword.type="text";
            rpword.type="text";
        }
        else{
            pword.type="password";
            rpword.type="password";
        }
    });
}
var pword=document.getElementById("pword");
var sign1=document.getElementById("sign1");
var desc1=document.getElementById("desc1");
var sign2=document.getElementById("sign2");
var desc2=document.getElementById("desc2");
var sign3=document.getElementById("sign3");
var desc3=document.getElementById("desc3");
var sign4=document.getElementById("sign4");
var desc4=document.getElementById("desc4");
if(pword){
    pword.addEventListener("input",()=>{
        var pwordval=pword.value.trim();
        upcregex=/^(?=.*[A-Z]).*$/;
        if(upcregex.test(pwordval)){
            sign1.style.color="green";
            desc1.style.color="green";
            sign1.innerHTML="&#10003;";
        }
        else{
            sign1.style.color="red";
            desc1.style.color="red";
            sign1.innerHTML="&#10006;";
        }
        charregex=/^(?=.*[!@#$%^*]).*$/;
        if(charregex.test(pwordval)){
            sign2.style.color="green";
            desc2.style.color="green";
            sign2.innerHTML="&#10003;";
        }
        else{
            sign2.style.color="red";
            desc2.style.color="red";
            sign2.innerHTML="&#10006;";
        }
        noregex=/^(?=.*[0-9]).*$/;
        if(noregex.test(pwordval)){
            sign3.style.color="green";
            desc3.style.color="green";
            sign3.innerHTML="&#10003;";
        }
        else{
            sign3.style.color="red";
            desc3.style.color="red";
            sign3.innerHTML="&#10006;";
        }
        if(pwordval.length<12){
            sign4.style.color="red";
            desc4.style.color="red";
            sign4.innerHTML="&#10006;";
        }
        else{
            sign4.style.color="green";
            desc4.style.color="green";
            sign4.innerHTML="&#10003;";
        }
    });
}
var pwordform=document.getElementById("pwordform");
if(pwordform){
    pwordform.addEventListener("submit",(event)=>{
        event.preventDefault();
        if(pwordok()){
            function getValuesFromLocalStorage(){
                var variableNames = ['photoType','fname', 'mname', 'lname', 'faname', 'moname', 'siblings', 'horoscope', 'martialstatus', 'bloodgrp', 'religion', 'community', 'caste', 'gender', 'age', 'date', 'yourself', 'door', 'street', 'area', 'city', 'pincode', 'native', 'state', 'country', 'nationality', 'insta', 'mobcode', 'mobno', 'school', 'college', 'highqual', 'job', 'aincome', 'sd', 'diet', 'hobby', 'pjob', 'peducate', 'pref', 'pincstart', 'pincend', 'pagestart', 'pageend'];
                var variableData = {};
                variableNames.forEach(function(name){
                    variableData[name + 'Final'] = localStorage.getItem(name);
                });
                variableData.passwordFinal=document.getElementById("pword").value.trim();
                var imageData=localStorage.getItem("photoData");
                var formattedData=imageData.replace(/\+/g,'-');
                variableData.photoDataFinal=formattedData;
                return variableData;
            }
            var data = getValuesFromLocalStorage();
            var jsonData=JSON.stringify(data);
            var xhr=new XMLHttpRequest();
            xhr.open('POST','createacc.php',true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('jsonData='+jsonData);
            xhr.onload = function(){ 
                if (xhr.status === 200){
                    if(xhr.responseText==="success"){
                        const formFields = ['photo','photoType','photoData','photoFlag','photoExists','fname', 'mname', 'lname', 'faname', 'moname', 'siblings', 'horoscope', 'martialstatus', 'bloodgrp', 'religion', 'community', 'caste', 'gender', 'age', 'date', 'yourself', 'door', 'street', 'area', 'city', 'pincode', 'native', 'state', 'country', 'nationality', 'insta', 'mobcode', 'mobno', 'school', 'college', 'highqual', 'job', 'aincome', 'sd', 'diet', 'hobby', 'pjob', 'peducate', 'pref', 'pincstart', 'pincend', 'pagestart', 'pageend'];
                        formFields.forEach(function(fieldId){
                            if(localStorage.getItem(fieldId)){
                                localStorage.removeItem(fieldId);
                            }
                        });
                        const cong=new XMLHttpRequest();
                        cong.open("POST","/project_00/sendcongragulation.php",true);
                        cong.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        cong.send();
                        cong.onreadystatechange=function(){
                            if(cong.readyState===4&&cong.status===200){
                                //modal
                                window.location.href="signout.php";
                            }
                            else if(cong.readyState==2||cong.readyState==3){}
                            else{
                                alert(cong.readyState);
                            }
                        }
                    }
                }
            };
        }
    });
}
var isOk;
function pwordok(){
    isOk=true;
    isOk=pword1()&&isOk;
    isOk=pword2("rpword","rpworddiv")&&isOk;
    return isOk;
}
function pword1(){
    if(sign1.style.color=="green"&&sign2.style.color=="green"&&sign3.style.color=="green"&&sign4.style.color=="green"){
        return true;
    }
    else{
        return false
    }
}
function pword2(id,div){
    idnew=document.getElementById(id);
    divnew=document.getElementById(div);
    if(pword.value.trim()==idnew.value.trim()&&(!(pword.value.trim().length==0))){
        divnew.innerHTML="";
        return true;
    }
    else{
        divnew.innerHTML="Passwords doesn't match";
        return false;
    }
}