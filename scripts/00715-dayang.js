// Hello World, this is Ciroma Adekunle with HNGi7 ID HNG-1010 using Javascript for stage 2 task abc@example.com


me = {
    name: 'David Ayang',
    id: 'HNG-00715',
    lang: 'Javascript',
    email: 'david.ayang1gmail.com'
}

const introducer = (person) => {
    const intro = `Hello World, this is ${person.name} with HNGi7 ID ${person.id} using ${person.lang} for stage 2 task ${person.email}`
    
    return intro

}

console.log(introducer(me))