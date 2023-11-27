//filter
$(document).ready(function(){
    $("#filteragestart,#filterageend").on("input",function(){
        var startValue=parseInt($("#filteragestart").val());
        var endValue=parseInt($("#filterageend").val());
        var $agediv=$("#agediv");
        if (startValue>=endValue) {
            $agediv.html("<b>Invalid age range</b>");
            $agediv.addClass("invalid-feedback justify-content-start");
            $agediv.removeClass("justify-content-end");
        } else {
            $agediv.html("<p class='m-0 mb-1' id='startage'><b>25</b></p><p class='m-0 mt-1 mx-1' style='font-size:10px;''><b>to</b></p><p class='m-0 mb-1' id='endage'><b>35</b></p><p class='m-0 ms-1' style='font-size:12px; margin-top: 2px !important;''><b>years old</b></p>");
            $("#startage").html('<b>'+startValue+'</b>');
            $("#endage").html('<b>'+endValue+'</b>');
            $("#to").html("<b>to</b>");
            $agediv.removeClass("invalid-feedback justify-content-start");
            $agediv.addClass("justify-content-end");
        }
    });
});
$(document).ready(function(){
    $("#filterincomestart,#filterincomeend").on("input",function(){
        var startValue=parseInt($("#filterincomestart").val());
        var endValue=parseInt($("#filterincomeend").val());
        var $incomediv=$("#incomediv");
        if (startValue>=endValue) {
            $incomediv.html("<b>Invalid income range</b>");
            $incomediv.addClass("invalid-feedback justify-content-start");
            $incomediv.removeClass("justify-content-end");
        } else {
            $incomediv.html("<p class='m-0 mb-1 me-1'><b>&#8377;</b></p><p class='m-0 mb-1' id='startincome'><b>400000</b></p><p class='m-0 mt-1 mx-1' id='to' style='font-size:10px;'><b>to</b></p><p class='m-0 mb-1 me-1' id='startincome'><b>&#8377;</b></p><p class='m-0 mb-1' id='endincome'><b>1200000</b></p>");
            $("#startincome").html('<b>'+startValue+'</b>');
            $("#endincome").html('<b>'+endValue+'</b>');
            $("#to").html("<b>to</b>");
            $incomediv.removeClass("invalid-feedback justify-content-start");
            $incomediv.addClass("justify-content-end");
        }
    });
});
$(document).ready(function(){
    $("#filterincomestart,#filterincomeend,#filteragestart,#filterageend").on("input",function(){
        if(parseInt($("#filterincomestart").val())<parseInt($("#filterincomeend").val())&&parseInt($("#filteragestart").val())<parseInt($("#filterageend").val())){
            document.getElementById("filterapply").disabled=false;
        }
        else{
            document.getElementById("filterapply").disabled=true;
        }
    });
});
//checkin
$(document).ready(function(){
    $(".chkbtn").click(function(){
        var mainId=this.id;
        var numericPart = mainId.replace(/\D/g,'');
        var sfid = parseInt(numericPart, 10);
        window.location.href="checkin.php?sfid="+sfid;
    });
});
//filterval
$(document).ready(function(){
    $("#filterform").submit(function(event){
        event.preventDefault();
        var sfidvalnorm=($("#filterid").val());
        var sfidval=$.trim(sfidvalnorm);
        var religionval=$("#filterreligion").val();
        var communityval=$("#filtercommunity").val();
        var casteval=$("#filtercaste").val();
        var nationalityval=$("#filternationality").val();
        var horoscopeval=$("#filterhoroscope").val();
        var genderval = $("#filtergender").val();
        var agestartval=parseInt($("#filteragestart").val(),10);
        var ageendval=parseInt($("#filterageend").val(),10);
        var incstartval=parseInt($("#filterincomestart").val(),10);
        var incendval=parseInt($("#filterincomeend").val(),10);
        window.location.href='filter.php?sfid='+sfidval+'&religion='+religionval+'&community='+communityval+'&caste='+casteval+'&nationality='+nationalityval+'&horoscope='+horoscopeval+'&gender='+genderval+'&incstart='+incstartval+'&incend='+incendval+'&agestart='+agestartval+'&ageend='+ageendval;            
    });
});
//back
function goBack(){
    window.history.back();
}
//profile
