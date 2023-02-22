<link rel="stylesheet" href="style.css" type="text/css">
<?php
include "security/config.php";
include "security/project-security.php";
ini_set('session.gc_maxlifetime', 31536000);
session_start();
if(isset($_SESSION["user_id"])){
    header("Location: chat.php");
    exit();
}
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
    echo '<meta charset="UTF-8">';
   echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>SafeChat</title>';
   echo '<link rel="stylesheet" href="style.css" type="text/css">';
    echo '<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>';

echo '</head>';
echo '<body>';
echo "<center><h1>In Developing!</h1></br><h2>SafeChat</h2></br>Sie suchen nach einer sicheren und zuverlässigen Chat-Plattform?</br> SafeChat ist die Lösung! </br>Unsere Plattform ermöglicht es Ihnen, sich mit einer User-ID zwischen 1 und 100000 zu registrieren</br> und sicher mit Freunden und Kollegen zu chatten.</br>

Unsere Verschlüsselungstechnologie garantiert,</br> dass Ihre Nachrichten und persönlichen Daten immer geschützt sind.</br> Sie können sich sicher sein, dass Ihre Unterhaltungen privat bleiben</br> und dass Ihre Daten sicher aufbewahrt werden.</br></br>

Mit SafeChat erhalten Sie Zugriff auf eine Vielzahl von Funktionen,</br> darunter: alle 3 stunden alte  nachrichten werden automatisch gelöscht,</br>ips werden nicht geloggt, user & nachrichten sind mit hash & salts verschlüsselt.</br> Unsere Benutzeroberfläche ist intuitiv und einfach zu bedienen,</br> so dass Sie schnell und einfach in Kontakt bleiben können.</br>
Egal ob via Android App , iOS App oder Web-Browser.</br>

Registrieren Sie sich noch heute bei SafeChat und erleben Sie die Zukunft des Chats</br> - sicher, zuverlässig und vollgepackt mit Funktionen.</br> Wir freuen uns darauf, Sie in unserer Community begrüßen zu dürfen!</center>
</br>

<center><h4>Android App | iOS App  </h4></center>
<center><h5>Donations: </h5></center>
<center><h5>Protected By:</h5> <h6>Web-Application Firwall </h6></center>
";
  echo '<a href="login.php" class="indexBtn">Login</a>';
  echo '<a href="register.php" class="indexBtn">Register</a>';

echo '</body>';
echo '</html>';