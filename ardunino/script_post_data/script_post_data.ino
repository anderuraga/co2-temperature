#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include "MHZ19.h"
#include <SoftwareSerial.h>                                // Remove if using HardwareSerial

#define RX_PIN D2                                        // Rx pin which the MHZ19 Tx pin is attached to
#define TX_PIN D1                                    // Tx pin which the MHZ19 Rx pin is attached to
#define BAUDRATE 9600                                      // Device to MH-Z19 Serial baudrate (should not be changed)

MHZ19 myMHZ19;                                             // Constructor for library
SoftwareSerial mySerial(RX_PIN, TX_PIN);                   // (Uno example) create device to MH-Z19 serial
unsigned long getDataTimer = 0;

//-------------------VARIABLES GLOBALES--------------------------
int contconexion = 0;
int tiempoEnvio = 5 * 60 * 1000; // 5 min

const char *ssid = "Elorrieta_ethazi";
const char *password = "123ETHAZI";
unsigned long previousMillis = 0;

char host[48];
String strhost = "10.0.21.15"; // ip del pc donde está la base de datos
String strurl = "/co2-temperature/web/controlador/insertardatos.php";
String chipid = "";

//-------Función para Enviar Datos a la Base de Datos SQL--------

String enviardatos(String datos) {


  Serial.println (
    String("POST ") + strurl + " HTTP/1.1" + "\r\n" +
    "Host: " + strhost + "\r\n" +
    "Accept: */*" + "*\r\n" +
    "Content-Length: " + datos.length() + "\r\n" +
    "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
    "\r\n" + datos
  );

  String linea = "error";
  WiFiClient client;
  strhost.toCharArray(host, 49);
  if (!client.connect(host, 80)) {
    Serial.println("Fallo de conexion");
    return linea;
  }




  client.print(String("POST ") + strurl + " HTTP/1.1" + "\r\n" +
               "Host: " + strhost + "\r\n" +
               "Accept: */*" + "*\r\n" +
               "Content-Length: " + datos.length() + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
               "\r\n" + datos);
  delay(10);

  Serial.print("Enviando datos a SQL...");

  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println("Cliente fuera de tiempo!");
      client.stop();
      return linea;
    }
  }
  // Lee todas las lineas que recibe del servidro y las imprime por la terminal serial
  while (client.available()) {
    linea = client.readStringUntil('\r');
  }
  Serial.println(linea);
  return linea;
}

//-------------------------------------------------------------------------

void setup() {
  Serial.begin(9600);                                     // Device to serial monitor feedback

  mySerial.begin(BAUDRATE);                               // (Uno example) device to MH-Z19 serial start
  myMHZ19.begin(mySerial);                                // *Serial(Stream) refence must be passed to library begin().

  myMHZ19.autoCalibration();                              // Turn auto calibration ON (OFF autoCalibration(false))

  Serial.println("");

  Serial.print("chipId: ");
  chipid = String(ESP.getChipId());
  Serial.println(chipid);

  // Conexión WIFI
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED and contconexion < 50) { //Cuenta hasta 50 si no se puede conectar lo cancela
    ++contconexion;
    delay(500);
    Serial.print(".");
  }
  if (contconexion < 50) {
    Serial.println("");
    Serial.println("WiFi conectado");
    Serial.println(WiFi.localIP());
  }
  else {
    Serial.println("");
    Serial.println("Error de conexion");
  }
}

//--------------------------LOOP--------------------------------
void loop() {

  unsigned long currentMillis = millis();

  if (currentMillis - previousMillis >= tiempoEnvio ) {
    previousMillis = currentMillis;  
    String co2 = "";
    int8_t temp;
    
    temp = myMHZ19.getTemperature();                     // Request Temperature (as Celsius)    
    co2 = String(myMHZ19.getCO2());
    
    enviardatos("chipid=" + chipid + "&co2=" + co2 + "&temp=" + temp);
  }
}
