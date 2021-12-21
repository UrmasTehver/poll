<?php
require('config/config.php');

try {
    $connection = new PDO('mysql:host='.HOST, USERNAME, PASSWORD, $options);
    $connection->exec('SET NAMES utf8'); // SQL lause, et täpitähed oleks korrektselt
    $sql = file_get_contents('config/init.sql'); // Faili sisu lugemine muutujasse (SQL lause)
    $connection->exec($sql); // Teeb reaalselt andmebaasi, sellesse tabeli ja lisab kirjed

    echo '<p>Andmebaas ja tabel users on loodud edukalt.</p>';
    echo '<a href="index.php">Avalehele</a>';

} catch (PDOException $error) {
    echo $error->getMessage(); // Veateade
}
?>