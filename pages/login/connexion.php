<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['email'];
    $mdp = $_POST['motdepasse'];

    $existe = $bdd->prepare("SELECT mail FROM profils WHERE mail=? and mdp=?");
    $existe->execute([$mail, $mdp]);
    $existe = $existe->fetch(PDO::FETCH_ASSOC);


    if ($existe) {
        $_SESSION['mail'] = $mail;
        $_SESSION['connecter'] = true;
        $_SESSION['erreur_connexion'] = false;
        $_SESSION['nb_erreur'] = 0;
        header('Location: ?page=accueil');

        exit;
    } else {
        $_SESSION['erreur_connexion'] = true;
        $_SESSION['nb_erreur']++;
        if ($_SESSION['nb_erreur'] >= 3) {
            $_SESSION['erreur_connexion'] = false;
            $_SESSION['nb_erreur'] = 3;
            header('Location: ?page=inscription');
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="pages/login/affiche_mdp.js" defer></script>
    <title>Document</title>
</head>

<body>
    <form method="post">
        <div class="container">
            <h1>Connexion</h1>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="motdepasse" class="form-label">Mot de passe</label>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                    <button class="btn btn-outline-secondary rounded-end toggleMdp" type="button">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>

        <?php if ($_SESSION['erreur_connexion']): ?>
            <div class="alert alert-danger mt-3" role="alert">
                <p>mail ou mot de passe incorrects. Veuillez réessayer.</p>
            </div>
        <?php endif; ?>
        <div class="container mt-3">
            <p>Pas encore inscrit ? <a href="?page=inscription">Inscrivez-vous ici</a></p>
    </form>
</body>

</html>