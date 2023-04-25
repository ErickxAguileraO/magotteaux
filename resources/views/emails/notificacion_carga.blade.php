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
            background: #F5F5F5;
            margin: 0px;
            font-family: 'Hind', sans-serif;
        }

        header {
            background: #002060;
            widows: 100%;
            height: 44px;
        }

        .img-correo {
            margin: 36px 0px 36px 0px;
        }

        .contenido {
            display: flex;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }

        .txt {
            background: white;
            width: 80%;
            height: auto;
            border-radius: 10px;
            padding: 45px;
        }

        .link {
            color: #002060;
            font-weight: bold;
        }

        p {
            margin-bottom: 40px;
        }

        .hetigh {
            height: 40px;
        }
    </style>
</head>

<body>
    <header></header>
    <div class="contenido">
        <img class="img-correo" src="{{ asset('web/imagenes/i-logo-color.svg') }}" alt="">
        <div class="txt">
            <p>

                Estimados,<br>
                        Con fecha {{ $carga->car_fecha_salida->format('d-m-Y / H:i')}} Se ha iniciado el despacho programado desde<br>
                sucursal {{$carga->planta->pla_nombre}} perteneciente al cliente {{$carga->cliente->cli_nombre}} y con destino {{$carga->destino->des_nombre}}.
                <br><br>
                Para más información sobre despacho en curso, presionar el siguiente enlace:<br>
                <a href="{{ route('detalle.carga.correo',['id'=>$carga->car_id, 'token'=>$carga->car_token]) }}" class="link">Enlace a seguimiento carga.</a>

            </p>
            <br>
            @if ($carga->cliente->frecuencias[0]->fre_frecuencia == 'Diaria')
                Sus correos llegarán todos los días de Lunes a Viernes.<br>
                En el caso que no lo envie de forma manual, se enviará automáticamente a las 23:59Hrs de forma diaria.
            @endif
            @if ($carga->cliente->frecuencias[0]->fre_frecuencia == 'Semanal')
                Sus correos llegarán de forma semanal, cada día Lunes a las 08.00Hrs <br>
            @endif
            @if ($carga->cliente->frecuencias[0]->fre_frecuencia == 'Quincenal')
                Sus correos llegarán de forma quincenal, 2 veces al mes. Estos correos se envían los días hábiles de la semana<br>
            @endif
            @if ($carga->cliente->frecuencias[0]->fre_frecuencia == 'Mensual')
                Sus correos llegarán de forma mensual, a fin de mes. Estos correos se envían los días hábiles de la semana<br>
            @endif

            <p>
                Atte.
                <br>
                Magotteaux
            </p>
            <br>

        </div>
    </div>
</body>

</html>
