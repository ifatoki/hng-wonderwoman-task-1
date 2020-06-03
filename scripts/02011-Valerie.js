const stageTwoTask = (name, id, email, language) => {
    if (name === 'Valerie Oakhu' && id === 'HNG-02011' && language === 'Javascript' && email === 'ooakhu@gmail.com') {
        return (`Hello World, this is ${name} with HNGi7 ID ${id} and email ${email} using ${language} for stage 2 task`);
    }
}
console.log(stageTwoTask('Valerie Oakhu', 'HNG-02011', 'ooakhu@gmail.com', 'Javascript'));