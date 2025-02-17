# Medidor de Co2 y Temperatura

Proyecto Web y Arduino para recoger datos de Co2 y Temperatura de un Aula.
Los datos son recogidos mediante un sensor **MH-Z19B** y placa **Wemos D1 Mini con módulo ESP8266(wifi)**  y enviados a un servidor web en apache para ser guardados en una bbdd mysql.
Usamos una aplicación web para poder mostrar los datos recogidos. 
Este proyecto esta desarrollado para el Instituto Elorrieta-Errekamari (Bilbao).
Con la colaboracion de:

- Jorge gonzalez 
- Unai Perea

## Página de Inicio

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
- [bootstrap@5.0.1](https://getbootstrap.com/)
- [DataTables](https://datatables.net/)
- [chart.js](https://www.chartjs.org/)
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

El proyecto web se debe instalar en un servidor Apache que soporte PHP 8.0.6, la carpeta de instalación dependera del servidor usado WAMP en **www** y XAMP **htdocs**, el nombre de la carpeta para instalar la App Web debe ser **c02-temperature**

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

### Importar Librerias desde el IDE de Arduino

Para la instalación de librerias desde Arduino usar la siguiente opción de Menu:
*Menú programa, incluir librería, administrar biblioteca, buscamos las siguientes 4 *

```
   #include <ESP8266WiFi.h>
   #include <WiFiClient.h>
   #include "MHZ19.h"
   #include <SoftwareSerial.h>    
```   

Imagen con ejemplo de busqueda de libreria
![screenshot buscador librerias Arduino]( https://raw.githubusercontent.com/anderuraga/co2-temperature/main/screenshot_arduino.jpg )

### Wemos D1 Mini con módulo ESP8266
![placa arduino]( https://raw.githubusercontent.com/anderuraga/co2-temperature/main/screenshot_ESP8266.jpg )

### MH-Z19B
![sensor co2 y temp]( https://raw.githubusercontent.com/anderuraga/co2-temperature/main/screenshot_mh-z19B.jpg )

### Diagrama de conexión


![sensor co2 y temp]( https://raw.githubusercontent.com/anderuraga/co2-temperature/main/screenshot_diagrama.jpg )











