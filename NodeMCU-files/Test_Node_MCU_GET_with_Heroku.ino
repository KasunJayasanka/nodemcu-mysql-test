#include <ArduinoJson.h>
#include <ArduinoJson.hpp>
#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266HTTPClient.h>

// WiFi credentials
const char* ssid = "Iman_WIFI";
const char* password = "12345678";

String serverURL = "https://node-mcu-test.herokuapp.com/dbwrite.php?";

String apiKey="tPmAT5Ab3j7F9";

unsigned long lastTime = 0;
unsigned long timerDelay = 500;

String createURL(String serverURL,String apiKey) {

  
    String sensorValue1=String(random(100));
    String sensorValue2=String(random(100));
    String sensorValue3=String(random(100));
    String sensorValue4=String(random(100));

    // Perform any necessary actions based on the received sensor values
    /*Serial.print("Sensor1 Value:");
    Serial.println(sensorValue1);
    Serial.print("Sensor2 Value:");
    Serial.println(sensorValue2);
    Serial.print("Sensor3 Value:");
    Serial.println(sensorValue3);
    Serial.print("Sensor4 Value:");
    Serial.println(sensorValue4);*/

    serverURL+="&apiKey=";
    serverURL+=apiKey;
    serverURL+="&sensorValue1=";
    serverURL+=sensorValue1;
    serverURL+="&sensorValue2=";
    serverURL+=sensorValue2;
    serverURL+="&sensorValue3=";
    serverURL+=sensorValue3;
    serverURL+="&sensorValue4=";
    serverURL+=sensorValue4;
    
  return serverURL;
  
}

void sendGETRequest(String serverURL){
  
if ((millis() - lastTime) > timerDelay) {
    //Check WiFi connection status
    if(WiFi.status()== WL_CONNECTED){
      WiFiClient client;
      HTTPClient http;
      
      // Your Domain name with URL path or IP address with path
      http.begin(client, serverURL.c_str());
  
      // If you need Node-RED/server authentication, insert user and password below
      //http.setAuthorization("REPLACE_WITH_SERVER_USERNAME", "REPLACE_WITH_SERVER_PASSWORD");
        
      // Send HTTP GET request
      int httpResponseCode = http.GET();
      
      if (httpResponseCode>0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        Serial.println(payload);
      }
      else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      // Free resources
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
  
}


void setup() {
  Serial.begin(115200); // Set baud rate to match the Arduino

  // Connect to WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi!");

}

void loop() {
  
     String serverURL=createURL(serverURL,apiKey);
     sendGETRequest(serverURL);
     delay(1000);
     
}
