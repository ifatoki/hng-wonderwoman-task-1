
function show(){

var details =
`{
    "name": "Umoh Esther",
    "hng_id": "HNG-03407",
    "language": "JavaScript",
    "email":"umohesther08@gmail.com"
}`

var json = JSON.parse(details);

console.log(`Hello World, this is ${json.name} with HNGi7 ID ${json.hng_id} using ${json.language} for stage 2 task and ${json.email}`);

}

show();
