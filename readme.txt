Lihtne küsitluste rakendus (tehtud koolitööna)

Sissejuhatus

Rakendus kuvab kasutajale aktiivse küsimuse koos vastusevariantidega ja juba küsimusele vastanute arvuga. Peale vastusevariandi valikut salvestatakse valitud vastus andmebaasi ja kuvatakse kasutajale küsitluse koondtulemused 
(vastanute arv, kõikidele vastusevariantidele antud vastuste arv ja nende osakaal).

Ühele küsimusele saab ühelt IP aadressilt vastata vaid ühe korra (hetkel on IP aadressi kontroll testimise otstarbel failis poll_result.php välja kommenteeritud).

Rakenduse administraator saab haldusmooduli abil
- koostada kahe või kolme valikvastusega küsimusi. Küsimus salvestatakse andmebaasi. 
- määrata, milline küsimus on aktiivne
- vaadata küsimuse tulemust (vastanute arv, kõikidele vastusevariantidele antud vastuste arv ja nende osakaal)
- kustutada valitud küsimus (kustutada saab küsimust, millel ei ole andmebaasi salvestatud ühtegi kasutaja poolt sisestatud vastust)

NB! Haldusmoodul peaks olema tavakasutaja keskkonnast eraldatud ja sisenemine toimuma läbi kasutaja autentimise, 
kuid ülesande püstitus seda funktsionaalsust ei nõudnud  ja see on hetkel realiseerimata


Rakenduse installeerimine

Peale kõikide failide salvestamist tuleb teha järgmised seadistused:

Failis config.php:

define('HOST', '.......'); // Sisesta andmebaasiserveri nimi
define('USERNAME', '..........'); // Sisesta kasutajanimi
define('PASSWORD', '.............'); // Sisesta parool
define('DBNAME', '.............'); // Määra andmebaasi nimi

Failis init.sql

CREATE DATABASE ........... COLLATE utf8mb4_estonian_ci; // Sisesta sama andmebaasi nimi, mis config.php failis

USE ...............; // Sisesta sama andmebaasi nimi, mis config.php failis

Seejärel ava brauseris leht http://..../poll/install.php ja rakendus teeb serverisse andmebaasi ning selle tabelid. 
Eduka installi puhul kuvatakse kasutajale sellekohane teade, vea puhul veateade.

Rakenduse kasutamiseks ava brauseris http://.../poll/index.php

Lisaks saad soovi korral config.php failis määrata:
- mitu kirjet küsimute tabelis ühel lehel näidatakse (muutes konstandi MAXPERPAGE väärtust, default 8)
- küsimuste tabeli lehtede sirvimise jaoks max nuppude arvu (muutes konstandi MAX_BUTTONS väärtust, default 5)


Kataloogis "samples" on salvestatud testimiseks andmeid sisaldav andmebaas.


