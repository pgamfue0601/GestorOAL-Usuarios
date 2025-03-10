<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Document</title> <!-- Added title for the document -->
    </head>
    <body>
        <style>
            @page {
                size: A4 landscape; /* Cambiado a horizontal para mejor distribución */
                margin: 10mm;
            }
            
            body {
                margin: 0;
                width: 100%;
                font-family: Arial, sans-serif;
            }

            .table-container {
                width: 100%;
                overflow-x: auto;
                padding: 10mm;
            }
            
            table {
                
                border-collapse: collapse;
                width: 100%;
                background-color: #fff;
                table-layout: fixed;
                font-size: 8pt;
            }
            
            th, td {
                border: 0.5pt solid #ddd;
                padding: 2mm;
                text-align: left;
                overflow: visible; /* Cambiado de hidden a visible */
                vertical-align: top; /* Alinea el contenido arriba */
                height: auto; /* Permite que la altura se ajuste al contenido */
                word-wrap: break-word; /* Permite que las palabras se rompan */
                white-space: normal; /* Permite múltiples líneas */
            }

            /* Ajustamos los anchos para compensar el texto multilínea */
            th:nth-child(1), td:nth-child(1) { width: 8%; min-height: 20mm; } /* Nombre */
            th:nth-child(2), td:nth-child(2) { width: 10%; min-height: 20mm; } /* Apellidos */
            th:nth-child(3), td:nth-child(3) { width: 7%; min-height: 20mm; } /* Sexo */
            th:nth-child(4), td:nth-child(4) { width: 8%; min-height: 20mm; } /* Fecha nacimiento */
            th:nth-child(5), td:nth-child(5) { width: 8%; min-height: 20mm; } /* Teléfono */
            th:nth-child(6), td:nth-child(6) { width: 8%; min-height: 20mm; } /* DNI */ 
            th:nth-child(7), td:nth-child(7) { width: 8%; min-height: 20mm; } /* Ocupación 1 */
            th:nth-child(8), td:nth-child(8) { width: 8%; min-height: 20mm; } /* Ocupación 2 */
            th:nth-child(9), td:nth-child(9) { width: 8%; min-height: 20mm; } /* Ocupación 3 */
            th:nth-child(10), td:nth-child(10) { width: 6%; min-height: 20mm; } /* Discapacidad */
            th:nth-child(11), td:nth-child(11) { width: 7%; min-height: 20mm; } /* Estudios */
            th:nth-child(12), td:nth-child(12) { width: 9%; min-height: 20mm; } /* Disponibilidad */
            th:nth-child(13), td:nth-child(13) { width: 5%; min-height: 20mm; } /* Carnet */
            th:nth-child(14), td:nth-child(14) { width: 7%; min-height: 20mm; } /* Localidad */
            th:nth-child(15), td:nth-child(15) { width: 10%; min-height: 20mm; } /* Observaciones */

            th {
                background-color: #f2f2f2;
                font-weight: bold;
                position: sticky;
                top: 0;
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            @media print {
                .table-container {
                    padding: 0;
                }
                
                table {
                    page-break-inside: auto;
                }
                
                tr {
                    page-break-inside: avoid;
                    page-break-after: auto;
                }
                
                thead {
                    display: table-header-group;
                }
            }
        </style>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Sexo</th>
                        <th>Fecha de nacimiento</th>
                        <th>Teléfono</th>
                        <th>DNI/NIE</th>
                        <th>Ocupación 1</th>
                        <th>Ocupación 2</th>
                        <th>Ocupación 3</th>
                        <th>Discapacidad</th>
                        <th>Estudios</th>
                        <th>Disponibilidad</th>
                        <th>Carnet</th>
                        <th>Localidad</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($fromSearch == true)
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario['nombre'] }}</td>
                            <td>{{ $usuario['apellidos'] }}</td>
                            <td>{{ $usuario['sexo'] }}</td>
                            <td>{{ $usuario['edad'] }}</td>
                            <td>{{ $usuario['telefono'] }}</td>
                            <td>{{ $usuario['dni'] }}</td>
                            <td>{{ $usuario['ocupacion'] }}</td>
                            <td>{{ $usuario['ocupacion2'] }}</td>
                            <td>{{ $usuario['ocupacion3'] }}</td>
                            <td>{{ $usuario['discapacidad'] }}</td>
                            <td>{{ $usuario['estudios'] }}</td>
                            <td>{{ $usuario['disponibilidad'] }}</td>
                            <td>{{ explode(" ", $usuario['carnet'])[0] }}</td>
                            <td>{{ explode("-", $usuario['localidad'])[0] }}</td>
                            <td>{{ $usuario['observaciones'] }}</td>
                        </tr>
                        @endforeach
                    @else
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->apellidos }}</td>
                            <td>{{ $usuario->sexo }}</td>
                            <td>{{ $usuario->edad }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->dni }}</td>
                            <td>{{ $usuario->ocupacion }}</td>
                            <td>{{ $usuario->ocupacion2 }}</td>
                            <td>{{ $usuario->ocupacion3 }}</td>
                            <td>{{ $usuario->discapacidad }}</td>
                            <td>{{ $usuario->estudios }}</td>
                            <td>{{ $usuario->disponibilidad }}</td>
                            <td>{{ $usuario->carnet }}</td>
                            <td>{{ explode("-", $usuario->localidad)[0] }}</td>
                            <td>{{ $usuario->observaciones }}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </body>
</html>