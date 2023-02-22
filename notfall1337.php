<?php
include "security/config.php";
include "security/project-security.php";
ini_set('error_reporting', E_ALL);
// Verbindung zu MySQL-Datenbank herstellen und Config-Datei einbinden
include "config.php";
// Funktion zum Löschen aller Nachrichten bei Notfall1337
$mysqli->query("TRUNCATE TABLE messages");