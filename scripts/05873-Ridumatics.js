class HNGIntern {
  constructor(id, name, language, email) {
    this.id = id;
    this.name = name;
    this.language = language;
    this.email = email;
  }

  showInfo() {
    console.log(`Hello World, this is ${this.name} with HNGi7 ID ${this.id} using ${this.language} for stage 2 task ${this.email}`);
  }
}

const ridumatics = new HNGIntern("HNG-05873", "Ridwan Onikoyi", "Javascript", "Onikoyiridwan@gmail.com")
ridumatics.showInfo();