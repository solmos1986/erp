<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Notificacion</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .color {
            background: #f0f0f0;
            padding: 20px;
        }

        thead {
            font-weight: bold;
        }

        tbody {
            font-weight: lighter;
        }
    </style>
</head>

<body>
    <h2>NOTIFICACION DE SISTEMA</h2>
    <div class="color">
        <h3>
            Informacion para el actualizar equipo de control de acceso
        </h3>
        <h4>Inscripciones nuevas</h4>
        <table>
            <thead>
                <tr>
                    <th>idDetalleInscripcion</th>
                    <th>Nombre completo</th>
                    <th>Doc identidad</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inscripcion_nuevas as $inscripcion)
                    <tr>
                        <th>{{ $inscripcion->idInscripcion }}</th>
                        <th>{{ $inscripcion->nomCliente }}</th>
                        <th>{{ $inscripcion->docCliente }}</th>
                        <th>{{ $inscripcion->fechaInicio }}</th>
                        <th>{{ $inscripcion->fechaFin }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4>Inscripciones eliminadas</h4>
        <table>
            <thead>
                <tr>
                    <th>idDetalleInscripcion</th>
                    <th>Nombre completo</th>
                    <th>Doc identidad</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inscripcion_eliminar as $inscripcion)
                    <tr>
                        <th>{{ $inscripcion->idInscripcion }}</th>
                        <th>{{ $inscripcion->nomCliente }}</th>
                        <th>{{ $inscripcion->docCliente }}</th>
                        <th>{{ $inscripcion->fechaInicio }}</th>
                        <th>{{ $inscripcion->fechaFin }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin: 20px">

    </div>
    <div class="color">
        <h3>
            Se ejecuto el proceso automatico de actualizacion de estados inscripciones - hora de ejecucion
            {{ date('Y/m/d H:i:s') }} (procedimiento almacenado)
        </h3>
    </div>
    <br>
    <p>ip origen:<strong>{{ getHostByName(getHostName()) }}</strong>
        ambiente:<strong>{{ env('APP_ENVIROMENT') }}</strong> </p>
</body>

</html>
