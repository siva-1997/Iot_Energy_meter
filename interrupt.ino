const int ledPin = 2;     
int ledState = 0;         

void setup() {
 
  pinMode(ledPin, INPUT);
  // Attach an interrupt to the ISR vector
  attachInterrupt(0, pin_ISR, RISING);
  Serial.begin(9600);
}

void loop() {
  Serial.print("CALIBRSTION LED COUNT: ");
  Serial.println(ledState);
  int n=(ledState/12);
  Serial.print("KILOWATT= ");
  Serial.println(n);
  delay(1000);
}

void pin_ISR() 
{
  if(digitalRead(ledPin)==HIGH)
  {
    ledState++;
  }
}

