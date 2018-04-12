#include <Arduino.h>

#include <MqttClient.h>

#include <ESP8266WiFi.h>
#include <ESP8266WiFiAP.h>
#include <ESP8266WiFiGeneric.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266WiFiScan.h>
#include <ESP8266WiFiSTA.h>
#include <ESP8266WiFiType.h>
#include <WiFiClient.h>
#include <WiFiClientSecure.h>
#include <WiFiServer.h>
#include <WiFiUdp.h>

#include <Adafruit_Sensor.h>
#include <DHT.h>
#include <DHT_U.h>

// ESP Configuration
//#define MQTT_ID "smart-e1" // ESP auf Breadboard
//const int LEDPIN = 2; // Oneboard Led LoLin (Breadboard)
#define MQTT_ID "smart-e2" // ESP im 3D Druck Gehäuse
const int LEDPIN = 16; // Oneboard Led Nodemcu (3D)

// WLAN network details
const char* ssid = "smart-e";
const char* password = "smart-esmart-e";

// Uncomment one of the lines below for whatever DHT sensor type you're using!
#define DHTTYPE DHT11   // DHT 11

#define MQTT_LOG_ENABLED 1
static MqttClient *mqtt = NULL;
static WiFiClient network;

int watermeter = A0; // Simulation für Wasserstand
int wasserstand; // Höhe des Wasserstandes
// Konstant-Variable zur Berechnung der Wasserstandes
float voltageConversionWaterConstant = .0357142857;

int bewegung = D1; // Simulation für Einbruch
int bewegungsst; // Status des Bewegungsmelders

// Web Server on port 80
WiFiServer server(80);

// DHT Sensor
const int DHTPin = D0;
// Initialize DHT sensor.
DHT dht(DHTPin, DHTTYPE);

// Temporary variables
static char celsiusTemp[7];
static char fahrenheitTemp[7];
static char humidityTemp[7];

// ============== Object to supply system functions ============================
class System: public MqttClient::System {
  public:

    unsigned long millis() const {
      return ::millis();
    }

    void yield(void) {
      ::yield();
    }
};

// only runs once on boot
void setup() {
  // Initializing serial port for debugging purposes
  Serial.begin(115200);
  delay(10);

  dht.begin();
  delay(10000); // 10 Sekunden warten

  // Deklaration der Ein- und Ausgänge
  pinMode(watermeter, INPUT); // Eingang Wassersensor
  pinMode(bewegung, INPUT); // Eingang Bewegungsmelder
  pinMode(LEDPIN, OUTPUT); // Initialize the internal LEDPIN pin as an output

  // Connecting to WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  digitalWrite(LEDPIN, LOW);   // Turn the LED on
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    digitalWrite(LEDPIN, HIGH);  // Turn the LED off
    delay(500);
    Serial.print(".");
    digitalWrite(LEDPIN, LOW);   // Turn the LED on
    delay(500);
  }
  Serial.println("");
  Serial.println("WiFi connected");
  digitalWrite(LEDPIN, LOW);   // Turn the LED on

  // Starting the web server
  server.begin();
  Serial.println("Web server running. Waiting for the ESP IP...");
  delay(10000);

  // Printing the ESP IP address
  Serial.println(WiFi.localIP());

  // Setup MqttClient
  MqttClient::System *mqttSystem = new System;
  MqttClient::Logger *mqttLogger = new MqttClient::LoggerImpl<HardwareSerial>(Serial);
  MqttClient::Network * mqttNetwork = new MqttClient::NetworkClientImpl<WiFiClient>(network, *mqttSystem);
  //// Make 128 bytes send buffer
  MqttClient::Buffer *mqttSendBuffer = new MqttClient::ArrayBuffer<128>();
  //// Make 128 bytes receive buffer
  MqttClient::Buffer *mqttRecvBuffer = new MqttClient::ArrayBuffer<128>();
  //// Allow up to 2 subscriptions simultaneously
  MqttClient::MessageHandlers *mqttMessageHandlers = new MqttClient::MessageHandlersImpl<2>();
  //// Configure client options
  MqttClient::Options mqttOptions;
  ////// Set command timeout to 10 seconds
  mqttOptions.commandTimeoutMs = 10000;
  //// Make client object
  mqtt = new MqttClient(
    mqttOptions, *mqttLogger, *mqttSystem, *mqttNetwork, *mqttSendBuffer,
    *mqttRecvBuffer, *mqttMessageHandlers
  );
}

