let hngID = "HNG-01751";
let name = "Ikpemosi Arnold";
let language ="JavaScript";

function sendData(){
    console.log("Hello World, this is " + name + " with HNGi7 ID " + hngID + " using " + language + " for Stage 2 Task");
    var data = JSON.stringify({ "id": hngID, "name" : name, "language" : language});
    return data;
}

sendData();