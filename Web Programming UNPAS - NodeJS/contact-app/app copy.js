const {question, saveContact} = require('./contact.js');

const main = async () => {
    const name = await question('Your Name: ');
    const email = await question('Your Email: ');
    const phone = await question('Your Phone Number: ');

    saveContact(name, email, phone);
}

main();