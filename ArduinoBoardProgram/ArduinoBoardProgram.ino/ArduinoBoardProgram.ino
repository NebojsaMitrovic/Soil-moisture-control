void(* resetFunc) (void) = 0;

#include <Adafruit_CC3000.h>
#include <LiquidCrystal.h>
#include <Adafruit_BMP085.h>
#include <DHT.h>
#include <DHT_U.h>
#include <SPI.h>

#define ADAFRUIT_CC3000_IRQ   3
#define ADAFRUIT_CC3000_VBAT  5
#define ADAFRUIT_CC3000_CS    10
// UNO za hardverski SPI koristi pinove SCK = 13, MISO = 12, MOSI = 11

#define WLAN_SSID       "View"  // SSID mreze na koju se povezuje
#define WLAN_PASS       "3b4e273144ab"  // lozinka mreze na koju se povezuje
#define WLAN_SECURITY   WLAN_SEC_WPA2 // sigurnosni protokol mreze

#define RS_PIN 15
#define E_PIN 14
#define D4_PIN 6
#define D5_PIN 7  
#define D6_PIN 8  
#define D7_PIN 9  

#define DHT_pin 2
#define DHT_tip DHT11

#define vlaznost_zemljista_PIN A3

#define navodnjavanje_PIN 16  //Definisemo A2 pin da radi kao digitalni 16 (A0-A5 = 14-19)

Adafruit_CC3000 cc3000 = Adafruit_CC3000(ADAFRUIT_CC3000_CS, ADAFRUIT_CC3000_IRQ, ADAFRUIT_CC3000_VBAT, SPI_CLOCK_DIV2);

LiquidCrystal lcd (RS_PIN, E_PIN, D4_PIN, D5_PIN, D6_PIN, D7_PIN);

Adafruit_BMP085 bmp;

DHT dht(DHT_pin, DHT_tip);

char adresa[] = "mitrovic.ddns.net";
uint32_t ip;

int vazdusni_pritisak_BMP = 0;
int nadmorska_visina_BMP = 0;
int temperatura_BMP = 0;

int vlaznost_vazduha = 0;

int vlaznost_zemljista = 0;

String navodnjavanje;

String podaci;

int id_arduina = 1;

void setup() 
{ 
  pinMode(4, OUTPUT);
  digitalWrite(4, HIGH);
  
  pinMode(navodnjavanje_PIN, OUTPUT);
  digitalWrite(navodnjavanje_PIN, HIGH);
  
  Serial.begin(115200);
  
  lcd.begin(16, 2);
  bmp.begin();
  dht.begin();
  cc3000.begin();

//  uint32_t ipAddress = cc3000.IP2U32(192, 168, 43, 100);
//  uint32_t netMask = cc3000.IP2U32(255, 255, 255, 0);
//  uint32_t defaultGateway = cc3000.IP2U32(192, 168, 43, 1);
//  uint32_t dns = cc3000.IP2U32(8, 8, 4, 4);
//  cc3000.setStaticIPAddress(ipAddress, netMask, defaultGateway, dns); 

  lcd.setCursor(0, 0);
  lcd.print("Povezivanje...");
  Serial.print(F("Povezivanje na WiFi mrezu... "));
  if (cc3000.connectToAP(WLAN_SSID, WLAN_PASS, WLAN_SECURITY, 1))
  {
    Serial.println(F("Uspesno povezivanje."));
    lcd.setCursor(0, 1);
    lcd.print("Uspesno povezan");
    delay(2000);
    lcd.clear();
    delay(1000);
  }
  else
  {
    Serial.println(F("Povezivanje nije uspelo."));
    delay(2000);
    lcd.setCursor(0, 1);
    lcd.print("Nema mreze.");
    delay(2000);
    lcd.setCursor(0, 1);
    lcd.print("Offline rezim.");
    delay(2000);
    lcd.clear();
     
    merenje_BMP();  
     
    kontrola_navodnjavanja();
    
    prikaz_na_ekranu();

    resetFunc(); 
  }
}
void loop()
{ 
  merenje_BMP();

  kontrola_navodnjavanja();
  
  priprema_podataka_za_slanje();

  slanje_podataka();

  prikaz_na_ekranu();
}

void merenje_BMP()
{
  temperatura_BMP = bmp.readTemperature();
  vazdusni_pritisak_BMP = bmp.readPressure() / 100;
  nadmorska_visina_BMP = bmp.readAltitude(bmp.readPressure() + 3000);
  vlaznost_vazduha = dht.readHumidity();
}

