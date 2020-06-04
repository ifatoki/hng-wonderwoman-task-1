class Intern {
    constructor(fullName, hngId, language, email) {
        this.fullName = fullName;
        this.hngId = hngId;
        this.language = language;
        this.email = email;
    };
    messageLog = () => `Hello World, this is ${this.fullName} with HNGi7 ID ${this.hngId} using ${this.language} for stage 2 task ${this.email}`;
}

const internX = new Intern("Azemoh Israel", "HNG-01761", "JavaScript", "davidisrael194@gmail.com");
console.log(internX.messageLog());