const yargs = require("yargs");
const {
    saveContact,
    listContact,
    findContact,
    removeContact,
} = require("./contact");

yargs
    .command({
        command: "add",
        showInHelp: true,
        describe: "Adding new contact to existing list",
        builder: {
            n: {
                alias: "name",
                describe: "Name to be registered",
                demandOption: true,
                type: "string",
            },
            e: {
                alias: "email",
                describe: "Email to be registered",
                demandOption: false,
                default: "",
                type: "string",
            },
            p: {
                alias: "phone",
                describe: "Phone to be registered",
                demandOption: true,
                type: "string",
            },
        },
        handler(argv) {
            saveContact(argv.n, argv.e, argv.p);
        },
    })
    .demandCommand();

yargs.command({
    command: "list",
    showInHelp: true,
    describe: "List all contacts name and phone number",
    handler() {
        listContact();
    },
});

yargs.command({
    command: "show",
    showInHelp: true,
    describe: "Get the detail of contact given",
    builder: {
        n: {
            alias: "name",
            describe: "Name to be detailed",
            demandOption: true,
            type: "string",
        },
    },
    handler(argv) {
        findContact(argv.n);
    },
});

yargs.command({
    command: "remove",
    showInHelp: true,
    describe: "Remove the given contact",
    builder: {
        n: {
            alias: "name",
            describe: "Name to be removed",
            demandOption: true,
            type: "string",
        },
    },
    handler(argv) {
        removeContact(argv.n);
    },
});

yargs.parse();
