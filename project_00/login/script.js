//Signup
var otpval;
var signuname;
var signunamenew;
var signform=document.getElementById("signform");
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
            xhr.open("POST","unamechk.php",true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send('signunamenew='+encodeURIComponent(signunamenew));
            xhr.onreadystatechange=function(){
                if(xhr.readyState===4&&xhr.status===200){
                    var response=xhr.responseText;
                    if(response==="found"){
                        signuname.classList.add("is-invalid");
                        signunamediv.innerHTML="Username already exists";
                    }
                    if(response==="success"){
                        //sendotp
                        var getotp=document.getElementById("getotp");
                        var vfyotpdiv=document.getElementById("vfyotpdiv");
                        var otpinfo=document.getElementById("otpinfo");
                        otpinfo.classList.remove("invalid-feedback");
                        otpinfo.innerHTML="Sending OTP...";
                        otpval=Math.floor(100000+Math.random()*900000).toString();
                        const otp=new XMLHttpRequest();
                        otp.open("POST","/project_00/sendotp.php",true);
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
                                                getotp.innerHTML="Resend OTP";                                                getotp.innerHTML="Resend OTP";
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
        vfy.open('POST','vfyotp.php',true);
        vfy.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        vfy.send('userotp='+encodeURIComponent(userotp)+'&otpval='+encodeURIComponent(otpvalue));
        vfy.onreadystatechange=function(){
            if(vfy.readyState===4&&vfy.status===200){
                var response=vfy.responseText;
                if(response==="success"){
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
        sgn.open('POST','signup.php',true);
        sgn.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        sgn.send('signunamenew='+encodeURIComponent(signunamenew));
        sgn.onreadystatechange=function(){
            if (sgn.readyState===4&&sgn.status===200) {
                var newresponse=sgn.responseText;
                if(newresponse==="success"){
                    window.location.href="/project_00/login/signup_pgs/signup_pg1.php";
                }
                if(newresponse==="invalid"){
                    alert("Error occured");
                }
            }
        }
     }
});
//login
var logform=document.getElementById("logform");
logform.addEventListener("submit",(event)=>{
    event.preventDefault();
    if(logValidate()){
        var loguname=document.getElementById("loguname");
        var logpword=document.getElementById("logpword");
        var logunamenew=loguname.value.trim();
        var logpwordnew=logpword.value.trim();
        var logunamediv=document.getElementById("logunamediv");
        var logpworddiv=document.getElementById("logpworddiv");
        //xmlrequest
        const xhr=new XMLHttpRequest();
        xhr.open("POST","login.php",true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send('logunamenew='+encodeURIComponent(logunamenew)+'&logpwordnew='+encodeURIComponent(logpwordnew));
        xhr.onreadystatechange=function(){
            if(xhr.readyState===4&&xhr.status===200){
                var response=xhr.responseText;
                if(response==="success"){
                    window.location.href="/project_00/dashboard/intro.php";
                    //modal?
                }
                else if(response==="usernamenotfound"){
                    loguname.classList.add("is-invalid");
                    logunamediv.innerHTML="Username not found";
                }
                else if(response==="invalidpassword"){
                    logpword.classList.add("is-invalid");
                    logpworddiv.innerHTML="Invalid password";
                }
                else{
                    alert('Error occurred: '+response.message);
                }
            }
            else if(xhr.readyState==2||xhr.readyState==3){}
            else{
                alert(xhr.readyState);
            }
        };
    }
});
function logValidate(){
    let isValid=true;
    isValid=logInitValidate("loguname","logunamediv")&&isValid;
    isValid=logInitValidate("logpword","logpworddiv")&&isValid;
    return isValid;
}
function logInitValidate(logInput,logDiv){
    var input=document.getElementById(logInput);
    var div=document.getElementById(logDiv);
    var value=input.value.trim();
    if(logInput==="loguname"){
        isValid=false;
        if(!validateEmail(value)){
            input.classList.add("is-invalid");
            div.innerHTML="Enter a valid E-mail ID";
        }
        else{
            input.classList.remove("is-invalid");
            div.innerHTML="";
            isValid=true;
        }
        return isValid;
    }
    if(logInput==="logpword"){
        isValid=false;
        if(!validatePassword(value)){
            input.classList.add("is-invalid");
            div.innerHTML="Enter a valid password";
        }
        else{
            input.classList.remove("is-invalid");
            div.innerHTML="";
            isValid=true;
        }
        return isValid;
    }
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
function validatePassword(password){
    const passwordRegex=/^(?=.*\S).+$/;
    return passwordRegex.test(password);
}
//showpword
var logcheck=document.getElementById("logcheck");
logcheck.addEventListener("change",()=>{
    var logpword=document.getElementById("logpword");
    if(logcheck.checked){
        logpword.type="text";
    }
    else{
        logpword.type="password";
    }
});
//slidein
var signslide=document.getElementById("signslide");
var logslide=document.getElementById("logslide");
var overlay_1=document.getElementById("overlay-1");
var overlay_2=document.getElementById("overlay-2");
var overlay=document.getElementById("overlay");
signslide.addEventListener("click",()=>{
    overlay_1.style.transform="translateX(100%)";
    overlay_2.style.transform="translateX(0%)";
    overlay.style.transform="translateX(-100%)";
    overlay.style.borderRadius="10px 0px 0px 10px";
});
logslide.addEventListener("click",()=>{
    overlay_1.style.transform="translateX(0%)";
    overlay_2.style.transform="translateX(-100%)";
    overlay.style.transform="translateX(0%)";
    overlay.style.borderRadius="0px 10px 10px 0px";
});
var underlay_1=document.getElementById("underlay-1");
var underlay_2=document.getElementById("underlay-2");
var signsmbtn=document.getElementById("signsmbtn");
var signsmdiv=document.getElementById("signsmdiv");
var logsmbtn=document.getElementById("logsmbtn");
var logsmdiv=document.getElementById("logsmdiv");
const excont=document.getElementById("excont");
signsmbtn.addEventListener("click",()=>{
    underlay_1.classList.remove("d-sm-block");
    underlay_1.classList.add("d-sm-none");
    underlay_2.classList.remove("d-sm-none");
    underlay_2.classList.add("d-sm-block");
    signsmdiv.classList.remove("d-sm-block");
    signsmdiv.classList.add("d-sm-none");
    logsmdiv.classList.remove("d-sm-none");
    logsmdiv.classList.add("d-sm-block");
    excont.classList.add("excont1");
    excont.classList.remove("excont2");
    underlay_1.classList.remove("d-block");
    underlay_1.classList.add("d-none");
    underlay_2.classList.remove("d-none");
    underlay_2.classList.add("d-block");
    signsmdiv.classList.remove("d-block");
    signsmdiv.classList.add("d-none");
    logsmdiv.classList.remove("d-none");
    logsmdiv.classList.add("d-block");
});
logsmbtn.addEventListener("click",()=>{
    underlay_2.classList.remove("d-sm-block");
    underlay_2.classList.add("d-sm-none");
    underlay_1.classList.remove("d-sm-none");
    underlay_1.classList.add("d-sm-block");
    logsmdiv.classList.remove("d-sm-block");
    logsmdiv.classList.add("d-sm-none");
    signsmdiv.classList.remove("d-sm-none");
    signsmdiv.classList.add("d-sm-block");
    excont.classList.add("excont2");
    excont.classList.remove("excont1");
    underlay_2.classList.remove("d-block");
    underlay_2.classList.add("d-none");
    underlay_1.classList.remove("d-none");
    underlay_1.classList.add("d-block");
    logsmdiv.classList.remove("d-block");
    logsmdiv.classList.add("d-none");
    signsmdiv.classList.remove("d-none");
    signsmdiv.classList.add("d-block");
});