void kontrola_navodnjavanja()
{
  vlaznost_zemljista = analogRead(vlaznost_zemljista_PIN);
  vlaznost_zemljista = map (vlaznost_zemljista, 1023, 0 , 0, 99);
  
  lcd.setCursor(0, 0);
  lcd.print("Kontrola navodnjavanja");
  delay(1000);
  
  if (vlaznost_zemljista < 30)
  {
    digitalWrite(navodnjavanje_PIN, LOW);
    navodnjavanje = "Ukljuceno";
  }
  else
  {
    navodnjavanje = "Iskljuceno";
  }
  
  for (int brojacPozicije = 0; brojacPozicije < 6; brojacPozicije++) 
  {
    lcd.scrollDisplayLeft();
    delay(1000);
  }
  digitalWrite(navodnjavanje_PIN, HIGH);
  lcd.setCursor(6, 1);  
  delay(2000);
  lcd.print("Izvrsena");
  delay(1000);
}

void priprema_podataka_za_slanje()
{
  podaci = "t=" + String(temperatura_BMP) + 
           "&p=" + String(vazdusni_pritisak_BMP) + 
           "&l=" + String(nadmorska_visina_BMP) + 
           "&z=" + String(vlaznost_zemljista) +
           "&v=" + String(vlaznost_vazduha) +
           "&n=" + String(navodnjavanje) + 
           "&i=" + String(id_arduina);
  Serial.println(podaci);
}

void slanje_podataka()
{
  uint32_t ip = 0;
  Serial.print(adresa);
  Serial.print(F("-> "));
  while (ip == 0)  
  {
    while (!  cc3000.getHostByName(adresa, &ip))  
    {
      delay(1000);
    }
  }  
  cc3000.printIPdotsRev(ip);
  Serial.println(F(""));
  Adafruit_CC3000_Client client = cc3000.connectTCP(ip, 80);
  if (client.connected()) 
  {
    Serial.println(F("Slanje POST zahteva..."));
    client.println("POST /arduino/update.php HTTP/1.1"); 
    client.println("Host: mitrovic.ddns.net");
    client.println("Connection: close");
    client.println("Content-Type: application/x-www-form-urlencoded"); 
    client.print("Content-Length: "); 
    client.println(podaci.length()); 
    client.println();
    client.print(podaci); 
    Serial.println(F("POST zahtev je poslat."));
  } 
  else 
  {
    Serial.println(F("Klijent se nije povezao sa serverom."));  
    resetFunc(); 
  }
  Serial.println(F("Citanje odgovora servera..."));
  while (client.connected()) 
  {
    while (client.available()) 
    {
      char c = client.read();
      Serial.print(c);
    }
  }
  client.close();
  Serial.print(F("Prekidanje veze sa stranicom "));
  Serial.print(adresa);
  Serial.println(F(" ."));
  Serial.println(F("-----------------------------"));
}

void prikaz_na_ekranu()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Nadmorska visina");
  delay(2000);
  lcd.setCursor(0, 1);
  lcd.print(nadmorska_visina_BMP);
  lcd.print(" m");
  delay(4500);
  lcd.clear();
  delay(1000);
  
  lcd.setCursor(0, 0);
  lcd.print("Temperatura");
  delay(2000);
  lcd.setCursor(0, 1);
  lcd.print(temperatura_BMP);
  lcd.print(" ");
  lcd.print((char)223);
  lcd.print("C");
  delay(4500);
  lcd.clear();
  delay(1000);

  lcd.setCursor(0, 0);
  lcd.print("Vlaznost vazduha");
  delay(2000);
  lcd.setCursor(0, 1);
  lcd.print(vlaznost_vazduha);
  lcd.print(" %");
  delay(4500);
  lcd.clear();
  delay(1000);
  
  lcd.setCursor(0, 0);
  lcd.print("Vazdusni pritisak");
  delay(2000);
  for (int brojacPozicije = 0; brojacPozicije < 1; brojacPozicije++) 
  {
    lcd.scrollDisplayLeft();
    delay(1000);
  }
  lcd.setCursor(1, 1);
  lcd.print(vazdusni_pritisak_BMP);
  lcd.print(" hPa (mbar)");
  delay(4500);
  lcd.clear();
  delay(1000);
  
  lcd.setCursor(0, 0);
  lcd.print("Vlaznost zemljista");
  delay(2000);
  for (int brojacPozicije = 0; brojacPozicije < 2; brojacPozicije++) 
  {
    lcd.scrollDisplayLeft();
    delay(1000);
  }
  lcd.setCursor(2, 1);
  lcd.print(vlaznost_zemljista);
  lcd.print(" %");  
  delay(4500);
  lcd.clear();
  delay(1000);
  
  lcd.setCursor(0, 0);
  lcd.print("Navodnjavanje");
  delay(2000);
  lcd.setCursor(0, 1);
  lcd.print(navodnjavanje);
  delay(4500);
  lcd.clear();
  delay(1000);
}
