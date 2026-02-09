#include <Adafruit_NeoPixel.h>
#include <IRremote.hpp>
#ifdef __AVR__
  #include <avr/power.h>
#endif

// --- NeoPixel ---
#define LED_PIN 13
#define WIDTH 8
#define HEIGHT 5
#define NUMPIXELS (WIDTH * HEIGHT)
Adafruit_NeoPixel matrix = Adafruit_NeoPixel(NUMPIXELS, LED_PIN, NEO_GRB + NEO_KHZ800);

// --- IR Remote ---
#define IR_RECEIVE_PIN 2
#define BTN_UP    0xB946FF00 // à remplacer selon ta télécommande
#define BTN_DOWN  0xEA15FF00
#define BTN_LEFT  0xBB44FF00
#define BTN_RIGHT 0xBC43FF00
#define BTN_RESET 0xAD52FF00

// --- Jeu Snake ---
int snakeX[40];
int snakeY[40];
int snakeLength = 3;
int dirX = 0;
int dirY = 0;
int foodX, foodY;
unsigned long lastMove = 0;
const int moveDelay = 500; // ms

void setup() {
  Serial.begin(115200);
  IrReceiver.begin(IR_RECEIVE_PIN, ENABLE_LED_FEEDBACK);
  matrix.begin();
  matrix.setBrightness(50);
  matrix.show();

  randomSeed(analogRead(0));
  
  // Position initiale du serpent
  snakeX[0] = 3; snakeY[0] = 4;
  snakeX[1] = 2; snakeY[1] = 4;
  snakeX[2] = 1; snakeY[2] = 4;

  spawnFood();
}

void loop() {
  handleIR();
  if (millis() - lastMove > moveDelay) {
    lastMove = millis();
    moveSnake();
    drawMatrix();
  }
  if (snakeLength >= 7) victory();
}

// --- Gérer les commandes IR ---
void handleIR() {
  if (IrReceiver.decode()) {
    unsigned long code = IrReceiver.decodedIRData.decodedRawData;
    Serial.print("Code IR reçu : 0x");
    Serial.println(code, HEX);

    switch (code) {
      case BTN_UP:
        if (dirY == 0) { dirX = 0; dirY = -1; }
        break;
      case BTN_DOWN:
        if (dirY == 0) { dirX = 0; dirY = 1; }
        break;
      case BTN_LEFT:
        if (dirX == 0) { dirX = -1; dirY = 0; }
        break;
      case BTN_RIGHT:
        if (dirX == 0) { dirX = 1; dirY = 0; }
        break;
      case BTN_RESET:
        resetGame();
        break;
    }
    IrReceiver.resume();
  }
}

// --- Générer la pomme ---
void spawnFood() {
  bool onSnake;
  do {
    onSnake = false;
    foodX = random(0, WIDTH);
    foodY = random(0, HEIGHT);
    for (int i = 0; i < snakeLength; i++) {
      if (snakeX[i] == foodX && snakeY[i] == foodY) {
        onSnake = true;
        break;
      }
    }
  } while (onSnake);
}

// --- Déplacement du serpent ---
void moveSnake() {
  for (int i = snakeLength - 1; i > 0; i--) {
    snakeX[i] = snakeX[i - 1];
    snakeY[i] = snakeY[i - 1];
  }

  snakeX[0] += dirX;
  snakeY[0] += dirY;

  // rebouclage aux bords
  if (snakeX[0] < 0) snakeX[0] = WIDTH - 1;
  if (snakeX[0] >= WIDTH) snakeX[0] = 0;
  if (snakeY[0] < 0) snakeY[0] = HEIGHT - 1;
  if (snakeY[0] >= HEIGHT) snakeY[0] = 0;

  // mange la pomme
  if (snakeX[0] == foodX && snakeY[0] == foodY) {
    snakeLength++;
    spawnFood();
  }

  // collision avec soi-même
  for (int i = 1; i < snakeLength; i++) {
    if (snakeX[0] == snakeX[i] && snakeY[0] == snakeY[i]) {
      resetGame();
      break;
    }
  }
}

