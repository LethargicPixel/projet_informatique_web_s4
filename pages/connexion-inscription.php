<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

</head>

<body>
    <?php if (!$_SESSION['erreur_connexion']): ?>
        <?php include "login/connexion.php"; ?>

    <?php else: ?>

        <div class="container">
            <h1>Erreur de connexion</h1>
            <p>Veuillez vérifier vos identifiants.</p>
            <a href="?page=connexion" class="btn btn-primary">Réessayer</a>
            <?php $_SESSION['erreur_connexion'] = false; ?>
        </div>
    <?php endif; ?>

</body>

</html>