#define ADC_VREF_mV    3300.0  // in millivolt
#define ADC_RESOLUTION 4096.0
#define AMPOP_OUT        35    // ESP32 pin connected to LM358P
#define GAIN              3.89 // AMPOP_OUT = LM35 output * GAIN

#include <WiFi.h>
#include <HTTPClient.h>
#include <Wire.h>

// Replace with your network credentials
const char* ssid     = "SSID_NAME";
const char* password = "PASSWORD";

// REPLACE with your Domain name and URL path or IP address with path
const char* serverName = "SERVER_NAME";

// Keep this API Key value to be compatible with the PHP code provided in the server.
String apiKeyValue = "API_KEY_VALUE";

void setup() {
  Serial.begin(115200);
}

void loop() {
  // ---------- Temperature data ----------
  
  // read the ADC value from the temperature OpAmp
  int adcValAmpOp = analogRead(AMPOP_OUT);
  // converts de ADC value read from the OpAmp into the LM35 original value
  int adcVal = adcValAmpOp / GAIN;
  // convert the ADC value to voltage in millivolt
  float milliVolt = adcVal * (ADC_VREF_mV / ADC_RESOLUTION);
  // convert the voltage to the temperature in °C
  int celcius = milliVolt / 10;
  // convert the °C to °F
  int farenheits = celcius * 9 / 5 + 32;


  // ---------- Preparing HTTP request ----------
  
  // Check WiFi connection status
  if(WiFi.status()== WL_CONNECTED){
    WiFiClient client;
    HTTPClient http;
    
    // Domain name with URL path or IP address with path
    http.begin(client, serverName);
    
    // Specify content-type header
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    
    // Preparing HTTP POST request data
    String httpRequestData = "api_key=" + apiKeyValue + "&celcius=" + String(celcius) + "&farenheits=" + String(farenheits) + "";
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);

    // Send HTTP POST request
    int httpResponseCode = http.POST(httpRequestData);
    
    if (httpResponseCode>0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    }
    else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    // Free resources
    http.end();
  } else {
    Serial.println("WiFi Disconnected. Attempting to connect again");
    WiFi.begin(ssid, password);
    Serial.println("Connecting");
    while(WiFi.status() != WL_CONNECTED) { 
      delay(500);
      Serial.println("WL_NOT_CONNECTED");
    }
    Serial.println("");
    Serial.print("Connected to WiFi network with IP Address: ");
    Serial.println(WiFi.localIP());;
    
  }

  delay(500);
}
