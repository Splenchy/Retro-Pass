
#include <SPI.h>
#include <MFRC522.h>
// Affectation des broches
#define RST_PIN 9
#define SS_PIN 10
MFRC522 mfrc522(SS_PIN, RST_PIN);
void setup() {
// Initialisation du Module RFID
  Serial.begin(9600);
  while (!Serial);
  SPI.begin();
  mfrc522.PCD_Init();
  mfrc522.PCD_DumpVersionToSerial(); // Affichage des données de la bibliothèque
  Serial.println(F("Scan PICC to see UID, type, and data blocks..."));
}
String rightOne = "b7dc707a";
  
void loop() {
// Attente d'une carte RFID
if ( ! mfrc522.PICC_IsNewCardPresent()) {
  return;
}
// Récupération des informations de la carte RFID
if ( ! mfrc522.PICC_ReadCardSerial()) {
  return;
}
// Affichage des informations de la carte RFID
//  mfrc522.PICC_DumpToSerial(&(mfrc522.uid));
  String badge ="";
  for (int i = 0; i<mfrc522.uid.size; i++) {
      badge += String(mfrc522.uid.uidByte[i], HEX);
  }
 if (badge != rightOne) {
  Serial.println("Nope");
    delay(1000);

 }
 else {
    Serial.println("Indice numéro 2 : '67'");
    delay(1000);
 }
};
