const express = require('express');
const http = require('http');
const path = require('path');
const phpExpress = require('php-express')({
    binPath : 'php' //Agrege la ruta de su ejecutable PHP
});

const bodyParser = require('body-parser');
const socketIO = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIO(server);

const host = process.env.HOST || 'localhost';
const port = process.env.PORT || 3000;

app.set('port',port);
app.set('views',__dirname);
app.engine('php', phpExpress.engine);
app.set('view engine', 'php');

app.use(bodyParser.urlencoded({extended:false}));
app.use(bodyParser.json());

app.use(express.static(path.join(__dirname,'public')));

app.get('/', (req,res) => {
    res.render('index.php');
});

app.all(/.+\.php$/, phpExpress.router);

io.on('connection', (socket) => {
    console.log('Cliente Websocket conectado');
        io.emit('connection','un usuario se ha conectado');
    socket.on('chat message',(msg) => {
        io.emit('chat message',msg);
    });

    socket.on('disconnect',()=>{
        io.emit('disconnected','Un usuario se ha desconectado');
    });
});

server.listen(port,host, ()=>{
    console.log(`Servidor Node.js en ejecución en http://${host}:${port}`);
});