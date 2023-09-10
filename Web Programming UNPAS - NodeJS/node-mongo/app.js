const { MongoClient } = require("mongodb");

const uri = "mongodb://127.0.0.1:27017/";
const client = new MongoClient(uri);

async function run() {
    try {
        const database = client.db("pwi");
        const mahasiswa = database.collection("mahasiswa");
    } finally {
        await client.close();
    }
}

run().catch(console.dir);
