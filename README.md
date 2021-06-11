# Medidor de Co2 y Temperatura

Proyecto Web y Arduino para recoger datos de Co2 y Temperatura de un Aula.
Los datos son recogidos mediante un sensor X y enviados a un servidor web en apache para ser guardados en una bbdd mysql.
Usamos una aplicación web para poder mostrar los datos recogidos. 
Este proyecto esta desarrollado para el Instituto Elorrieta-Errekamari (Bilbao).
Con la colaboracion de:

- Jorge gonzalez 
- Unai Perea

## Página de Incio

En la página principal podemos encontrar las últimas mediciones para el día actual, además de las mínimas, máximas y medias tanto de Co2 como Temperatura.

![screenshot pagina inicio]( https://raw.githubusercontent.com/anderuraga/co2-temperature/main/screenshot_home.JPG )

## Página con datos estadísticos

Muestra datos estadísticos de los últimos 500 registros.
Existe la posibilidad de filtrar por dos fechas.

![screenshot pagina datos estadisiticos]( https://raw.githubusercontent.com/anderuraga/co2-temperature/main/screenshot_datos.JPG )



## Técnologia

- PHP V8.0.6
- HTML
- CSS
- JS
- ARDUINO

## Estructura de carpetas

- arduino: script y documentacion
- web: proyecto web + PHP + base datos

## configuración de la bbdd

Existe un script para crear las bbdd y meter 5 registros de pruebas **/web/db/script.sql**
Para cambiar las variables de conexion a la bbdd desde PHP hay que cambiar el siguiente fichero **/web/db/conectar.php**

 ```
  $dbname   = "sensores";
  $user     = "root";
  $password = "";
  $server   = "localhost";
 ```  

## configuración Proyecto Web

El proyecto web se debe instalar en un servidor Apache que soporte PHP 8.0.6, la carpeta de instalación dependera del servidor usado WAMP en **www** y XAMP **htdocs**, el nombre de la carpeta para instalar la App Web debe ser **c02-temperatura**

Puedes probar que accede abriendo esta url en un navegador web [url pagina inicio](//localhost/co2-temperature/web/)

## configuración Arduino

Antes de instalar el programa de arduino en el microprocesador, debemos cambiar una serie de variables:

 ```
    // los datos se envian casa 5 min
    int tiempoEnvio = 5 * 60 * 1000; // 5 min

    // nombre y contraseña de la red 
    const char *ssid = "Elorrieta_ethazi";
    const char *password = "123ETHAZI";

    // ip del pc donde está la base de datos
    String strhost = "10.0.21.15";                             
    String strurl = "/co2-temperature/web/controlador/insertardatos.php";

 ```






