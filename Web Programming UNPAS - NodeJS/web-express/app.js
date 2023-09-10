const express = require("express");
const expressLayouts = require("express-ejs-layouts");
const { body, validationResult, check } = require("express-validator");
const {
    loadContacts,
    showContact,
    addContact,
    duplicateCheck,
    deleteContact,
    updateContact,
} = require("./utils/contacts");
const session = require("express-session");
const cookieParser = require("cookie-parser");
const flash = require("connect-flash");

const app = express();
const port = 3000;

app.set("view engine", "ejs");
app.use(expressLayouts);

app.use(express.static("public"));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// flash configuration
app.use(cookieParser("secret"));
app.use(
    session({
        cookie: { maxAge: 6000 },
        secret: "secret",
        resave: true,
        saveUninitialized: true,
    })
);
app.use(flash());

app.get("/", (req, res) => {
    res.render("index", {
        layout: "layouts/main",
        title: "Home",
    });
});

app.get("/about", (req, res) => {
    res.render("about", {
        layout: "layouts/main",
        title: "About",
    });
});

app.get("/contact", (req, res) => {
    const contacts = loadContacts();
    res.render("contact/contact", {
        layout: "layouts/main",
        title: "Contact",
        data: {
            contacts,
            msg: req.flash("msg"),
        },
    });
});

app.post(
    "/contact",
    [
        body("name").custom((value) => {
            const isDuplicate = duplicateCheck(value);
            if (isDuplicate) {
                throw new Error("Name existed");
            }
            return true;
        }),
        check("email", "Email invalid!").isEmail(),
        check("phone", "Phone number invalid").isMobilePhone("id-ID"),
    ],
    (req, res) => {
        const errors = validationResult(req);
        if (!errors.isEmpty()) {
            // return res.status(400).json({ errors: errors.array() });
            res.render("contact/addContact", {
                layout: "layouts/main",
                title: "New Contact",
                errors: errors.array(),
            });
        }

        addContact(req.body);
        req.flash("msg", "New contact added");
        res.redirect("/contact");
    }
);

app.get("/contact/add", (req, res) => {
    res.render("contact/addContact", {
        layout: "layouts/main",
        title: "New Contact",
    });
});

app.get("/contact/delete/:name", (req, res) => {
    const contact = showContact(req.params.name);
    if (!contact) {
        res.status(404);
        res.send("<h1>404</h1>");
    } else {
        deleteContact(req.params.name);
        req.flash("msg", "Contact deleted");
        res.redirect("/contact");
    }
});

app.get("/contact/edit/:name", (req, res) => {
    const contact = showContact(req.params.name);
    if (!contact) {
        res.status(404);
        res.send("<h1>404</h1>");
    } else {
        res.render("contact/editContact", {
            layout: "layouts/main",
            title: "Edit Contact",
            data: {
                contact,
            },
        });
    }
});

app.post(
    "/contact/update",
    [
        body("oldName").custom((value) => {
            const isExist = duplicateCheck(value);
            if (!isExist) {
                throw new Error("Name not existed");
            }
            return true;
        }),
        body("name").custom((value, { req }) => {
            const isDuplicated = duplicateCheck(value);
            if (value !== req.body.name && isDuplicated) {
                throw new Error("Name is Duplicated");
            }
            return true;
        }),
        check("email", "Email invalid!").isEmail(),
        check("phone", "Phone number invalid").isMobilePhone("id-ID"),
    ],
    (req, res) => {
        const errors = validationResult(req);
        if (!errors.isEmpty()) {
            res.render("contact/editContact", {
                layout: "layouts/main",
                title: "Edit Contact",
                errors: errors.array(),
                data: {
                    contact: req.body,
                },
            });
        } else {
            updateContact(req.body);
            req.flash("msg", "Contact updated");
            res.redirect("/contact");
        }
    }
);

app.get("/contact/:name", (req, res) => {
    const contact = showContact(req.params.name);

    res.render("contact/showContact", {
        layout: "layouts/main",
        title: "Detail Contact",
        data: {
            contact,
        },
    });
});

app.use("/", (req, res) => {
    res.status(404);
    res.send("404");
});

app.listen(port, () => {});
