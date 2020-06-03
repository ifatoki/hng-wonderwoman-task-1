let hngID = "HNG-01751";
let name = "Ikpemosi Arnold";
let language ="JavaScript";
let email = "Ikpemosi@protonmail.com";
<<<<<<< HEAD
let output = "Hello World, this is " + name + " with HNGi7 ID " + hngID + " using " + language + " for stage 2 task " + email;
function sendData(){
    console.log(output);
=======

function sendData(){
    console.log("Hello World, this is " + name + " with HNGi7 ID " + hngID + " using " + language + " for stage 2 task");
>>>>>>> 907d9a56ca274a365a02a34e7f08a2197dd29ab4
    var data = JSON.stringify({ "id": hngID, "name" : name, "language" : language, "email":email});
    return data;
}

sendData();
