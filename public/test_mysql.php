<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "badge_db");
if ($mysqli->connect_error) {
    die("Echec de connexion : " . $mysqli->connect_error);
}
echo "Connexion réussie !";
$mysqli->close();
?>