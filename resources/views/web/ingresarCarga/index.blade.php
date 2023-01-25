@extends('layout.web')

@section('title', 'Home')

@section('content')
    @push('extra-css')
    @endpush
    
    <div class="contenido">
        <nav class="sub-menu-nav">
            <a><p>Usted está en</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/"><p>Control de carga</p></a>
            <img src="{{ asset('web/imagenes/i-flecha-derecha.svg') }}" alt="">
            <a href="/nueva-carga"><p class="menu-seleccionado">Ingresar nueva carga</p></a>
        </nav>
        <form action="" class="div-contenido">
           <section class="head-nueva-carga">
                <a href="/"><img src="{{ asset('web/imagenes/i-atras.svg') }}" alt=""></a>
                <h3>Ingresar nueva carga</h3>
           </section>
           <div class="grid-nueva-carga">
                <div class="grid-carga-n">
                    <h3 class="subtitulo">Datos del camión</h3>
                    <div class="label-input-n">
                        <label for="">Empresa de transporte</label>
                        <select name="" id="">
                            <option value="">Empresa 1</option>
                        </select>
                    </div>

                    <div class="label-input-n">
                        <label for="">Nombre del chofer</label>
                        <input type="text">
                    </div>

                    <div class="label-input-n">
                        <label for="">Patente</label>
                        <input type="text">
                    </div>

                    <div class="label-input-n">
                        <label for="">Tipo de carga</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>

                    <div class="label-input-n">
                        <label for="">Tamaño de la bola</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>
                </div>
                <div class="grid-carga-n">
                    <h3 class="subtitulo">Ruta</h3>
                    <div class="label-input-n">
                        <label for="">Fecha y hora de carga</label>
                        <input type="datetime-local" class="input-fecha">
                    </div>
                    <div class="label-input-n">
                        <label for="">Fecha y hora de salida a destino</label>
                        <input type="datetime-local" class="input-fecha">
                    </div>
                    <div class="label-input-n">
                        <label for="">Planta de origen</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>
                    <div class="label-input-n">
                        <label for="">Punto de carga</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>
                    <div class="label-input-n">
                        <label for="">Cliente</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>
                    <div class="label-input-n">
                        <label for="">Destino</label>
                        <select name="" id="">
                            <option value="">Aeurus</option>
                        </select>
                    </div>
                </div>
                <div class="grid-carga-n">
                    <h3 class="subtitulo">Documentación</h3>
                    <div class="label-input-n">
                        <label for="">Guía de despacho</label>
                        <input type="text">
                        <div class="input-file-simple">
                            <div>
                                <p>Subir guía de despacho</p>
                                <img src="{{ asset('web/imagenes/i-file.svg') }}" alt="">
                            </div>
                            <input type="file" name="" id="" class="file-simple" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf">
                        </div>
                    </div>
                    <div class="label-input-n">
                        <label for="">Certificado de calidad</label>
                        <input type="text">
                        <div class="input-file-simple">
                            <div>
                                <p>Subir certificado de calidad</p>
                                <img src="{{ asset('web/imagenes/i-file.svg') }}" alt="">
                            </div>
                            <input type="file" name="" id="" class="file-simple" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf">
                        </div>
                    </div>
                    
                    <h3 class="subtitulo">Imágenes</h3>
                    <div class="label-input-n">
                        <label for="">Fotografía de la patente</label>
                        <div class="input-file-pro">
                            <img src="{{ asset('web/imagenes/i-file-img.svg') }}" alt="">
                            <input type="file" name="" id="" class="file-simple">
                        </div>
                        <div class="btn-input-file">
                            <button class="btn-verde">
                                <p>Subir imagen</p>
                                <img src="{{ asset('web/imagenes/i-picture.svg') }}" alt="">
                            </button>
                            <button class="btn-rojo">
                                <p>Eliminar imagen</p>
                                <img src="{{ asset('web/imagenes/i-borrar-red.svg') }}" alt="">
                            </button>
                        </div>
                    </div>

                    <div class="label-input-n">
                        <label for="">Fotografía de la carga (horizontal)</label>
                        <div class="input-file-pro">
                            <img src="{{ asset('web/imagenes/i-file-img.svg') }}" alt="">
                            <input type="file" name="" id="" class="file-simple">
                        </div>
                        <button class="btn-contenido-inicio btn-subir-imagen-2">Subir imagen<img src="{{ asset('web/imagenes/i-picture.svg') }}" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="div-contenido-inicio-2 mostrar-nueva-carga" style="margin-top: 10px;">
                <h2></h2>
                <div class="botones-contenido-inicio">
                    <button class="btn-contenido-inicio2">
                        <p>Cancelar</p>
                        <img src="{{ asset('web/imagenes/i-x.svg') }}" alt="">
                    </button>
                    <button class="btn-contenido-inicio">
                        <p class="mostrar-escritorio">Guardar nueva carga</p>
                        <p class="mostrar-movil">Guardar</p>
                        <img src="{{ asset('web/imagenes/i-guardar.svg') }}" alt="">
                    </button>
                    
                </div>
            </div> 
        </form>
        
    </div>

    @push('extra-js')
   
    @endpush

@endsection