// --- Réinitialisation du jeu ---
void resetGame() {
  for (int i=0 ; i < 40 ; i++) {
    matrix.setPixelColor(i, matrix.Color(175, 0, 0));
    matrix.show();
    delay(100);
  }
  snakeLength = 3;
  dirX = 1; dirY = 0;
  snakeX[0] = 0; snakeY[0] = 0;
  snakeX[1] = 7; snakeY[1] = 0;
  snakeX[2] = 8; snakeY[2] = 0;
  spawnFood();
}

// --- Affichage sur la matrice ---
void drawMatrix() {
  matrix.clear();
  int foodIndex = coordToIndex(foodX, foodY);
  matrix.setPixelColor(foodIndex, matrix.Color(25, 0, 0));  // pomme rouge

  for (int i = 0; i < snakeLength; i++) {
    int index = coordToIndex(snakeX[i], snakeY[i]);
    if (i == 0) matrix.setPixelColor(index, matrix.Color(0, 50, 0));  // tête
    else matrix.setPixelColor(index, matrix.Color(0, 15, 0));         // corps
  }

  matrix.show();
}

// --- Conversion coordonnées → index LED ---
int coordToIndex(int x, int y) {
    return y * WIDTH + x;
}

void victory() {
  for (int i=0 ; i < 40 ; i++) {
    matrix.setPixelColor(i, matrix.Color(0, 125, 0));
    matrix.show();
    delay(100);
  }
  
  for (int i=0 ; i < 4 ; i++) {
    for (int i=0 ; i < 40 ; i++) {
      matrix.setPixelColor(i, matrix.Color(0, 255, 0));
    }
    matrix.show();
    delay(100);
    matrix.clear();
    delay(50);
  }

  while (true) {
    drawSix(0);
    drawNine(4);
    matrix.show();
  }
}

void drawZero(int posX) {
  matrix.setPixelColor(1 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(10 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(8 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(16 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(24 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(33 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(18 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(26 + posX, matrix.Color(15, 15, 15));
}

void drawOne(int posX) {
  matrix.setPixelColor(1 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(8 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(9 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(17 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(25 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(32 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(33 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(34 + posX, matrix.Color(15, 15, 15));
}

void drawTwo(int posX) {
  matrix.setPixelColor(8 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(1 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(10 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(18 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(25 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(32 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(33 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(34 + posX, matrix.Color(15, 15, 15));
}

void drawThree(int posX) {
  matrix.setPixelColor(0 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(1 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(10 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(16 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(17 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(26 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(32 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(33 + posX, matrix.Color(15, 15, 15));
}

void drawFour(int posX) {
  matrix.setPixelColor(0 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(8 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(16 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(18 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(17 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(2 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(10 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(26 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(34 + posX, matrix.Color(15, 15, 15));
}

void drawFive(int posX) {
  matrix.setPixelColor(0 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(1 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(2 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(8 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(16 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(17 + posX, matrix.Color(15, 15, 15));
  // matrix.setPixelColor(18 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(26 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(32 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(33 + posX, matrix.Color(15, 15, 15));
  // matrix.setPixelColor(34 + posX, matrix.Color(15, 15, 15));
}

void drawSix(int posX) {
  matrix.setPixelColor(1 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(2 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(8 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(16 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(17 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(24 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(26 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(33 + posX, matrix.Color(15, 15, 15));
}

void drawSeven(int posX) {
  matrix.setPixelColor(0 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(1 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(2 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(10 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(17 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(24 + posX, matrix.Color(15, 15, 15));
  matrix.setPixelColor(32 + posX, matrix.Color(10, 10, 10));
}

void drawEight(int posX) {
  matrix.setPixelColor(1 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(10 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(8 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(24 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(17 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(33 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(26 + posX, matrix.Color(10, 10, 10));
}

void drawNine(int posX) {
  matrix.setPixelColor(1 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(10 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(8 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(18 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(17 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(33 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(26 + posX, matrix.Color(10, 10, 10));
  matrix.setPixelColor(32 + posX, matrix.Color(10, 10, 10));
}
