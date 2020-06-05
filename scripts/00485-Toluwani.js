const firstname = "Toluwani";
const surname = "Elemosho";
const fullname = `${firstname} ${surname}`;
const id = "HNG-00485";
const language = "Javascript";
const email = "toluwanielemosho@gmail.com";

const firstTask = (name, id, language, email) => {
  console.log(
    `Hello World, this is ${name} with HNGi7 ID ${id} using ${language} for stage 2 task ${email}`
  );
};

firstTask(fullname, id, language, email);
