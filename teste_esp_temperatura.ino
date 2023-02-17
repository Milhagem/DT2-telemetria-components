#define AMPOP_OUT 34

void setup() {
  Serial.begin(115200);
}

void loop() {
  int adcValStack[50];

  for (int i = 0; i < 50; i++) {
    adcValStack[i] = analogRead(AMPOP_OUT);
  }

  int adcValTotal = 0;
  for (int i = 0; i < 50; i++) {
    int temp = adcValStack[i];
    adcValTotal += temp;
  }

  int adcValMean = adcValTotal / 50;

  Serial.print("adcVal Mean: ");
  Serial.println(adcValMean );
  

  delay(500);
}
