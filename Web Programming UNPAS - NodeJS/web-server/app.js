const http = require("http");
const fs = require("fs");

const renderHTML = (path, res) => {
    fs.readFile(path, (err, data) => {
        if (err) {
            res.writeHead(404);
            res.write("Error: File not found!");
        } else {
            res.write(data);
        }
        res.end();
    });
};

http.createServer((req, res) => {
    res.writeHead(200, {
        "Content-Type": "text/html",
    });

    const url = req.url;
    console.log(url);

    if (url === "/" || url === "/home") {
        renderHTML("./views/index.html", res);
    } else if (url === "/about") {
        renderHTML("./views/about.html", res);
    } else {
        renderHTML("./views/404.html", res);
    }
}).listen(3000, () => {
    console.log("Server is listening on port 3000...");
});
