#include <WiFi.h>
#include <HTTPClient.h>
#include <WiFiClientSecure.h>
#include <TinyGPSPlus.h>

// ------------------------
// WiFi Configuration
// ------------------------
const char* ssid     = "TuhanYesusLuarBiasa1";
const char* password = "DalamNamaYesus1";

// API Server
const char* serverName = "https://lacak-logistik.projectdeck.online/iot/update";

#define ID_ARMADA 8

// ------------------------
// GPS Configuration (NEO-8N)
// ------------------------
TinyGPSPlus gps;

#define GPS_RX_PIN 16   // ESP32 RX2  ← GPS TX
#define GPS_TX_PIN 17   // ESP32 TX2  → GPS RX (opsional)
HardwareSerial SerialGPS(2);

// ------------------------
// LED Indicator
// ------------------------
#define LED_PIN 2   // Built-in LED ESP32 biasanya di GPIO 2

// ------------------------
// Timing
// ------------------------
unsigned long lastSend = 0;
const unsigned long sendInterval = 3UL * 1000UL;  // 3 detik


void setup() {
    Serial.begin(115200);
    delay(200);

    // LED sebagai indikator status GPS
    pinMode(LED_PIN, OUTPUT);
    digitalWrite(LED_PIN, LOW);  // awalnya mati

    // GPS (UART2)
    SerialGPS.begin(9600, SERIAL_8N1, GPS_RX_PIN, GPS_TX_PIN);
    Serial.println("GPS UART dimulai...");

    // WiFi
    Serial.println("Menghubungkan ke WiFi...");
    WiFi.begin(ssid, password);

    unsigned long startAttempt = millis();
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");

        if (millis() - startAttempt > 20000) {
            Serial.println("\nWiFi gagal konek (timeout)");
            break;
        }
    }

    if (WiFi.status() == WL_CONNECTED) {
        Serial.println("\nWiFi terhubung");
        Serial.print("IP ESP32: ");
        Serial.println(WiFi.localIP());
    }
}

void loop() {
    // Baca data GPS
    while (SerialGPS.available()) {
        gps.encode(SerialGPS.read());
    }

    // LED indikator GPS fix
    if (gps.location.isValid() && gps.satellites.value() > 3) {
        digitalWrite(LED_PIN, HIGH);  // GPS FIX
    } else {
        digitalWrite(LED_PIN, LOW);   // belum fix
    }

    // Kirim setiap interval
    if (millis() - lastSend >= sendInterval) {
        lastSend = millis();

        if (WiFi.status() != WL_CONNECTED) {
            Serial.println("WiFi putus, mencoba reconnect...");
            WiFi.reconnect();
            delay(2000);
        }

        if (WiFi.status() == WL_CONNECTED) {

            if (gps.location.isValid()) {
                String lat = String(gps.location.lat(), 6);
                String lng = String(gps.location.lng(), 6);

                String url = String(serverName) + "/" + ID_ARMADA + "/" + lng + "/" + lat;

                Serial.println("Mengirim ke: " + url);

                WiFiClientSecure *client = new WiFiClientSecure;
                client->setInsecure();  // abaikan SSL

                HTTPClient https;
                https.begin(*client, url);

                int code = https.GET();
                if (code > 0) {
                    Serial.print("Respon: ");
                    Serial.println(code);
                    Serial.println(https.getString());
                } else {
                    Serial.print("Error: ");
                    Serial.println(code);
                }

                https.end();
                delete client;

            } else {
                Serial.println("GPS belum fix, belum kirim...");
            }
        }
    }

    // Debug setiap 5 detik
    static unsigned long lastDebug = 0;
    if (millis() - lastDebug > 5000) {
        lastDebug = millis();

        if (gps.location.isValid()) {
            Serial.print("Lat: "); Serial.println(gps.location.lat(), 6);
            Serial.print("Lng: "); Serial.println(gps.location.lng(), 6);
            Serial.print("Sat: "); Serial.println(gps.satellites.value());
        } else {
            Serial.println("GPS belum mendapatkan posisi...");
        }
    }
}
