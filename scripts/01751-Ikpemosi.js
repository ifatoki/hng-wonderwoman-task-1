let hngID = "HNG-01751";
let name = "Ikpemosi Arnold";
let language ="JavaScript";
let email = "Ikpemosi@protonmail.com";
let output ="Hello World, this is " + name + " with HNGi7 ID " + hngID + " and email "  + email + " using " + language + " for stage 2 task ";
function sendData(){
    console.log(output);
    var data = JSON.stringify({ "id": hngID, "name" : name, "language" : language, "email":email});
    return data;
}

sendData();
