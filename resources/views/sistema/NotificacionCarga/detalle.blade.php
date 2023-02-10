<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind&display=swap');

        body {
            margin: 0px;
            font-family: 'Hind', sans-serif;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #002060;
            widows: 100%;
            height: 77px;
        }

        .contenido {
            display: flex;
            align-items: center;
            flex-direction: column;
            width: 100%;
            padding-top: 20px
        }

        /*  */
        .grid-carga-n {
            border: 1px solid #EBEBEB;
            border-radius: 10px;
            padding: 24px;
            width: 90%;
        }

        .datos-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 5px;
        }

        .datos-row div {
            margin-top: 24px;
        }

        .bold {
            font-weight: bold;
        }

        .grid-img-cargas {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-top: 24px;
            gap: 40px;
            border: 1px solid #EBEBEB;
            border-radius: 10px;
            padding: 24px;
        }

        .grid-img-cargas div img {
            margin-top: 12px;
            max-height: 200px;
            max-width: 250px;
        }

        .div-contenido {
            padding: 48px 40px 48px 40px;
            background-color: white;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <form method="" action="{{ route('detalle.carga.correo',['id'=>$detalleCarga->car_id, 'token'=>$detalleCarga->car_token]) }}" class="">
        @csrf
        <header>
            <img src="{{ asset('web/imagenes/logo-blanco.svg') }}" alt="">

        </header>

        <div class="contenido">
            <div class="grid-carga-n">
                <div>
                    <h3>Datos del camión</h3>
                    <div class="datos-row">
                        <div>
                            <p>Patente</p>
                            <p class="bold">{{$detalleCarga->patente->pat_patente}}</p>
                        </div>

                        <div>
                            <p>Tipo de carga</p>
                            <p class="bold">{{$detalleCarga->tipoCarga->tic_nombre}}</p>
                        </div>

                        <div>
                            <p>Nombre del chofer</p>
                            <p class="bold">{{$detalleCarga->chofer->cho_nombre}}</p>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <div class="grid-carga-n">
                <div>
                    <h3>Ruta</h3>
                    <div class="datos-row">
                        <div>
                            <p>Fecha y hora de despacho</p>
                            <p class="bold">{{$detalleCarga->car_fecha_salida->format('d-m-Y / H:i')}}</p>
                        </div>

                        <div>
                            <p>Punto de carga</p>
                            <p class="bold">{{$detalleCarga->puntoCarga->puc_nombre}}</p>
                        </div>

                        <div>
                            <p>Cliente</p>
                            <p class="bold">{{$detalleCarga->cliente->cli_nombre}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <br>
        </div>
        <div class="div-contenido">
            <h3>Imágenes</h3>
            <div class="grid-img-cargas">
                <div>
                    <p>Fotografía de la patente</p>
                    <img src="{{ route('download.file', ['url' => base64_encode($detalleCarga->car_imagen_patente)]) }}" alt="">
                </div>

                <div>
                    <p>Fotografía de la carga (horizontal)</p>
                    <img src="{{ route('download.file', ['url' => base64_encode($detalleCarga->car_imagen_carga)]) }}" alt="">
                </div>
            </div>
        </div>
        </div>
    </form>
</body>

</html>
