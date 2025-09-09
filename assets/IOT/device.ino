#include <WiFi.h>
#include <HTTPClient.h>
#include <TinyGPS++.h>
#include <HardwareSerial.h>

#define ID_ARMADA 1

const char *ssid = "TuhanYesusBaik";
const char *password = "PujiTuhan";
const char *serverName = "https://lacak-logistik.projectdeck.online/iot/update";

// Inisialisasi GPS
TinyGPSPlus gps;
HardwareSerial SerialGPS(2); // Gunakan Serial2

void setup()
{
    Serial.begin(115200);
    SerialGPS.begin(9600, SERIAL_8N1, 16, 17); // RX=16, TX=17

    Serial.println("Menghubungkan ke WiFi...");
    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED)
    {
        delay(1000);
        Serial.print(".");
    }
    Serial.println("\nTerhubung ke WiFi");
}

void loop()
{
    // Baca data dari GPS
    while (SerialGPS.available() > 0)
    {
        gps.encode(SerialGPS.read());
    }

    if (gps.location.isUpdated())
    {
        double latitudeVal = gps.location.lat();
        double longitudeVal = gps.location.lng();

        Serial.print("Latitude: ");
        Serial.println(latitudeVal, 6);
        Serial.print("Longitude: ");
        Serial.println(longitudeVal, 6);

        if (WiFi.status() == WL_CONNECTED)
        {
            HTTPClient http;

            String id_device = String(ID_ARMADA);
            String latitude = String(latitudeVal, 6);
            String longitude = String(longitudeVal, 6);

            String url = String(serverName) + "/" + id_device + "/" + latitude + "/" + longitude;
            Serial.println("Mengirim data ke: " + url);

            http.begin(url);
            int httpResponseCode = http.GET();

            if (httpResponseCode > 0)
            {
                String response = http.getString();
                Serial.print("Kode Respon: ");
                Serial.println(httpResponseCode);
                Serial.println("Respon Server: " + response);
            }
            else
            {
                Serial.print("Error kode: ");
                Serial.println(httpResponseCode);
            }

            http.end();
        }
        else
        {
            Serial.println("WiFi tidak terhubung");
        }
    }

    delay(60000); // Update setiap 1 menit
}
