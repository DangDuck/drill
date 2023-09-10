const express = require("express");
const expressLayouts = require("express-ejs-layouts");

const { body, validationResult, check } = require("express-validator");
const methodOverride = require("method-override");

const session = require("express-session");
const cookieParser = require("cookie-parser");
const flash = require("connect-flash");

require("./utils/db");
const Contact = require("./model/contact");

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

app.use(methodOverride("_method"));

app.listen(port, () => {
    console.log(`Server is listening at http://127.0.0.1:${port}`);
});

// home page
app.get("/", (req, res) => {
    res.render("index", {
        layout: "layouts/main",
        title: "Home",
    });
});

// contact pages
app.get("/contact", async (req, res) => {
    const contacts = await Contact.find();

    res.render("contact/contact", {
        layout: "layouts/main",
        title: "Contact",
        contacts,
        msg: req.flash("msg"),
    });
});

// insert
app.post(
    "/contact",
    [
        body("name").custom(async (value) => {
            const isDuplicate = await Contact.findOne({ name: value });
            if (isDuplicate) {
                throw new Error("Name existed");
            }
            return true;
        }),
        check("email", "Email invalid!").isEmail(),
        check("phone", "Phone number invalid!").isMobilePhone("id-ID"),
    ],
    (req, res) => {
        const errors = validationResult(req);
        if (!errors.isEmpty()) {
            res.render("contact/addContact", {
                layout: "layouts/main",
                title: "New Contact",
                errors: errors.array(),
            });
        } else {
            Contact.insertMany(req.body).then((result) => {
                req.flash("msg", "New contact added");
                res.redirect("/contact");
            });
        }
    }
);

// add
app.get("/contact/add", (req, res) => {
    res.render("contact/addContact", {
        layout: "layouts/main",
        title: "New Contact",
    });
});

// delete
app.delete("/contact", (req, res) => {
    Contact.deleteOne({ _id: req.body._id }).then((result) => {
        req.flash("msg", "Contact deleted");
        res.redirect("/contact");
    });
});

// edit
app.get("/contact/edit/:name", async (req, res) => {
    const contact = await Contact.findOne({ name: req.params.name });
    if (!contact) {
        res.status(404);
        res.send("<h1>404</h1>");
    } else {
        res.render("contact/editContact", {
            layout: "layouts/main",
            title: "Edit Contact",
            contact,
        });
    }
});

// update
app.put(
    "/contact",
    [
        body("name").custom(async (value, { req }) => {
            const isDuplicated = await Contact.findOne({ name: value });
            if (value !== req.body.oldName && isDuplicated) {
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
                contact: req.body,
            });
        } else {
            Contact.updateOne(
                { _id: req.body._id },
                {
                    $set: {
                        name: req.body.name,
                        email: req.body.email,
                        phone: req.body.phone,
                    },
                }
            ).then((result) => {
                req.flash("msg", "Contact updated");
                res.redirect("/contact");
            });
        }
    }
);

// show
app.get("/contact/:name", async (req, res) => {
    const contact = await Contact.findOne({ name: req.params.name });

    res.render("contact/showContact", {
        layout: "layouts/main",
        title: "Detail Contact",
        contact,
    });
});
