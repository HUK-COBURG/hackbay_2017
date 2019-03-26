#include <DHT.h>
#include <ESP8266WiFi.h>
#include <ArduinoMqttClient.h>

// WiFi credentials.
const char* WIFI_SSID = "SMART-E";
const char* WIFI_PASS = "smarte123";

WiFiClient wifiClient;
MqttClient mqttClient(wifiClient);

const String mqtt_id       = "smart-e2";
const char   mqtt_broker[] = "192.168.1.1";
const int    mqtt_port     = 1883;

const int LEDPIN = 16;
const int READ_COUNT = 5;
const int READ_DELAY = 6000;

#define DHTTYPE DHT22
#define DHTPIN D2
DHT dht(DHTPIN, DHTTYPE);
struct sDHT { float c, f, h; };

void setup() {
  Serial.begin(9600);

  dht.begin();
  delay(10000);

  pinMode(LEDPIN, OUTPUT);
  connecting();  
}

unsigned long lastReadTime     = 0;
int           currentReadCount = 0;

sDHT          dataDHT[READ_COUNT];

void loop() {
  unsigned long currentMillis = millis();
  
  if (WiFi.status() != WL_CONNECTED) {
    connecting();
    currentReadCount = 0;
  }
  
  if (currentMillis - lastReadTime >= READ_DELAY) {
    lastReadTime = currentMillis;
    
    if (currentReadCount < READ_COUNT) {
      mqttClient.poll();
      Serial.print("Interval ");
      Serial.println(currentReadCount + 1);
      
      dataDHT[currentReadCount] = readDHT();
      
      currentReadCount++;
    } else {
      publishDHT(dataDHT);

      currentReadCount = 0;
    }
  }
}

void publishMqtt(String topic, String message) {
  Serial.println("publishing a message via mqtt");
  Serial.print("topic: ");
  Serial.println(topic);
  Serial.print("message: ");
  Serial.println(message);

  mqttClient.beginMessage(topic);
  mqttClient.print(message);
  mqttClient.endMessage();
}

sDHT readDHT() {
  sDHT output;
  output.c = dht.readTemperature();
  output.f = dht.readTemperature(true);
  output.h = dht.readHumidity();
  
  if (isnan(output.c) || isnan(output.f) || isnan(output.h)) {
    Serial.println("Failed to read from DHT22 sensor!");
  } else {
    Serial.print("h: ");
    Serial.print(output.h);
    Serial.print("%\t c: ");
    Serial.print(output.c);
    Serial.print("°C \t f: ");
    Serial.print(output.f);
    Serial.println("°F");
  }

  return output;
}

void publishDHT(sDHT dataDHT[READ_COUNT]) {

  sDHT output = {0, 0, 0};

  for (int i = 0; i < READ_COUNT; i++) {
    output.h += dataDHT[i].h;
    output.c += dataDHT[i].c;
    output.f += dataDHT[i].f;
  }
  
  output.h = output.h / READ_COUNT;
  output.c = output.c / READ_COUNT;
  output.f = output.f / READ_COUNT;

  publishMqtt(mqtt_id + "/luftfeuchte", String(output.h));
  publishMqtt(mqtt_id + "/temperatur", String(output.c));
}

void connecting() {
  digitalWrite(LEDPIN, HIGH);
  Serial.println("(Re-)connecting...");
  Serial.println();
  
  Serial.print("Attempting to connect to WPA SSID: ");
  Serial.println(WIFI_SSID);
  WiFi.begin(WIFI_SSID, WIFI_PASS);
  while (WiFi.status() != WL_CONNECTED) {
    digitalWrite(LEDPIN, LOW);
    delay(500);
    Serial.print(".");
    digitalWrite(LEDPIN, HIGH);
    delay(500);
    yield();
  }
  Serial.println();
  Serial.println("You're connected to the network");
  Serial.print("Your ip-adress is ");
  Serial.println(WiFi.localIP());
  Serial.println();
  digitalWrite(LEDPIN, LOW);

  Serial.print("Attempting to connect to the MQTT broker: ");
  Serial.println(mqtt_broker);
  while (!mqttClient.connect(mqtt_broker, mqtt_port)) {
    Serial.print(".");
    
    for (int i = 0; i < 50; i++) {
      digitalWrite(LEDPIN, LOW);
      delay(100);
      digitalWrite(LEDPIN, HIGH);
      delay(100);
      yield();
    }
  }
  Serial.println();
  Serial.println("You're connected to the MQTT broker!");
  Serial.println();

  digitalWrite(LEDPIN, LOW);
}
