<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body {
                font-family: 'Helvetica';
                font-size: 15px;
            }
            .header {
                width: 100%;
                font-size: 9px;
                position: relative;
                display: block;
            }
            .header div {
                display: inline-block;
            }
            #mayorLOGO {
                float: right;
                margin-top: -10px;
            }
            #selloVehiculo {
                float: right;
                margin-top: -1px;
                margin-bottom: -35px;
                margin-left: 5px;
            }
            table, td, th {
                border: 1px #000 solid;
            }
            td {
                font-size: 12px;
                padding: 2px 1px;
            }
            table {
                border-collapse: collapse;
                margin-top: -10px;
                width:95%;
                align: center;
                text-align: center;
            }
            .details td, h4 {
                text-align: center;
            }
            .details .object-payment {
                text-align: left;
                padding-left: 3px;
            }
            .tables {
                display:block;
                border-color: red;
                border-width: 1.5px;
                border-style: solid;
                margin-top: -6px;
            }
            .bill-info {
                width: 100%;
                clear: both;
                font-weight: bold;
            }
            .col-bill-info {
                float: left;
                width: 50%;
                font-size: 16px;
            }
            .total-amount {
                text-align: right;
            }
            .miscellaneus {
                font-size: 12px;
            }
            caption {
                font-weight: bold;
            }
            th {
                font-size: 10px;
                padding: 3px 1px;
            }
            .row {
                display: block;
                padding-left: 10px;
            }
            .text-center {
                text-align: center;
            }
            .bottom {
                width: 95%;
                height: 130px;
                text-transform: uppercase;
                font-weight: 700;
                font-size: 11px;
                margin: auto;
                margin-top: 7%;
                margin-bottom: -2%;
            }
            .center {
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>
        @for($i=1; $i<=2; ++$i)
        <div class="container">
            <div class="header">
                <div class="sumatLOGO">
                    <img src="{{ asset('/assets/images/logo_sumat.png') }}" height="90px" width="230px" alt="sumatlogo"/>

                </div>
                <div class="description text-center">
                <p>
                    REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
                    ESTADO SUCRE<br>
                    ALCALDÍA DEL MUNICIPIO BERMÚDEZ<br>
                    SUPERINTENDENCIA MUNICIPAL DE ADMINISTRACIÓN TRIBUTARIA<br>
                    RIF: G-20000222-1<br>
                    DIRECCIÓN: AV. CARABOBO, EDIFICIO MUNICIPAL
                    </p>
                </div>
                <div id="mayorLOGO">
                    <img src="{{ asset('/assets/images/logo_alcaldia.jpg') }}" height="80px" width="130px" alt="logo" />
                </div>
            </div>

            <div class="tables">
                <h4 style="margin-top: 1px;" >PATENTE DE VEHÍCULO</h4>
            <table class="center">
                <thead>
                    <tr>
                        <th colspan="2" style="font-size: 12px; padding: 2px 1px;"><strong>Nº DE REGISTRO</strong> {{ $license->num }} DE FECHA {{ $license->emission_date }}</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td width="80%"><strong>RAZÓN SOCIAL:</strong> {{ $license->taxpayer->name }}</td>
                        <td width="20%"><strong>RIF DEL CONTRIBUYENTE: </strong>{{ $license->taxpayer->rif }}</td>
                    </tr>
                    <tr>
                        <td width="60%"><strong>REPRESENTANTE:</strong> {{ $representation->name }}</td>
                        <td width="40%"><strong>C.I:</strong> {{ $representation->document }}</td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>DIRECCIÓN:</strong> {{ $license->taxpayer->fiscal_address }}</td>
                  </tr>
                  <tr>
                    <td width="40%">
                    <strong>PARÁMETRO:</strong> {{ $vehicle->vehicleClassification->vehicleParameter->name  }}
                    </td>
                    <td width="60%">
                        <strong>CLASIFICACIÓN DEL VEHÍCULO:</strong> {{ $vehicle->vehicleClassification->name }}
                    </td>
                  </tr>

                    <tr width="100%">
                        <td colspan="1" width="50%">
                            <strong>MARCA:</strong> {{ $vehicle->vehicleModel->brand->name }}
                        </td>
                        <td colspan="1" width="50%">

                            <strong>MODELO:</strong> {{ $vehicle->vehicleModel->name }}
                        </td>
                    </tr>
                    <tr width="100%">
                        <td colspan="1" width="50%">
                            <strong>COLOR:</strong> {{ $vehicle->color->name }}
                        </td>
                        <td colspan="1" width="50%">
                            <strong>PLACA:</strong> {{ $vehicle->plate }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"><strong>PERIODO DE VIGENCIA:</strong> {{ $period }}</td>
                    </tr>


                </tbody>
            </table>
            <div>

                <div id="selloVehiculo" style=" z-index: 2;">
                    <img src="{{ asset('/assets/images/selloVehiculo.png') }}" height="70px" width="170px"/>
                </div>

                <div class="bottom text-center" style="z-index: -1;">
                    <span class="row">{{ $signature->title }}</span>
                    <span class="row">superintendente de administración tributaria</span>
                    <span class="row">{{ $signature->decree }}</span>
                    <span class="row">GACETA MUNICIPAL EXTRAORDINARIA Nº 378 DE FECHA 30-11-2021</span>
                    <span style="font-size: 6px"> </span>
                    @if($license->correlative->correlative_type_id == 1)
                    <span class="row">REFERENCIA: Registro de Patente de Vehículo</span>
                    @else
                    <span class="row">REFERENCIA: Renovación de Patente de Vehículo</span>
                    @endif
                    <span class="row">Correspondiente al Registro {{ $license->num }} de Fecha {{$license->emission_date }} Tasa Administrativa pagada en fecha {{ $processedAt }} con Factura Nº {{ $payment->num }}</span>

                </div>
            </div>
			<div class="bandera" >
                    <img src="{{ asset('/assets/images/bandera.png') }}" height="35px" width="99.9%" alt="bandera"/>
             </div>

        </div>

        </div>
        <br>
        @endfor

    </body>
</html>
