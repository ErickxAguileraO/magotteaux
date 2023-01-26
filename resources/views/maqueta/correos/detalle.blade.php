<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind&display=swap');
        body{
            margin: 0px;
            font-family: 'Hind', sans-serif;
        }
        header{
            display: flex;
            align-items: center;
            justify-content: center;
            background: #002060;
            widows: 100%;
            height: 77px;
        }
        .contenido{
            display: flex;
            align-items: center;
            flex-direction: column;
            width: 100%;
            padding-top: 20px
        }

        /*  */
        .grid-carga-n{
            border: 1px solid #EBEBEB;
            border-radius: 10px;
            padding: 24px;
            width: 90%;
        }
        .datos-row{
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 5px;
        }
        .datos-row div{
            margin-top: 24px;
        }
        .bold{
            font-weight: bold;
        }
        .grid-img-cargas{
            display: grid;
            grid-template-columns: repeat(3,1fr);
            margin-top: 24px;
            gap: 40px;
            border: 1px solid #EBEBEB;
            border-radius: 10px;
            padding: 24px;
        }
        .grid-img-cargas div img{
            margin-top: 12px;
            max-height: 200px;
            max-width: 250px;
        }
        .div-contenido{
            padding: 48px 40px 48px 40px;
            background-color: white;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <header>
        <img  src="{{ asset('web/imagenes/logo-blanco.svg') }}" alt="">

    </header>
    <div class="contenido">
        <div class="grid-carga-n">
            <div>
                <h3>Datos del camión</h3>
                <div class="datos-row">
                    <div>
                        <p>Empresa de transporte</p>
                        <p class="bold">Empresa 1</p>
                    </div>
    
                    <div>
                        <p>Nombre del chofer</p>
                        <p class="bold">Carlos Manríquez</p>
                    </div>
    
                    <div>
                        <p>Patente</p>
                        <p class="bold">DDFF34</p>
                    </div>
    
                    <div>
                        <p>Tipo de carga</p>
                        <p class="bold">Carga 1</p>
                    </div>
    
                    <div>
                        <p>Tamaño de bola</p>
                        <p class="bold">3</p>
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
                        <p class="bold">22-02-2023 / 14:33</p>
                    </div>
    
                    <div>
                        <p>Guía de despacho</p>
                        <p class="bold">N° 1234</p>
                    </div>
    
                    <div>
                        <p>Planta de origen</p>
                        <p class="bold">Antofagasta</p>
                    </div>
    
                    <div>
                        <p>Punto de carga</p>
                        <p class="bold">Planta 1</p>
                    </div>
    
                    <div>
                        <p>Cliente</p>
                        <p class="bold">BHP Minerals</p>
                    </div>
    
                    <div>
                        <p>Destino</p>
                        <p class="bold">Minera Escondida</p>
                    </div>
                </div>
            </div>
       </div>
    
       <br>
       {{-- <div class="grid-carga-n">
            <div>
                <h3>Documentación</h3>
                <div class="datos-row">
                    <div>
                        <p>Guía de despacho</p>
                        <a href="" class="link-verde">DESCARGAR ARCHIVO</a>
                    </div>
    
                    <div>
                        <p>Certificado de calidad</p>
                        <a href="" class="link-verde">DESCARGAR ARCHIVO</a>
                    </div>
                </div>
            </div>
        </div> --}}
        </div>
        <div class="div-contenido">
            <h3>Imágenes</h3>
            <div class="grid-img-cargas">
                <div>
                    <p>Fotografía de la patente</p>
                    <img src="{{ asset('web/imagenes/img-1.svg') }}" alt="">
                </div>
                
                <div>
                    <p>Fotografía de la carga (horizontal)</p>
                    <img src="{{ asset('web/imagenes/img-2.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>

</body>
</html>