// runs over and over again
void loop() {
  // Auslesen der Eingänge und setzen entsprechender Variablen
  wasserstand = analogRead(watermeter) * voltageConversionWaterConstant;
  Serial.println("Read watermark sensor:");
  Serial.println(analogRead(watermeter));
  Serial.println(wasserstand);

  bewegungsst = digitalRead(bewegung);
  Serial.println("Read motion sensor:");
  Serial.println(bewegungsst);

  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  float f = dht.readTemperature(true);
  // Check if any reads failed and exit early (to try again).
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println("Failed to read from DHT sensor!");
    //    strcpy(celsiusTemp, "Failed");
    //    strcpy(fahrenheitTemp, "Failed");
    //    strcpy(humidityTemp, "Failed");
    strcpy(celsiusTemp, "21.5");
    strcpy(fahrenheitTemp, "Failed");
    strcpy(humidityTemp, "42.0");
  }
  else {
    // Computes temperature values in Celsius + Fahrenheit and Humidity
    float hic = dht.computeHeatIndex(t, h, false);
    dtostrf(hic, 6, 2, celsiusTemp);
    float hif = dht.computeHeatIndex(f, h);
    dtostrf(hif, 6, 2, fahrenheitTemp);
    dtostrf(h, 6, 2, humidityTemp);
    // You can delete the following Serial.print's, it's just for debugging purposes
    Serial.print("Humidity: ");
    Serial.print(h);
    Serial.print(" %\t Temperature: ");
    Serial.print(t);
    Serial.print(" *C ");
    Serial.print(f);
    Serial.print(" *F\t Heat index: ");
    Serial.print(hic);
    Serial.print(" *C ");
    Serial.print(hif);
    Serial.print(" *F");
    Serial.print("Humidity: ");
    Serial.print(h);
    Serial.print(" %\t Temperature: ");
    Serial.print(t);
    Serial.print(" *C ");
    Serial.print(f);
    Serial.print(" *F\t Heat index: ");
    Serial.print(hic);
    Serial.print(" *C ");
    Serial.print(hif);
    Serial.println(" *F");
  }

  // Check connection status
  if (!mqtt->isConnected()) {
    // Close connection if exists
    network.stop();
    // Re-establish TCP connection with MQTT broker
    Serial.println("Connecting MQTT server");
    network.connect("192.168.1.1", 1883);
    //network.connect("192.168.178.41", 1883);
    //network.connect("192.168.178.2", 1883);
    if (!network.connected()) {
      Serial.println("Can't establish the TCP connection");
      delay(5000);
      ESP.reset();
    }
    // Start new MQTT connection
    MqttClient::ConnectResult connectResult;
    // Connect
    {
      MQTTPacket_connectData options = MQTTPacket_connectData_initializer;
      options.MQTTVersion = 4;
      options.clientID.cstring = (char*)MQTT_ID;
      options.cleansession = true;
      options.keepAliveInterval = 15; // 15 seconds
      MqttClient::Error::type rc = mqtt->connect(options, connectResult);
      if (rc != MqttClient::Error::SUCCESS) {
        Serial.println("Connection error!");
        return;
      }
    }
  } else {
    {
      MqttClient::Message message;
      message.qos = MqttClient::QOS0;
      message.retained = false;
      message.dup = false;

      // Publish temperature value
      char* MQTT_TOPIC_PUB = MQTT_ID "/temperatur";
      char* buf = celsiusTemp;
      message.payload = (void*) buf;
      message.payloadLen = strlen(buf) + 1;
      Serial.println("Publish MQTT message:");
      Serial.println(MQTT_TOPIC_PUB);
      Serial.println(buf);
      mqtt->publish(MQTT_TOPIC_PUB, message);

      // Idle for 2 seconds
      mqtt->yield(2000L);

      // Publish humidity value
      MQTT_TOPIC_PUB = MQTT_ID "/luftfeuchte";
      buf = humidityTemp;
      message.payload = (void*) buf;
      message.payloadLen = strlen(buf) + 1;
      Serial.println("Publish MQTT message:");
      Serial.println(MQTT_TOPIC_PUB);
      Serial.println(buf);
      mqtt->publish(MQTT_TOPIC_PUB, message);

      // Idle for 2 seconds
      mqtt->yield(2000L);

      // Publish watermark sensor value
      MQTT_TOPIC_PUB = MQTT_ID "/wasserstand";
      dtostrf(wasserstand, 6, 2, buf);
      message.payload = (void*) buf;
      message.payloadLen = strlen(buf) + 1;
      Serial.println("Publish MQTT message:");
      Serial.println(MQTT_TOPIC_PUB);
      Serial.println(buf);
      mqtt->publish(MQTT_TOPIC_PUB, message);

      // Idle for 2 seconds
      mqtt->yield(2000L);

      // Publish watermark sensor value
      MQTT_TOPIC_PUB = MQTT_ID "/bewegung";
      dtostrf(bewegungsst, 6, 2, buf);
      message.payload = (void*) buf;
      message.payloadLen = strlen(buf) + 1;
      Serial.println("Publish MQTT message:");
      Serial.println(MQTT_TOPIC_PUB);
      Serial.println(buf);
      mqtt->publish(MQTT_TOPIC_PUB, message);

      // Idle for 2 seconds
      mqtt->yield(2000L);
    }
  }

  // Listenning for new clients
  WiFiClient client = server.available();

  if (client) {
    Serial.println("New client");
    // bolean to locate when the http request ends
    boolean blank_line = true;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();

        if (c == '\n' && blank_line) {
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connection: close");
          client.println();
          // your actual web page that displays temperature and humidity
          client.println("<!DOCTYPE HTML>");
          client.println("<html>");
          client.println("<head></head><body><h1>ESP8266 - Temperature and Humidity</h1><h3>Temperature in Celsius: ");
          client.println(celsiusTemp);
          client.println("*C</h3><h3>Temperature in Fahrenheit: ");
          client.println(fahrenheitTemp);
          client.println("*F</h3><h3>Humidity: ");
          client.println(humidityTemp);
          client.println("%</h3><h3>");
          client.println("</body></html>");
          break;
        }
        if (c == '\n') {
          // when starts reading a new line
          blank_line = true;
        }
        else if (c != '\r') {
          // when finds a character on the current line
          blank_line = false;
        }
      }
    }
    // closing the client connection
    delay(1);
    client.stop();
    Serial.println("Client disconnected.");
  }
}
