//hidecanvas
$(document).ready(()=>{
    $(".close").click(()=>{
        $("#offcanvasWithBothOptions").offcanvas('hide'); 
    });
});
$(document).ready(()=>{
    $("#editprof").submit((event)=>{
        event.preventDefault();
        if(updateOK()){
            function getValues(){
                var variableNames = ['fname', 'mname', 'lname', 'faname', 'moname', 'siblings', 'horoscope', 'martialstatus', 'bloodgrp', 'religion', 'community', 'caste', 'gender', 'age', 'date', 'yourself', 'door', 'street', 'area', 'city', 'pincode', 'native', 'state', 'country', 'nationality', 'insta', 'mobcode', 'mobno', 'school', 'college', 'highqual', 'job', 'aincome', 'sd', 'diet', 'hobby', 'pjob', 'peducate', 'pref', 'pincstart', 'pincend', 'pagestart', 'pageend'];
                var variableData = {};
                variableNames.forEach(function(name){
                    variableData[name + 'Final'] = document.getElementById(name).value;
                });
                var imagelink=document.getElementById("disimg").getAttribute("src");
                var imageDataParts=imagelink.split(',');
                var imageType=imageDataParts[0];
                var imageData=imageDataParts[1];
                var formattedData=imageData.replace(/\+/g,'-');
                variableData.photoTypeFinal=imageType;
                variableData.photoDataFinal=formattedData;
                return variableData;
            }
            var data = getValues();
            console.log(data);
            var jsonData=JSON.stringify(data);
            var xhr=new XMLHttpRequest();
            xhr.open('POST','updateprof.php',true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('jsonData='+jsonData);
            xhr.onload = function(){ 
                if (xhr.status === 200){
                    if(xhr.responseText==="success"){
                        window.location.href="editprofile.php";
                    }
                }
            }
        }
    });
});
var isValid;
function updateOK(){
    isValid=true;
    isValid=photoTester("photo","photodiv")&&isValid;
    isValid=nameTester("fname","fnamediv")&&isValid;
    isValid=mnameTester("mname","mnamediv")&&isValid;
    isValid=nameTester("lname","lnamediv")&&isValid;
    isValid=nameTester("faname","fanamediv")&&isValid;
    isValid=nameTester("moname","monamediv")&&isValid;
    isValid=sibNoTester("siblings","siblingsdiv")&&isValid;
    isValid=selectTester("horoscope","horoscopediv")&&isValid;
    isValid=selectTester("martialstatus","martialstatusdiv")&&isValid;
    isValid=selectTester("bloodgrp","bloodgrpdiv")&&isValid;
    isValid=selectTester("religion","religiondiv")&&isValid;
    isValid=selectTester("community","communitydiv")&&isValid;
    isValid=selectTester("caste","castediv")&&isValid;
    isValid=selectTester("gender","genderdiv")&&isValid;
    isValid=ageTester("age","agediv")&&isValid;
    isValid=textAreaTester("yourself","yourselfdiv")&&isValid;
    isValid=dateTester("date","maindate","datediv")&&isValid;
    isValid=doorNoTester("door","doordiv")&&isValid;
    isValid=streetTester("street","streetdiv")&&isValid;
    isValid=addrTester("area","areadiv")&&isValid;
    isValid=addrTester("city","citydiv")&&isValid;
    isValid=pincodeTester("pincode","pincodediv")&&isValid;
    isValid=addrTester("native","nativediv")&&isValid;
    isValid=selectTester("state","statediv")&&isValid;
    isValid=selectTester("country","countrydiv")&&isValid;
    isValid=selectTester("nationality","nationalitydiv")&&isValid;
    isValid=instaTester("insta","instadiv")&&isValid;
    isValid=mobnoTester("mobno","mobnodiv")&&isValid;
    isValid=eduTester("school","schooldiv")&&isValid;
    isValid=eduTester("college","collegediv")&&isValid;
    isValid=degreeTester("highqual","highqualdiv")&&isValid;
    isValid=eduTester("job","jobdiv")&&isValid;
    isValid=incomeTester("aincome","aincomediv")&&isValid;
    isValid=selectTester("sd","sddiv")&&isValid;
    isValid=selectTester("diet","dietdiv")&&isValid;
    isValid=textAreaTester("hobby","hobbydiv")&&isValid;
    isValid=partnerTester("pjob","pjobdiv")&&isValid;
    isValid=partnerTester("peducate","peducatediv")&&isValid;
    isValid=textAreaTester("pref","prefdiv")&&isValid;
    isValid=incomeranTester("pincstart","pincend","pincdiv")&&isValid;
    isValid=ageranTester("pagestart","pageend","pagediv")&&isValid;
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
    if(!selectedFile){
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
var disimg=document.getElementById("disimg");
var imgInput=document.getElementById("photo");
if(imgInput){
    imgInput.addEventListener("input",function(){
        document.getElementById("photodiv").innerHTML="";
        const selectedFile=imgInput.files[0];
        if(selectedFile){
            if(selectedFile.type.startsWith("image/")){
                const reader=new FileReader();
                reader.onload=function (e){
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
//pwordpage
var pwordcheck=document.getElementById("pwordcheck");
if(pwordcheck){
    pwordcheck.addEventListener("change",()=>{
        var pword=document.getElementById("pword");
        var rpword=document.getElementById("rpword");
        var opword=document.getElementById("opword");
        if(pwordcheck.checked){
            pword.type="text";
            rpword.type="text";
            opword.type="text";
        }
        else{
            pword.type="password";
            rpword.type="password";
            opword.type="password";
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
            var password=document.getElementById("pword").value.trim();
            var xhr=new XMLHttpRequest();
            xhr.open('POST','updatepword.php',true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('password='+encodeURIComponent(password));
            xhr.onload = function(){ 
                if (xhr.status === 200){
                    if(xhr.responseText==="success"){
                        window.location.href="editprofile.php";
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
    isOk=pword2("opword","pword","rpword","rpworddiv")&&isOk;
    function pword3Callback(result){
        isOk=result&&isOk;
    }
    pword3("opword","opworddiv",pword3Callback);
    return isOk;
}
function pword1(){
    if(sign1.style.color=="green"&&sign2.style.color=="green"&&sign3.style.color=="green"&&sign4.style.color=="green"){
        return true;
    }
    else{
        return false;
    }
}
function pword2(id1,id2,id3,div){
    var idnew1=document.getElementById(id1);
    var idnew2=document.getElementById(id2);
    var idnew3=document.getElementById(id3);
    var divnew=document.getElementById(div);
    if(idnew2.value.trim()==idnew3.value.trim()&&(!(idnew2.value.trim().length==0))){
        idnew3.classList.remove("is-invalid");
        if(idnew1.value.trim()==idnew2.value.trim()){
            divnew.innerHTML="Old and New passwords cannot be same";
            idnew2.classList.add("is-invalid");
            return false;
        }
        else{
            divnew.innerHTML="";
            idnew2.classList.remove("is-invalid");
            return true;
        }
    }
    else{
        divnew.innerHTML="New passwords doesn't match";
        idnew2.classList.add("is-invalid");
        idnew3.classList.add("is-invalid");
        document.getElementById("pword").classList.add("is-invalid");
        return false;
    }
}
function pword3(id,div,callback){
    var idnew=document.getElementById(id);
    var divnew=document.getElementById(div);
    var vfy=new XMLHttpRequest();
    vfy.open('POST','pwordchk.php',true);
    vfy.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    vfy.send('pword='+encodeURIComponent(idnew.value.trim()));
    vfy.onreadystatechange=function(){
        if(vfy.readyState===4&&vfy.status===200){
            if(vfy.responseText==="success"){
                divnew.innerHTML="";
                idnew.classList.remove("is-invalid");
                callback(true);
            }
            else{
                divnew.innerHTML="Invalid old password";
                idnew.classList.add("is-invalid");
                callback(false);
            }
        }
    }
}