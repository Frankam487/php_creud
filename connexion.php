<?php
$hostname="127.0.0.1";
$username ="root";
$password="";
$database="student";

$connect= new mysqli($hostname,$username, $password, $database);

// if ($connect->connect_error) {
//   echo "Erreur : La connexion à la base de données a échoué :  .$connect->connect_error "
//   ;
// } else {
//   echo "Succès : Connexion à la base de données avec succès !";
// }
try {
  $connect = new mysqli($hostname, $username, $password, $database);
    
  if ($connect->connect_error) {
      throw new Exception("La connexion à la base de données a échoué : " . $connect->connect_error);
  }

  echo "Succès : Connexion à la base de données établie avec succès !";
} catch (Exception $e) {
  echo "Erreur : " . $e->getMessage();
}