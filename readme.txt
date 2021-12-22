Simple poll app (made as a school project)

Introduction

The application displays an active question to the user, together with the answer options and the number of people who have already answered the question. After selecting an answer choice, the selected answer is stored in the database and the user is presented with the results of the survey. 
(the number of respondents, the number of responses for all answer options and their percentage).

A question can only be answered once from a single IP address (for testing purposes, the IP address check is currently commented out in the file poll_result.php).

The application administrator can, using the administration module
- to create two or three multiple-choice questions. The question will be stored in the database. 
- determine which question is active
- view the result of the question (number of respondents, number of responses for all answer options and their percentage).
- delete the selected question (a question can be deleted if there is no user-entered answer stored in the database).

NOTE: The administration module should be separated from the normal user environment and access should be via user authentication, 
but the project specification did not require this functionality and it is currently not implemented.

Installing the application

After saving all the files, the following settings need to be made:

In the file config.php:

define('HOST', '.......'); // Enter the name of the database server.
define('USERNAME', '..........'); // Specify the username
define('PASSWORD', '.............'); // Enter the password.
define('DBNAME', '.............'); // Specify the database name

In the init.sql file

CREATE DATABASE ........... COLLATE utf8mb4_estonian_ci; // Enter the same database name as in the config.php file.

USE ...............; // Enter the same database name as in the config.php file

Then open the page http://..../poll/install.php in the browser and the application will make the database and its tables on the server. 
If the installation is successful, the user will be notified, if it fails, an error message will be displayed.

To use the application, open http://.../poll/index.php in the browser

In addition, you can specify in the config.php file if you wish:
- the number of records in the question table to be displayed on one page (by changing the value of the MAXPERPAGE constant, default 8).
- max number of buttons for browsing the pages of the question table (by changing the value of the MAX_BUTTONS constant, default 5).

The "samples" directory stores a database of data for testing.



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


