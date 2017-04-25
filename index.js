var speakers;
var numbers;
$(document).ready(function(){
    getTopics();
    
    $("#submit").click(function(){
        // console.log("Button clicked");
        if (validateForm()){
            // console.log("Form validation returned true.");
            signUp();
        }
        else {
            // console.log("Form validation returned false.");
        }
    }
    );//close btn_submit.click

});//close document ready

function signUp(){
    $('#status').html('Connecting to database...');

    var first = $('#first').val();
    var last = $('#last').val();
    var placement = $('#placement').val();
    var params = 
        '&first='+first+
        '&last='+last+
        '&placement='+placement;
    // console.log(params);

    var xhr_signup = new XMLHttpRequest();
    xhr_signup.onreadystatechange = function() {
        if (xhr_signup.status == 200) {
            // console.log("XMLHttpRequest successful");
            // console.log(xhr_signup.responseText);
            $('#status').html(xhr_signup.responseText);
            getTopics();
            $('#first').val("");
            $('#last').val("");
        }
    };
    xhr_signup.open("POST", "signup.php", true);
    xhr_signup.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_signup.send(params);
}

function getTopics(){
    document.getElementById("placement").innerHTML = "<option>Loading options...</option>";
    var xhr_speakers = new XMLHttpRequest();
    var topicsURL = "get_speakers.php";
    xhr_speakers.open("GET",topicsURL, true);
    xhr_speakers.onload = function(){
        if(xhr_speakers.status===200){
            var speakers = JSON.parse(xhr_speakers.responseText);
            var xhr_numbers = new XMLHttpRequest();
            var topicsURL = "get_numbers.php";
            xhr_numbers.open("GET",topicsURL, true);
            xhr_numbers.onload = function(){
                if(xhr_numbers.status===200){
                    var numbers = JSON.parse(xhr_numbers.responseText);
                    //update the placements list
                    var output = "";
                    output += "<option value=''>Select a Placement</option>";
                    for (var i = 0; i < speakers.length; i++){
                        //check if it is already at or above maximum capacity
                        //Need to go through the numbers list and find the right one
                        var openings = true;
                        for (var j=0; j < numbers.length; j++){
                            if(numbers[j]['id'] == speakers[i]['id']){
                                if(parseInt(numbers[j]['studentCount'])>=parseInt(speakers[i]['maxstudents'])){
                                    openings = false;
                                    // console.log(numbers[j]['studentCount']+", "+speakers[i]['maxstudents']);
                                    // console.log(openings);
                                }
                            }
                        }
                        if(openings){
                            output += "<option value="+speakers[i]['id']+">"+speakers[i]['topic']+"</option>\n";
                            
                        }
                    }
                    // console.log(output);
                    $('#placement').html(output);

                } else {
                    // console.log("XML HTTP error: "+xhr_numbers.status);
                    $('#status').html(xhr_numbers.status);
                    }
                };
            xhr_numbers.send();
        }
        else{
            $('#status').html(xhr_numbers.status);
        }
        };
    xhr_speakers.send();
}

function validateForm(){
    var first = $('#first').val();     
    var last = $('#last').val();
    var placement = $('#placement').val();
    
    var alertmessage = "";
    var validated = true;
    
    if (first==""||first==null||first.length<2){
        alertmessage += "First name must be entered.<br>";
        validated = false;
    }
    if (last==""||last==null||last.length<2){
        alertmessage += "Last name must be entered.<br>";
        validated = false;
    }
    if (placement==""||placement==null){
        alertmessage += "Placement must be selected.<br>";
        validated = false;
    }
    if (validated==false){
        $("#status").html("<span style=\"color:red;font-weight:bold;font-size:110%\">"+alertmessage+"</span>");
        window.scrollTo(0,document.body.scrollHeight);
    }
    if (validated){
        $("#status").html("<span style=\"color:red;font-weight:bold;font-size:110%\">"+""+"</span>");
    }
    return validated;      
}