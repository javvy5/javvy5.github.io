<!-- Herramienta creada por Oscar Javier Peña Torres - SENA 2019 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado Cuando Brillo</title>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="shortcut icon" href="favicon.ico">
    <style>
        body {
        background: url('img/Equipo TI 3.png') no-repeat center center fixed;
        background-size: 70%;
        
        }
        .oculto {
        display: none; 
        }
        .seleccionados {
        display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <br>
        <div class="row justify-content-center" >
            <div class="shadow p-3 mb-1 bg-white rounded col-md-8" style="border: 1px solid #999999;">
                <div class="row justify-content-center" >
                    <div class="col-md-10 text-center">
                        <h3 style="color: darkgreen;">Equipo Cuando Brillo / Hora de Innovación</h3>
                        <hr>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4 text-center">
                        <select class="form-control" id="periodo">
                            <option value="">Seleccione un periodo</option>
                            <option value="Del 30 sep al 04 oct">Del 30 sep al 04 oct</option>
                            <option value="Del 07 oct al 11 oct">Del 07 oct al 11 oct</option>
                            <option value="Del 14 oct al 18 oct">Del 14 oct al 18 oct</option>
                            <option value="Del 21 oct al 25 oct">Del 21 oct al 25 oct</option>
                            <option value="Del 28 oct al 01 nov">Del 28 oct al 01 nov</option>
                            <option value="Del 04 nov al 08 nov">Del 04 nov al 08 nov</option>
                            <option value="Del 11 nov al 15 nov">Del 11 nov al 15 nov</option>
                            <option value="Del 18 nov al 22 nov">Del 18 nov al 22 nov</option>
                            <option value="Del 25 nov al 29 nov">Del 25 nov al 29 nov</option>
                            <option value="Del 02 dic al 06 dic">Del 02 dic al 06 dic</option>
                            <option value="Del 09 dic al 13 dic">Del 09 dic al 13 dic</option>
                            <option value="Del 16 dic al 20 dic">Del 16 dic al 20 dic</option>
                            <option value="Del 23 dic al 27 dic">Del 23 dic al 27 dic</option>
                            <option value="Del 30 dic al 03 ene">Del 30 dic al 03 ene</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-10 text-center">
                        <br>
                        <button class="btn btn-primary" onclick="mostrar();">Generar listado</button>
                            &nbsp;
                        <button class="btn btn-success" onclick="grabar();">Grabar Equipo Semanal</button>
                            &nbsp;
                        <button class="btn btn-danger" onclick="reset();">Resetear listado</button>
                        <hr>

                        <div class="oculto">
                            <table class='table table-bordered table-hover'>
                                <thead class='table-info'>
                                    <th width="10%">No</th>
                                    <th>Nombre</th>
                                    <th width="15%">Seleccionar</th>
                                </thead>
                                <tbody class="datos">
                                </tbody>
                            </table>
                        </div>

                        <div class="seleccionados">
                            <table class='table table-bordered table-hover' style='font-size: 24px;'>
                                <thead class='table-primary'>
                                    <th>EQUIPO DE LA SEMANA</th>
                                </thead>
                                <tbody class="datos_2">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script>
        function mostrar() {
            $('.oculto').css('display','block');
            $('.seleccionados').css('display','none');
            $.post('Llamar_users.php', function(data) {
                $('.datos').html(data);
            });
        }

        function grabar() {

            $periodo = $('#periodo').val()

            if ($periodo == '' || $periodo == null) {
                alert('Se debe seleccionar un periodo');
                return;
            }

            var datos = {
                seleccion : []
            }

            // console.log (datos);

            var objOpciones = $('.opciones');
            $.each(objOpciones, function(index, val) {
                var iduser = $(val).attr('id').replace('seleccionado_', '');
                var objValores = {
                    id      :   iduser,
                    valor   :   $(val).val(),
                    periodo :   $('#periodo').val()
                };
                datos.seleccion.push(objValores);
                // console.log (objValores);
            });

            $.post('Grabar.php', datos, function(rta) {
                if (rta == 1) {

                    alert('Listado actualizado exitosamente');

                    $('.oculto').css('display','none');
                    $('.seleccionados').css('display','block');

                    var info = {
                        periodo :   $('#periodo').val()
                    };

                    $.post('Llamar_seleccionados.php', info, function(rta) {
                        $('.datos_2').html(rta);
                    });

                } else {
                    alert('ERROR. No se realizaron cambios en el listado')
                }
            });

        }

        function reset() {

            var r = confirm("Esta acción no puede deshacerse. ¿Desea continuar?");
            if (r == false) {
                return;
            }

            $.post('Reset.php', function(rta) {
                if (rta == 1) {
                    alert('Listado reseteado exitosamente');
                    location.reload();
                } else {
                    alert('ERROR. No se realizaron cambios en el listado');
                    location.reload();
                }
            });
        }
    </script>
    
</body>
</html>