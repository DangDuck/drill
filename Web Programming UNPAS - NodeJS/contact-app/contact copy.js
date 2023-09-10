const fs = require("fs");
const readline = require("readline");
const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout,
});

const dirPath = "C:/Users/norep/Desktop/node/drill/contact-app/data";
const filePath = `${dirPath}/contacts.json`;

if (!fs.existsSync(dirPath)) {
    fs.mkdirSync("data");
}

if (!fs.existsSync(filePath)) {
    fs.writeFileSync(filePath, "[]");
}

const file = fs.readFileSync(filePath, "utf-8");

const question = (question) => {
    return new Promise((resolve, reject) => {
        rl.question(question, (answer) => {
            resolve(answer);
        });
    });
};

const saveContact = (name, email, phone) => {
    const contact = { name, email, phone };

    let contacts = JSON.parse(file);

    contacts.push(contact);

    fs.writeFileSync(filePath, JSON.stringify(contacts));

    rl.close();
};

module.exports = {
    question,
    saveContact,
};
