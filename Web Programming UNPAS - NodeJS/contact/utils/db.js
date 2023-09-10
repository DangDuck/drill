const mongoose = require("mongoose");

mongoose.connect("mongodb://127.0.0.1:27017/pwi");

// test adding data
// const contact1 = new Contact({
//     name: "dudu",
//     phone: "0822774433",
//     email: "andudu@gmail.com",
// });

// save to collection
// contact1.save().then((result) => console.log(result));
