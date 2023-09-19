
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba-Tecnica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="d-flex flex-column vh-100 overflow-hidden">
    <h1 class="display-1 text-center bg-gray bg-dark text-light">Bienvenido a un Chat desarrollado con Socket IO</h1>
    
    <div class="d-flex bg-light h-100">
        <div class="bg-dark overflow-scroll" style="width: 20%" id='infos'>
        </div>
        <div class="bg-light overflow-scroll w-100 border border-2 border-dark" id='messages'></div>
    </div>

    <form action="" id='form' class="d-flex fixed-bottom justify-content-around text-light">
        <input type="text" id='input' class="bg-secondary w-75 text-light border border-1 border-dark">
        <input type="submit" class="w-25 bg-info font-weight-bold border border-3 border-dark" value="SEND">
    </form>
    
</body>
    <script src='/socket.io/socket.io.js'></script>
    <script>
        var socket = io();

        var messages = document.getElementById('messages');
        var form = document.getElementById('form');
        var input = document.getElementById('input');
        var infos = document.getElementById('infos');

        form.addEventListener('submit', function(e){
            e.preventDefault();
            if(input.value){
                socket.emit('chat message', input.value);
                input.value = '';
            }
        });

        socket.on('chat message', function(msg){
            let item = document.createElement('p');
            item.classList.add("bg-light", "rounded", "border", "border-2", "border-dark", "w-50", "py-2", "px-1", "m-4", "font-weight-bold", "text-secondary", "text-center");
            item.textContent = msg;
            messages.appendChild(item);
            window.scrollTo(0, document.body.scrollHeight);
        });

        socket.on('disconnected', function(msg){
            let item = document.createElement('p');
            item.classList.add("bg-dark", "rounded", "border", "border-2", "border-danger", "mx-1", "p-1", "my-3", "text-center", "text-danger");
            item.textContent = msg;
            infos.appendChild(item);
            window.scrollTo(0, document.body.scrollHeight);
            if(infos.children.length>10){
                infos.removeChild(infos.children[0]);
            }
        });

        socket.on('connection', function(msg){
            let item = document.createElement("p"); 
            item.classList.add("bg-dark", "rounded", "border", "border-2", "border-success", "mx-1", "p-1", "my-3", "text-center", "text-success");
            item.textContent = msg;
            infos.appendChild(item);
            window.scrollTo(0, document.body.scrollHeight);
            if(infos.children.length>10){
                infos.removeChild(infos.children[0]);
            }
        });
    </script>
</html>