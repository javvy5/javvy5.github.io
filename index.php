<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body onload="crearLienzo();">
    
    <div class="container border">
        <br>
        <div class="row justify-content-center">
            <div class="col-md-10 text-center text-primary">
                <h3>PRUEBA CANVAS (PC - MOUSE)</h3>
                <br>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="border border-dark" id="lienzo" style="width: 400px; height: 400px; background: rgb(236, 236, 236);"></div>
        </div>

        <hr>

        <div class="row justify-content-center">
            <div class="col-md text-center">
                <input class="btn btn-outline-danger" type="button" value="Borrar Lienzo" onClick="borrar();">
                <input class="btn btn-outline-primary" name="guardar" type="button" value="Guardar Imagen" onclick="upload();">
            </div>
        </div>

        <hr>

        <div class="row justify-content-center">
            <div class="col-md text-center" id="imagen_div">
                <img class="border" style="width:120px; height:120px" id="imagen" src="uploads/imagen.png">   
            </div>
        </div>

        <hr>

    </div>

    <!-- SCRIPTS -->

    <script type="text/javascript">

        // Variables para contener los sucesivos puntos (x,y) por los que va
        // pasando el ratón, y su estado (pulsado/no pulsado)
        var movimientos = new Array();
        var pulsado;

        function crearLienzo() {

            //Aquí es donde vamos a insertar el código javascript para crear el lienzo
            
            var canvasDiv = document.getElementById('lienzo');
            canvas = document.createElement('canvas');
            canvas.setAttribute('width', 400);
            canvas.setAttribute('height', 400);
            canvas.setAttribute('id', 'canvas');
            canvasDiv.appendChild(canvas);

            if(typeof G_vmlCanvasManager != 'undefined') {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            
            context = canvas.getContext("2d");

            $('#canvas').mousedown(function(e){
                pulsado = true;
                movimientos.push([e.pageX - this.offsetLeft,
                    e.pageY - this.offsetTop,
                    false]);
                repinta();
            });
    
            $('#canvas').mousemove(function(e){
                if(pulsado){
                    movimientos.push([e.pageX - this.offsetLeft,
                        e.pageY - this.offsetTop,
                        true]);
                    repinta();
                }
            });
    
            $('#canvas').mouseup(function(e){
                pulsado = false;
            });
    
            $('#canvas').mouseleave(function(e){
                pulsado = false;
            });

            repinta();
        }

        function repinta() {

            // función para dibujar en el lienzo los movimientos del ratón que hemos
            // recogido en la variable "movimientos"

            canvas.width = canvas.width; // Limpia el lienzo
 
            context.strokeStyle = "#0000a0";
            context.lineJoin = "round";
            context.lineWidth = 6;
            
            for(var i=0; i < movimientos.length; i++)
            {     
                context.beginPath();
                if(movimientos[i][2] && i){
                context.moveTo(movimientos[i-1][0], movimientos[i-1][1]);
                }else{
                context.moveTo(movimientos[i][0], movimientos[i][1]);
                }
                context.lineTo(movimientos[i][0], movimientos[i][1]);
                context.closePath();
                context.stroke();
            }
        }

        function borrar() {
            canvas.width = canvas.width;
            movimientos.length = 0
        }

    </script>

    <script>

        function upload() {
            $.post('php/upload-imagen.php',
            {
                img : canvas.toDataURL()
            },

            function(data) { 

                // Cuando ha finalizado el envío, presenta en pantalla la imagen que ha
                // quedado almacenada en el servidor

                $('#imagen_div').html(data);
                window.location.reload();

            });
        }   
    
    </script>
    
</body>
</html>