<?php
require_once "./connexion.php";
$message = "";

function clean_inputs($data)
{
  return htmlspecialchars(stripslashes(trim($data)));
}

// Vérifier si un ID est présent dans l'URL
if (isset($_GET['id'])) {
  $id = clean_inputs($_GET['id']);
  $sql = "SELECT * FROM eleve WHERE id = :id";
  $request = $pdo->prepare($sql);
  $request->execute(['id' => $id]);
  $student = $request->fetch();

  if (!$student) {
    die("Étudiant non trouvé.");
  }
} else {
  die("ID manquant.");
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = clean_inputs($_POST['nom']);
  $prenom = clean_inputs($_POST['prenom']);
  $email = clean_inputs($_POST['email']);

  if (!empty($nom) && !empty($prenom) && !empty($email)) {
    $sql = "UPDATE eleve SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'id' => $id]);

    $message = "Étudiant mis à jour avec succès !";
    header("Location: http://localhost/php/");
    exit();
  } else {
    $message = "Veuillez remplir tous les champs.";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/output.css">
  <link rel="stylesheet" href="c.css">
  <title>Modifier Étudiant</title>
</head>

<body class="bg-green-100">
  <div class="container mx-auto p-4 text-center">
    <h1 class="text-3xl font-bold text-green-900 text-center mb-4">Modifier Étudiant</h1>
    <div class="error">
      <h3><?= $message ?></h3>
    </div>
    <form action="" method="post" class="bg-white p-6 rounded shadow max-w-md mx-auto">
      <div class="mb-4">
        <input type="text" name="nom" value="<?= $student['nom'] ?? ''; ?>" placeholder="Nom"
          class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
      </div>
      <div class="mb-4">
        <input type="text" name="prenom" value="<?= $student['prenom'] ?? ''; ?>" placeholder="Prénom"
          class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
      </div>
      <div class="mb-4">
        <input type="email" name="email" value="<?= $student['email'] ?? ''; ?>" placeholder="Email"
          class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
      </div>
      <div class="text-center">
        <input type="submit" value="Modifier"
          class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
      </div>
    </form>
    <div class="mt-4 text-center">
      <a class="my-5 px-4 py-2 mr-5 bg-green-600 text-white rounded hover:bg-green-700"
        href="./index.php">Liste des étudiants</a>
    </div>
  </div>
</body>

</html>