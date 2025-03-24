<?php
require_once "./connexion.php";
$message = "";

function clean_inputs($data)
{


  return htmlspecialchars(stripslashes(trim($data)));
}
if (isset($_POST['create'])) {
  $nom = clean_inputs($_POST['nom']);
  $prenom = clean_inputs($_POST['prenom']);
  $email = clean_inputs($_POST['mail']);
  if (!empty($nom) || !empty($prenom) || !empty($email)) {
    $sql_mail = "SELECT * FROM eleve WHERE email = :email";
    $request_mail = $pdo->prepare($sql_mail);
    $request_mail->execute(compact('email'));
    $mail_exist = $request_mail->fetch();

    if ($mail_exist) {
      $message = "ce mail existe deja !";
    }
    $sql = "INSERT INTO eleve (nom, prenom, email) VALUES (:nom, :prenom, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(compact('nom', 'prenom', 'email'));
  } else {
    $message = "Veuillez remplir tous les champs";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/output.css">
  <link rel="stylesheet" href="c.css">
  <title>Modifier Etudiant</title>

</head>

<body class="bg-green-100">
  <div class="container mx-auto p-4  text-center">
    <h1 class="text-3xl font-bold text-green-900 text-center mb-4">Modifier Etudiant</h1>
    <div class="error">
      <h3> <?= $message ?></h3>
    </div>

    <form action="" method="post" class="bg-white p-6 rounded shadow max-w-md mx-auto">
      <div class="mb-4">
        <input type="text" name="nom" value="<?= $donnee['nom'] ?? ""; ?>" placeholder="Nom"
          class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
      </div>
      <div class="mb-4">
        <input type="text" name="prenom" placeholder="Prénom"
          class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
      </div>
      <div class="mb-4">
        <input type="email" name="mail" placeholder="Email"
          class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
      </div>
      <div class="text-center">
        <input type="submit" name="create" value="Modifier"
          class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
      </div>
    </form>

    <div class="mt-4 text-center">

      <a class=" my-5 px-4 py-2 mr-5 bg-green-600 text-white rounded hover:bg-green-700"
        href="http://localhost/php/">Liste
        des étudiants
      </a>
    </div>
  </div>


</body>


</html>