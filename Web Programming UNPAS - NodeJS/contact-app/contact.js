const fs = require("fs");
const chalk = require("chalk");
const validator = require("validator");

const dirPath = "C:/Users/norep/Desktop/node/drill/contact-app/data";
const filePath = `${dirPath}/contacts.json`;

if (!fs.existsSync(dirPath)) {
    fs.mkdirSync("data");
}

if (!fs.existsSync(filePath)) {
    fs.writeFileSync(filePath, "[]");
}

const file = fs.readFileSync(filePath, "utf-8");
let contacts = JSON.parse(file);

const saveContact = (name, email, phone) => {
    const contact = { name, email, phone };

    const isDuplicate = contacts.find((contact) => contact.name === name);

    if (isDuplicate) {
        console.log(chalk.red.inverse.bold("Contact found! Try other name!"));
        return false;
    }

    if (email) {
        if (!validator.isEmail(email)) {
            console.log(chalk.red.inverse.bold("Email is not valid!"));
            return false;
        }
    }

    if (!validator.isMobilePhone(phone, "id-ID")) {
        console.log(chalk.red.inverse.bold("Phone number is not valid!"));
        return false;
    }

    contacts.push(contact);

    fs.writeFileSync(filePath, JSON.stringify(contacts));
};

const listContact = () => {
    console.log("Contact List:");
    contacts.forEach((contact, i) => {
        console.log(`${i + 1}. ${contact.name} - ${contact.phone}`);
    });
};

const findContact = (name) => {
    const contact = contacts.find(
        (contact) => contact.name.toLowerCase() === name.toLowerCase()
    );

    if (!contact) {
        console.log(chalk.red.inverse.bold(`${name} not found!`));
        return false;
    }
    console.log(`Detail of ${name}`);
    console.log(`Email: ${contact.email}`);
    console.log(`Phone Number: ${contact.phone}`);
    return true;
};

const removeContact = (name) => {
    const newContacts = contacts.filter(
        (contact) => contact.name.toLowerCase() !== name.toLowerCase()
    );

    if (newContacts.length === contacts.length) {
        console.log(chalk.red.inverse.bold(`${name} not found!`));
        return false;
    }

    fs.writeFileSync(filePath, JSON.stringify(newContacts));
    console.log(`${name} removed!`);
};

module.exports = {
    saveContact,
    listContact,
    findContact,
    removeContact,
};
