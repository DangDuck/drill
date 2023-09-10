const fs = require("fs");

const dirPath = "./data";
const filePath = `${dirPath}/contacts.json`;

if (!fs.existsSync(dirPath)) {
    fs.mkdirSync("data");
}

if (!fs.existsSync(filePath)) {
    fs.writeFileSync(filePath, "[]");
}

const loadContacts = () => {
    const file = fs.readFileSync(filePath, "utf-8");
    let contacts = JSON.parse(file);

    return contacts;
};

const showContact = (name) => {
    const contacts = loadContacts();
    const contact = contacts.find(
        (contact) => contact.name.toLowerCase() === name.toLowerCase()
    );

    if (!contact) {
        return false;
    }

    return contact;
};

const saveContacts = (contacts) => {
    fs.writeFileSync(filePath, JSON.stringify(contacts));
};

const duplicateCheck = (name) => {
    const contacts = loadContacts();
    const isDuplicate = contacts.find((contact) => contact.name === name);

    return isDuplicate;
};

const addContact = (contact) => {
    const contacts = loadContacts();
    contacts.push(contact);
    saveContacts(contacts);
};

const deleteContact = (name) => {
    const contacts = loadContacts();
    const newContacts = contacts.filter(
        (contact) => contact.name.toLowerCase() !== name.toLowerCase()
    );
    if (newContacts.length === contacts.length) {
        return false;
    }
    saveContacts(newContacts);
};

const updateContact = (updated) => {
    const contacts = loadContacts();
    const newContacts = contacts.filter(
        (contact) => contact.name.toLowerCase() !== updated.name.toLowerCase()
    );
    if (newContacts.length === contacts.length) {
        return false;
    }

    delete updated.oldName;

    newContacts.push(updated);

    saveContacts(newContacts);
};

module.exports = {
    loadContacts,
    showContact,
    duplicateCheck,
    addContact,
    deleteContact,
    updateContact,
};
