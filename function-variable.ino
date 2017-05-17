// -----------------------------------
// SMART-E Projekt (Hack|Bay 2017)
// -----------------------------------
// Author: Christian Häussler
// -----------------------------------
// Last update: 17.05.2017
// -----------------------------------

// Include der MQTT Library zum Sendnen der Daten an die RaspberryPi Zentrale
#include <MQTT.h>

// Deklaration der Pins, die als Eingänge und Ausgänge benutzt werden
int watermeter = A0; // Simulation für Wasserstand
int bewegung = D0; // Simulation für Einbruch
int relais = D5; // Simulation für Steckdose
int wind = A1; // Simulation für Windstärke

// Deklaration der Variablen für MQTT und der Particle-Cloud
int wasserstand; // Höhe des Wasserstandes
int bewegungsst; // Status des Bewegungsmelders
int windstaerke; // Windstärke in km/h
int relaisst; // Relais-Status

// Konstant-Variable zur Berechnung des Windstärke
float voltageConversionWindConstant = .004882814;

// Konstant-Variable zur Berechnung der Wasserstandes
float voltageConversionWaterConstant = .0357142857;

// Callback Methode für MQTT
void callback(char* topic, byte* payload, unsigned int length) {
}

// MQTT Client zum sende an die RaspberryPi Zentrale
MQTT client("172.17.100.252", 1883, callback);

// Initiales Setup der Funktionen
void setup() {

    // Deklaration der Ein- und Ausgänge
    pinMode(watermeter,INPUT);  // Eingang Wassersensor
    pinMode(bewegung,INPUT); // Eingang Bewegungsmelder
    pinMode(wind,INPUT); // Eingang Bewegungsmelder
    pinMode(relais, OUTPUT); // Reails für Steckdose
 
    // Relais initial ausschalten
    digitalWrite(relais, LOW);

    // Deklaration der Variablen für die Particle Cloud.
    Particle.variable("wasserstand", &wasserstand, INT);
    Particle.variable("bewegungsst", &bewegungsst, INT);
    Particle.variable("windstaerke", &windstaerke, INT);
    Particle.function("relais", relaisToggle);

    // Verbindung zum MQTT Server aufbauen (RaspberryPi Zentrale)
    client.connect("Smart-E1");

}

// Zentrale Loop Funktion...
void loop() {

    // Auslesen der Eingänge und setzen entsprechender Variablen
    wasserstand = analogRead(watermeter) * voltageConversionWaterConstant;;
    bewegungsst = digitalRead(bewegung);
    windstaerke = analogRead(wind) * voltageConversionWindConstant;

    // Variablen in die Particle Cloud publishen
    Particle.publish("Wasser-Sensor", String(wasserstand), 10);
    Particle.publish("Bewegungs-Status", String(bewegungsst), 10);
    Particle.publish("Wind-Stärke", String(windstaerke), 10);
    Particle.publish("Relais-Status", String(relaisst), 10);
    
    // Senden der MQTT Messages
    if (client.isConnected()) {
        client.publish("smart-e1/wasserstand", String(wasserstand));
        client.publish("smart-e1/bewegung", String(bewegungsst));
        client.publish("smart-e1/windstaerke", String(windstaerke));
        client.publish("smart-e1/relais", String(relaisst));
    }
    
    // Warteschleife
    delay(10000); // 10 Sekunden pause
}

// Relais schalten
int relaisToggle(String command) {
    if (command=="on") {
        digitalWrite(relais,HIGH);
        relaisst = HIGH;
        return 1;
    }
    else if (command=="off") {
        digitalWrite(relais,LOW);
        relaisst = LOW;
        return 0;
    }
    else {
        return -1;
    }
}
