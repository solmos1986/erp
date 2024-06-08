<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            margin: 0.5cm;
            font-size: 12px;
            font-family: Helvetica, sans-serif;

        }

        ul {
            list-style: none;
            padding: 0px;
        }
    </style>
</head>

<body style="/* background-color: yellow; */">

    <ul style="margin:0px 40px 8px 45px; text-align: center; ">
        <li style="font-weight: bold; font-size: 15px;">{{ $infoNego->nomNegocio }}</li>
        <li style="padding-top: 5px;">{{ $infoNego->dirNegocio }}</li>
        <li>{{ $infoNego->tel1Negocio }} / {{ $infoNego->tel2Negocio }}</li>
        <li style="padding-top: 7px;">SANTA CRUZ - BOLIVIA</li>
    </ul>
    <hr style="margin:0px 0px 8px 0x; padding-top:0; border-height:0.3px;">
    <ul style="margin:0px 40px 8px 45px; text-align: center; ">
        <li>RECIBO DE VENTA</li>
        <li>No. {{ $ingreso->idIngreso }}</li>
    </ul>
    <hr style="margin:0px 0px 8px 0px; padding-top:0; border-height:0.3px;">
    <table style="padding:0px;">

        <td style="padding: 0px; width:40%;">
            <ul style="margin:0px 0px 8px 0px; text-align: right;">
                <li> Sr.(es) : </li>
                <li> Cod. Cliente : </li>
                <li> Fecha de emision : </li>
            </ul>
        </td>
        <td style="padding: 0px; width:60%;">
            <ul style="margin:0px 0px 8px 0px; text-align: left;">
                <li> {{ $ingreso->nomCliente }}</li>
                <li> {{ $ingreso->idCliente }}</li>
                <li> {{ $ingreso->created_at }}</li>
            </ul>
        </td>

    </table>
    <hr style="margin:0px 0px 8px 0x; padding-top:0; border-height:0.3px;">
    <table style="padding:0px 0px 5px 0px;">
        <tr style="margin:0px 0px 0px 0x; padding-top:0;">
            <td style="min-width:1cm; padding: 0px; text-align: center;">
                COD
            </td>
            <td style="min-width:2cm; padding: 0px; text-align: center;">
                CONCEPTO
            </td>
            <td style="min-width:1cm; padding: 0px; text-align: center;">
                CANT
            </td>
            <td style="min-width:1cm; padding: 0px; text-align: center;">
                P/U
            </td>
            <td style="min-width:2cm; padding: 0px; text-align: center;">
                SUB
                <br> TOTAL
            </td>
        </tr>
    </table>
    <hr style="margin:0px 0px 8px 0x; padding-top:0; border-height:0.3px;">
    <table>

        {{-- EN ESTA TABLE DEBO HACER EL FOREACH --}}
        @foreach ($detalle as $det)
            <tr>
                <td style="min-width:3cm; padding: 0px; text-align: center;">
                    <ul style="margin:0px 0px 8px 0px;  text-align: left;">
                        <li> {{ $det->idProducto }}</li>
                        <li> {{ $det->nomProducto }}</li>
                    </ul>
                </td>
                <td style="min-width:1cm; padding: 0px; text-align: center;">
                    <ul style="margin:1px 0px 8px 0px; text-align: center; ">
                        <li> {{ $det->cantidadVenta }}</li>
                    </ul>
                </td>
                <td style="min-width:1cm; padding: 0px; text-align: center;">
                    <ul style="margin:1px 0px 8px 0px; text-align: center; ">
                        <li> {{ $det->precioVenta }}</li>
                    </ul>
                </td>
                <td style="min-width:2cm; padding: 0px; text-align: center;">
                    <ul style="margin:1px 0px 8px 0px; text-align: center;">
                        <li> {{ $det->subtotal }}</li>
                    </ul>
                </td>
            </tr>
        @endforeach

    </table>
    <table>
        <td style="min-width:7cm; padding: 0px;">
            <ul style="margin:0px 15px 8px 0px; text-align: right;">
                <li> TOTAL Bs. {{ $ingreso->total }}</li>
            </ul>
        </td>
    </table>
    <p>Son: {{ $literal }}</p>
    <hr style="margin:0px 0px 8px 0px; padding-top:0; border-height:0.3px;">
    <ul style="margin:2px 0px 8px 2px;  text-align: left;">
        <li> Usuario : {{ $ingreso->nomUsuario }}</li>
    </ul>
    <ul style="margin:20px 0px 8px 2px;  text-align: center;">
        <li> GRACIAS POR SU PREFERENCIA !!!</li>
    </ul>

</body>


</html>
