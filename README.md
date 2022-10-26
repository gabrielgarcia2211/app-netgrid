# STRADATA - APIREST

[![N|Solid](https://laravelvuespa.com/preview.png)](https://laravel.com)
Esta aplicacion fue realizada en Laravel como framework de Backend con persistencia de datos en MySQL/MariaDB y Frontend Vue.js

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>



## Caracteristicas

- Registro de usuarios.
- Edicion de usuario luego del registro previo.
- Login de usuarios con correo electrónico.
- Lista de personajes del API seleccionada(pokemons).
- Visualizacion de la información de un personaje seleccionado.
- Registro de personajes como favoritos.
- Opcional: Prueba funcional con Laravel/Vuejs - (ingreso, y seleccion de pokemon).

## Tecnologias

* [Laravel + Vue.js](https://bluuweb.github.io/tutorial-laravel/vue/) Laravel es un framework de código abierto para desarrollar aplicaciones y servicios web con PHP 5 y PHP 7. Su filosofía es desarrollar código PHP de forma elegante y simple, evitando el "código espagueti". Fue creado en 2011 y tiene una gran influencia de frameworks como Ruby on Rails, Sinatra y ASP. NET MVC. Junto con Vue.js que es Framework Frontend qe le brinda sencillez y facilidad al desarrollador al momento de implementar la tecnologia.

* [MySQL](https://dev.mysql.com/downloads/mysql/) MySQL es el sistema de gestión de bases de datos relacional más extendido en la actualidad al estar basada en código abierto. Desarrollado originalmente por MySQL AB, fue adquirida por Sun MicroSystems en 2008 y esta su vez comprada por Oracle Corporation en 2010, la cual ya era dueña de un motor propio InnoDB para MySQL.

* [Laragon](https://laragon.org/download/index.html) Es una herramienta bastante robusta que trae consigo aplicaciones utiles para el desarrollo del aplicativo, por ejemplo, Apache 2.4, Nginx, MySQL 5.7, PHP 7.4, Redis, Memcached Node.js 14, npm, git.

## NOTA

`PHP VERSION, DEBE SER >= 7.4 PARA EVITAR INCOMPATIBILIDAD CON COMPOSER`
`PARA TRABAJAR LAS SIGUIENTES RUTAS SE RECOMIENDA POSTMAN`



## Instalación (Uso local)
- Primero se debe instalar [Laragon](https://laragon.org/download/index.html) en la maquina, para nuestro servidor apache local.

- Clonar proyecto
    ```bash
    git clone https://github.com/gabrielgarcia2211/netgrid app-netgrid
    ```

- Despues se debe ir al directorio del proyecto
    ```bash
    cd my-project
    ```

- Luego se **Instala/Actualiza** las dependencias composer en la terminal del proyecto, con el siguiente comando:
    ```sh
    composer install
    ```
    
- Luego se debemos duplicar el archivo **.env.example** cambiamos el nombre a **.env**, y debemos configurar lo siguiente:
    ```sh
    DB_DATABASE = name_database
    ```
    ```javascript
    $ php artisan key:generate
    ```

- Luego se **Instala/Actualiza** las dependencias npm Vue.js a traves del siguiente comando(FRONTEND):
   ```sh
    npm install
    ```
- Se compilanlos componentes y librerias de npm (FRONTEND):
    ```sh
    npm run watch / npm run dev
    ```
- Se corre el proyecto a traves del siguiente comando(BACKEND):
    ```sh
    php artisan serve
    ```
- Se debe verificar la implementación navegando a la dirección de su servidor en su navegador preferido.
    ```sh
    http://127.0.0.1:8080/
    ```
    
    
## Autores

- [@gabrielgarcia2211](https://github.com/gabrielgarcia2211)

## Despliegue
`NOTA`
SE RECOMIENDA UTILIZAR EL NAVEGADOR [EDGE](https://www.microsoft.com/es-es/edge?form=MA13FJ)  PARA ABRIR EL SITIO

[![debug](https://img.icons8.com/color/0/heroku.png)](http://web-netgrid.herokuapp.com/)

## Contribuyentes
*¡Las contribuciones son siempre bienvenidas!*

## Licencia
[MIT](https://choosealicense.com/licenses/mit/)


