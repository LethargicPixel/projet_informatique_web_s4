<?php

$host = '127.0.0.1';
$dbname = 'SPORTIFY';
$username = 'root';
$password = '';
$port = 3307;     //port pour mariaDB, je n'arrive pas a me connecter sur le serveur MYsql sur phpmyadmin           


$bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);







session_start();
if (!isset($_SESSION['connecter'])) {
    $_SESSION['connecter'] = false;
}
if (!isset($_SESSION['erreur_connexion'])) {
    $_SESSION['erreur_connexion'] = false;
}
if (!isset($_SESSION['nb_erreur'])) {
    $_SESSION['nb_erreur'] = 0;
}


$pages = [
    'accueil' => 'accueil.php',
    'activite' => 'activite.php',
    'devis' => 'devis.php',
    'connexion' => 'login/connexion.php',
    'contact' => 'contact.php',
    'inscription' => 'login/inscription.php',
    'profil' => 'profil.php'
];


$page = isset($_GET['page']) && array_key_exists($_GET['page'], $pages) ? $_GET['page'] : 'accueil';


if ($_SESSION['connecter']) {
    $pdp = $bdd->prepare("SELECT pdp FROM profils WHERE mail=?");
    $pdp->execute([$_SESSION['mail']]);
    $pdp = $pdp->fetch(PDO::FETCH_ASSOC);
    $pdp = $pdp ? $pdp['pdp'] : null;


}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap-utilities.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <title>Sportify</title>
</head>

<body>

    <header>
        <nav class="bg-success d-flex align-items-center justify-content-between">

            <div class="d-flex justify-content-left align-items-center">
                <a href="?page=accueil"
                    class="btn btn-success p-2 p-md-3 <?= $page == 'accueil' ? 'active' : '' ?>">accueil</a>
                <a href="?page=activite"
                    class="btn btn-success p-2 p-md-3 <?= $page == 'activite' ? 'active' : '' ?>">activités</a>
                <a href="?page=devis"
                    class="btn btn-success p-2 p-md-3 <?= $page == 'devis' ? 'active' : '' ?>">devis</a>
            </div>
            <?php if ($_SESSION['connecter'] === true): ?>
                <div class="d-flex align-items-center">
                    <?php if ($pdp) { ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($pdp) ?>" id="pdp" class="img-fluid rounded-circle"
                            alt="photo de profil" />
                    <?php } else { ?>
                        <img src="profil.png" class="img-fluid rounded-circle" id="pdp" alt="photo de profil" />
                    <?php } ?>
                    <a href="?page=profil" class="btn btn-success p-2 p-md-3 d-flex align-items-center">Mon profil</a>

                </div>
            <?php else: ?>
                <div class="d-flex justify-content-right align-items-center">
                    <a href="?page=connexion" class="btn btn-success p-2 p-md-3">connexion</a>
                </div>
            <?php endif; ?>

        </nav>
    </header>
</body>
<div class="container mt-4">
    <?php include "pages/" . $pages[$page]; ?>
</div>
<footer class="bg-success d-flex align-items-center justify-content-center">
    <div class="text-center text-white p-3">
        <p><a class="text-white" href="?page=contact">contact</a></p>
        <p>© 2025 Sportify. Tous droits réservés.</p>
        <p>Lopes Mathéo</p>
    </div>

</footer>

</html>