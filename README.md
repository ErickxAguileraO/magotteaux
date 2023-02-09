
# 

## Proyecto Maggoteaux

Plataforma para la gestion de carga, entrada, salida de camiones.


## Participantes

| Nombre            | Labor                 |
| ----------------- | -------------         |
| Daniel Morales    | Jefe de proyecto      |
| Jorge Ovalle      | Jefe de proyecto      |
| Bastian Coloma    | Desarrolador Frontend |
| Juan Rios         | Desarrolador Backend  |
| Erick Aguilera    | Desarrolador Backend  |

#

## Dependencias

- [PHP 7.4.29]() 
- [Laravel 8](https://laravel.com/docs/8.x) 
- [Laravel Excel](https://laravel-excel.com/)
- [Spatie Permissions](https://spatie.be/docs/laravel-permission/v5/installation-laravel)
#


## Instalacion con xampp:

En este caso deberas descargar alguna de las versiones que cuenten con `PHP 7.2.49`.

Puedes ver el listado de versiones aqui: https://www.apachefriends.org/download.html

#

## Instalacion de dependencias

Ahora instalaremos todas las dependecias que se encuentran en la carpeta de `vendor`.

Ejecutaremos los siguientes comandos:

```php
#En xampp:
composer install
```
Ahora crearemos una copia del archivo `.env.example` y lo dejaremos en la raiz del proyecto, con el nombre `.env`, posteriormente generaremos una key

```php
#En xampp:
php artisan key:generate
```
Ahora ejecutaremos las migraciones

```php
#En xampp:
php artisan migrate
```

Una vez seguido estos pasos, habremos montado el proyecto en nuestro entorno local :monkey_face: :thumbsup:

#

## Patrones de diseño

Este proyecto no contiene patrones de diseño, ya que al no ser muy grande el desarrollo, se evaluo y se decidio no optar por implementarlo.

De todas formas, si quieres implemtar logica adicional o encuentras que algun metodo en un controlador esta usando mucho espacio, puedes crear un servicio, que haga referencia a la misma clase de controller.

Un ejemplo claro, es si queremos implemtar una nueva funcionalidad en `CargaController` y esta contiene mucha logica, podemos crear un servicio en `App/Services/CargaService/`, luego lo incoporamos en el controller mediante el constructor.

#

## :warning::warning:Consideraciones importantes:warning::warning:

El proyecto cuenta con traducciones al español, si en un futuro se agregan nuevas validaciones, no hace falta escribir una respuesta a menos que quieras customizar el mensaje

```php
public function rules()
{
    return [
        'nombre' => ['required', 'string', 'max:255'],
    ];
}


//esto solo es requerido si quieres customizar el mensaje
public function messages()
{
    return [
        'required' => 'El :attribute no debe estar vacio',
    ];
}
```

Asi mismo, la obtencion de fechas mediante `Carbon` o `PHP`, es manejada con una zona horaria seteada en `America/Santiago`.