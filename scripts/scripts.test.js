var fs = require('fs');

fs.readdir('../scripts', (err, files) => {
  if (err) {
    console.log(err);
    process.exit(1);
  }

  if (files) {
    const jsFiles = files.filter((file) => file.endsWith('.js'));
    for (let file of jsFiles) {
      const data = fs.readFileSync(file, 'utf8', (err) => {
        if (err) {
          console.log(err);
          process.exit(1);
        }
      });

      const t = /[0-9]/;

      // assert for keywords && edge cases
      console.assert(
        (data.includes('Hello World, this is') &&
          data.includes('with HNGi7 ID') &&
          data.includes('using JavaScript for stage 2 task') &&
          !data.length < 75) ||
          (!data.length > 115 && t.test(data))
      );
    }
  }
});
