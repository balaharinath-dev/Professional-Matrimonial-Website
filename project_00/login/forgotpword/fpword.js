//userauth
var otpval;
var signuname;
var signunamenew;
var signform=document.getElementById("signform");
if(signform){
    signform.addEventListener("submit",(event)=>{
        event.preventDefault();
        var action=event.submitter.value;
        if(action==="getotp"){
            event.preventDefault();
            if(signvalidate()){
                signuname=document.getElementById("signuname");
                signunamenew=signuname.value.trim();
                var signunamediv=document.getElementById("signunamediv");
                //xmlrequest
                const xhr=new XMLHttpRequest();
                xhr.open("POST","resetunamechk.php",true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send('signunamenew='+encodeURIComponent(signunamenew));
                xhr.onreadystatechange=function(){
                    if(xhr.readyState===4&&xhr.status===200){
                        var response=xhr.responseText;
                        if(response==="notfound"){
                            signuname.classList.add("is-invalid");
                            signunamediv.innerHTML="Username not found";
                        }
                        if(response==="found"){
                            //sendotp
                            var getotp=document.getElementById("getotp");
                            var vfyotpdiv=document.getElementById("vfyotpdiv");
                            var otpinfo=document.getElementById("otpinfo");
                            otpinfo.classList.remove("invalid-feedback");
                            otpinfo.innerHTML="Sending OTP...";
                            otpval=Math.floor(100000+Math.random()*900000).toString();
                            const otp=new XMLHttpRequest();
                            otp.open("POST","/project_00/resetotp.php",true);
                            otp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            otp.send('signunamenew='+encodeURIComponent(signunamenew)+'&otpval='+encodeURIComponent(otpval));
                            otp.onreadystatechange=function(){
                                if(otp.readyState===4&&otp.status===200){
                                    var otpres=otp.responseText;
                                    if(otpres==="success"){
                                        document.getElementById("signuname").setAttribute("disabled","true");
                                        getotp.setAttribute("disabled","true");
                                        vfyotpdiv.classList.remove("d-none");
                                        vfyotpdiv.classList.add("d-block");
                                        otpinfo.classList.add("valid-feedback");
                                        otpinfo.classList.remove("invalid-feedback");
                                        otpinfo.classList.add("w-50");
                                        otpinfo.innerHTML="OTP sent!";
                                        //timer
                                        var timer;
                                        startTimer(120000);
                                        function startTimer(duration){
                                            var timerDisplay=document.getElementById("otptimer");
                                            if(timerDisplay.classList.contains("blinker")){
                                                timerDisplay.classList.remove("blinker");
                                                timerDisplay.classList.remove("invalid-feedback");
                                                timerDisplay.classList.add("valid-feedback");
                                            }
                                            var currentTime=Date.now();
                                            var endTime=currentTime+duration;
                                            function updateTimer(){
                                                var currentTime=Date.now();
                                                var remainingTime=endTime-currentTime;
                                                if(remainingTime<=0){
                                                    clearInterval(timer);
                                                    timerDisplay.innerHTML="00:00";
                                                    timerDisplay.classList.remove("valid-feedback");                                                
                                                    timerDisplay.classList.add("invalid-feedback");
                                                    timerDisplay.classList.add("blinker");
                                                    otpinfo.classList.remove("valid-feedback");                                                
                                                    //resend
                                                    getotp.removeAttribute("disabled");
                                                    getotp.innerHTML="Resend OTP";
                                                    vfyotpdiv.classList.add("d-none");
                                                    vfyotpdiv.classList.remove("d-block");
                                                }
                                                else{
                                                    var minutes=Math.floor(remainingTime/60000);
                                                    var seconds=Math.floor((remainingTime%60000)/1000);
                                                    var formattedMinutes=minutes.toString().padStart(2,"0");
                                                    var formattedSeconds=seconds.toString().padStart(2,"0");
                                                    timerDisplay.innerHTML=`${formattedMinutes}:${formattedSeconds}`;
                                                }
                                            }
                                            updateTimer();
                                            timer=setInterval(updateTimer,1000);
                                        }                                               
                                    }
                                    else{
                                        otpinfo.classList.add("invalid-feedback");
                                        otpinfo.innerHTML="Problem sending OTP";
                                    }
                                }
                                else if(otp.readyState==2||otp.readyState==3){}
                                else{
                                    alert(otp.readyState);
                                }
                            }                                                
                        }
                    }
                    else if(xhr.readyState==2||xhr.readyState==3){}
                    else{
                        alert(xhr.readyState);
                    }
                }
            }
        }
        //verify
        if(action==="verifyotp"){
            var userotp=document.getElementById("otp").value.trim();
            var signupbtn=document.getElementById("signin");
            var timerDisplay=document.getElementById("otptimer");
            var otpdiv=document.getElementById("otpdiv");
            var otpinfo=document.getElementById("otpinfo");
            var unamediv=document.getElementById("unamediv");
            var otpvalue=otpval;
            var vfy=new XMLHttpRequest();
            vfy.open('POST','/project_00/login/vfyotp.php',true);
            vfy.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            vfy.send('userotp='+encodeURIComponent(userotp)+'&otpval='+encodeURIComponent(otpvalue));
            vfy.onreadystatechange=function(){
                if(vfy.readyState===4&&vfy.status===200){
                    var response=vfy.responseText;
                    if(response==="success"){
                        var phid=document.getElementById("signuname").value.trim();
                        var ph=new XMLHttpRequest();
                        ph.open('POST','/project_00/login/photoretrieve.php',true);
                        ph.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        ph.send('phid='+encodeURIComponent(phid));
                        ph.onreadystatechange=function(){
                            if(ph.readyState===4&&ph.status===200){
                                var jsonresponse=JSON.parse(ph.responseText);
                                document.getElementById("imagediv").src=jsonresponse.photoUrl;
                                document.getElementById("namediv").innerHTML=jsonresponse.name;
                            }
                        }
                        document.getElementById("userdiv").classList.remove("d-none");
                        var finalmsg=document.getElementById("finalmsg");
                        finalmsg.classList.remove("d-none");
                        finalmsg.classList.add("d-block");
                        finalmsg.innerHTML="Account verified!";
                        timerDisplay.innerHTML="";
                        otpdiv.classList.add("d-none");
                        signupbtn.removeAttribute("disabled");
                        unamediv.classList.remove("mb-xl-4");
                        unamediv.classList.remove("mb-lg-3");
                        unamediv.classList.remove("mb-md-3");
                        unamediv.classList.remove("mb-sm-3");
                        unamediv.classList.remove("mb-3");
                        unamediv.classList.add("mb-xl-1");
                        unamediv.classList.add("mb-lg-1");
                        unamediv.classList.add("mb-md-1");
                        unamediv.classList.add("mb-sm-1");
                        unamediv.classList.add("mb-1");
                    }
                    if(response==="invalid"){
                        otpinfo.classList.remove("valid-feedback");
                        otpinfo.classList.add("invalid-feedback");
                        otpinfo.innerHTML="Invalid OTP";
                    }
                }
                else if(vfy.readyState==2||vfy.readyState==3){}
                else{
                    alert(vfy.readyState);
                }
            }
        }
        //account
            if(action=="signin"){
            var sgn=new XMLHttpRequest();
            sgn.open('POST','resetcke.php',true);
            sgn.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            sgn.send('resetpassword='+encodeURIComponent(signunamenew));
            sgn.onreadystatechange=function(){
                if (sgn.readyState===4&&sgn.status===200) {
                    var newresponse=sgn.responseText;
                    if(newresponse==="success"){
                        window.location.href="/project_00/resetpword.php";
                    }
                    if(newresponse==="invalid"){
                        alert("Error occured");
                    }
                }
            }
            }
    });
}
function signvalidate(){
    let issValid=true;
    issValid=signInitValidate("signuname","signunamediv")&&issValid;
    return issValid;
}
function signInitValidate(signInput,signDiv){
    var input=document.getElementById(signInput);
    var div=document.getElementById(signDiv);
    var value=input.value.trim();
    if(signInput==="signuname"){
        issValid=false;
        if(!validateEmail(value)){
            input.classList.add("is-invalid");
            div.innerHTML="Enter a valid E-mail ID";
        }
        else{
            input.classList.remove("is-invalid");
            div.innerHTML="";
            issValid=true;
        }
        return issValid;
    }
}
function validateEmail(email){
    const emailRegex=/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    return emailRegex.test(email);
}
//resetpword
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
        pwordok((result)=>{
            if(result){
                var password=document.getElementById("pword").value.trim();
                var xhr=new XMLHttpRequest();
                xhr.open('POST','/project_00/login/forgotpword/resetupdatepword.php',true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('password='+encodeURIComponent(password));
                xhr.onload = function(){ 
                    if (xhr.status === 200){
                        if(xhr.responseText==="success"){
                            window.location.href="/project_00/login/forgotpword/ckedestroy.php";
                        }
                    }
                };
            }
        });
    });
}
var isOk;
var oldpasswordcmpr;
function pwordok(callback){
    var newpassword=$("#pword").val();
    //oldpassword
    var vfy=new XMLHttpRequest();
    vfy.open('POST','/project_00/login/forgotpword/resetchk.php',true);
    vfy.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    vfy.send('newpassword='+encodeURIComponent(newpassword));
    vfy.onreadystatechange=function(){
        if(vfy.readyState===4&&vfy.status===200){
            oldpasswordcmpr=vfy.response;
            oldpasswordcmpr=(oldpasswordcmpr==="true");
            isOk=true;
            isOk=pword1()&&isOk;
            isOk=pword2(oldpasswordcmpr,"pword","rpword","rpworddiv")&&isOk;
            callback(isOk);
        }
    }
}
function pword1(){
    if(sign1.style.color=="green"&&sign2.style.color=="green"&&sign3.style.color=="green"&&sign4.style.color=="green"){
        return true;
    }
    else{
        return false;
    }
}
function pword2(cmpr,id2,id3,div){
    var idnew2=document.getElementById(id2);
    var idnew3=document.getElementById(id3);
    var divnew=document.getElementById(div);
    if(idnew2.value.trim()==idnew3.value.trim()&&(!(idnew2.value.trim().length==0))){
        idnew3.classList.remove("is-invalid");
        if(cmpr){
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
$(document).ready(()=>{
    $(".cnlbtn").click(()=>{
        window.location.href="login/forgotpword/ckedestroy.php";
    });
});