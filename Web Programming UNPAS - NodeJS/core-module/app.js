// Core Module
// File System

// const fs = require('fs');

// console.log(fs);
// try {
//     fs.writeFileSync('data/test.txt', 'Hello World!');
// } catch (e) {
//     console.log(e);
// }
// fs.writeFileSync('data/test.txt', 'Hello World!');

// fs.writeFile('test.txt', 'Hellow!', (e) => {
//     console.log(e);
// })

// const data = fs.readFile('test.txt', 'utf-8', (e, data) => {
//     if (e) throw e;
//     console.log('>>>', data);
// })

// console.log(data);

// const readline = require('readline');
// const rl = readline.createInterface({
//     input: process.stdin,
//     output: process.stdout
// })

// rl.question('Hi, who are you?', (name)=>{
//     console.log(`Oh, you are ${name}`);
//     rl.question('How about your age??', (age)=>{
//         console.log(`Oh, you are ${age}`);
//         rl.close()
//     })
// })

const fs = require('fs')
const readline = require('readline')
const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout,
})

rl.question('Your Name: ', (name) => {
    rl.question('Your Age: ' , (age) => {
        const contact = {
            name,
            age,
        };

        // pastiin ada directory
        if (!fs.existsSync('data/contacts.json')){
            fs.mkdir('data', (err) => {if (err) throw err;})
            fs.writeFileSync('data/contacts.json', "[]")
        };
        
        const file = fs.readFileSync('data/contacts.json', 'utf-8');

        let contacts = JSON.parse(file);
        contacts.push(contact);

        fs.writeFile('data/contacts.json', JSON.stringify(contacts), (err) => {if (err) throw err;})

        console.log('Thanks!');
        rl.close();
    })
})