# socketio-php

## Instalamos dependencias

    npm i
    npm install express
    npm install body-parser
    npm install php-express
    npm install socket.io

## Verificamos las dependencias

1.  Abrir package.json
2.  Verificar la similitud

        "dependencies": {
            "body-parser": "^1.20.2",
            "express": "^4.18.2",
            "php-express": "^0.0.3",
            "socket.io": "^4.7.2"
        }

## Configuramos el index.js

1.  Abrir index.js
2.  Configurar la siguiente constante

        const phpExpress = require('php-express')({
            binPath : 'php' //Agrege la ruta de su ejecutable PHP
        });

3.  Coloque la ruta del ejecutable php => `php.exe`

### LISTO :)
