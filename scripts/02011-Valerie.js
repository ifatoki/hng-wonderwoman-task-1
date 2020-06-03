const stageTwoTask = (fullName, id, language, email) => {
    if (fullName === 'Valerie Oakhu' && id === 'HNG-02011' && language === 'javascript' && email === 'ooakhu@gmail.com') {
        return (`Hello World, this is ${fullName} with HNGi7 ID ${id} using ${language} for stage 2 task. And my email address is ${email}.`);
    }
}
console.log(stageTwoTask('Valerie Oakhu', 'HNG-02011', 'javascript', 'ooakhu@gmail.com'));